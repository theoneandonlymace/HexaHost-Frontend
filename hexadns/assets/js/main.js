/**
 * HexaDNS.de - DNS Tools & Server Landing Page
 * Main JavaScript
 */

// API Base URL (wird über data-attribute im HTML gesetzt)
const API = document.body.dataset.api || '/api';

// Tab Switching
document.querySelectorAll('.tool-tab').forEach(tab => {
    tab.addEventListener('click', () => {
        document.querySelectorAll('.tool-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tool-panel').forEach(p => p.classList.remove('active'));
        tab.classList.add('active');
        document.getElementById('panel-' + tab.dataset.tool).classList.add('active');
    });
});

// Enter key handlers
['dns-domain', 'prop-domain', 'whois-domain', 'ssl-domain', 'ping-domain', 'reverse-ip'].forEach(id => {
    const el = document.getElementById(id);
    if (el) {
        el.addEventListener('keypress', e => {
            if (e.key === 'Enter') {
                el.closest('.tool-card').querySelector('.btn').click();
            }
        });
    }
});

// DNS Lookup
async function dnsLookup() {
    const domain = document.getElementById('dns-domain').value.trim();
    const results = document.getElementById('dns-results');
    
    if (!domain) {
        results.innerHTML = '<div class="line error">Bitte Domain eingeben</div>';
        return;
    }
    
    results.innerHTML = '<div class="line comment">; Abfrage läuft...</div>';
    
    try {
        const res = await fetch(`${API}/dns-lookup.php?domain=${encodeURIComponent(domain)}`);
        const data = await res.json();
        
        if (data.error) {
            results.innerHTML = `<div class="line error">; Fehler: ${data.error}</div>`;
            return;
        }
        
        displayDnsResults(data);
    } catch (e) {
        results.innerHTML = `<div class="line error">; Netzwerkfehler: ${e.message}</div>`;
    }
}

function displayDnsResults(data) {
    const results = document.getElementById('dns-results');
    let html = `<div class="line comment">; <<>> HexaDNS Lookup <<>> ${data.domain}</div>`;
    html += `<div class="line comment">; Abfrage um ${data.timestamp}</div>`;
    html += `<div class="line comment">;</div>`;
    
    const r = data.records;
    
    if (r.A?.length) {
        html += `<div class="line header">;; A RECORDS (IPv4):</div>`;
        r.A.forEach(a => html += `<div class="line record">${data.domain}.    ${a.ttl}    IN    A    ${a.ip}</div>`);
    }
    
    if (r.AAAA?.length) {
        html += `<div class="line header">;; AAAA RECORDS (IPv6):</div>`;
        r.AAAA.forEach(a => html += `<div class="line record">${data.domain}.    ${a.ttl}    IN    AAAA    ${a.ipv6}</div>`);
    }
    
    if (r.NS?.length) {
        html += `<div class="line header">;; NS RECORDS:</div>`;
        r.NS.forEach(a => html += `<div class="line record">${data.domain}.    ${a.ttl}    IN    NS    ${a.target}</div>`);
    }
    
    if (r.MX?.length) {
        html += `<div class="line header">;; MX RECORDS:</div>`;
        r.MX.forEach(a => html += `<div class="line record">${data.domain}.    ${a.ttl}    IN    MX    ${a.priority} ${a.target}</div>`);
    }
    
    if (r.TXT?.length) {
        html += `<div class="line header">;; TXT RECORDS:</div>`;
        r.TXT.forEach(a => html += `<div class="line record">${data.domain}.    ${a.ttl}    IN    TXT    "${a.txt}"</div>`);
    }
    
    if (r.CNAME?.length) {
        html += `<div class="line header">;; CNAME RECORDS:</div>`;
        r.CNAME.forEach(a => html += `<div class="line record">${data.domain}.    ${a.ttl}    IN    CNAME    ${a.target}</div>`);
    }
    
    if (r.SOA?.length) {
        html += `<div class="line header">;; SOA RECORD:</div>`;
        r.SOA.forEach(a => html += `<div class="line record">${data.domain}.    ${a.ttl}    IN    SOA    ${a.mname} ${a.rname} ${a.serial}</div>`);
    }
    
    html += `<div class="line comment"></div>`;
    html += `<div class="line success">;; Query time: ${data.query_time_ms} msec</div>`;
    html += `<div class="line success">;; WHEN: ${data.timestamp}</div>`;
    
    results.innerHTML = html;
}

// Propagation Check
async function propagationCheck() {
    const domain = document.getElementById('prop-domain').value.trim();
    const type = document.getElementById('prop-type').value;
    const results = document.getElementById('prop-results');
    const status = document.getElementById('prop-status');
    const progress = document.getElementById('prop-progress');
    
    if (!domain) {
        status.innerHTML = '<span class="error">Bitte Domain eingeben</span>';
        return;
    }
    
    results.innerHTML = '';
    status.innerHTML = '';
    progress.style.display = 'block';
    document.getElementById('prop-progress-fill').style.width = '30%';
    
    try {
        const res = await fetch(`${API}/dns-propagation.php?domain=${encodeURIComponent(domain)}&type=${type}`);
        document.getElementById('prop-progress-fill').style.width = '100%';
        setTimeout(() => progress.style.display = 'none', 500);
        
        const data = await res.json();
        
        if (data.error) {
            status.innerHTML = `<span class="error">${data.error}</span>`;
            return;
        }
        
        const ps = data.propagation_status;
        const color = ps.percentage === 100 ? 'var(--success)' : ps.percentage > 50 ? 'var(--warning)' : 'var(--error)';
        
        status.innerHTML = `
            <div style="font-size:2rem;font-weight:700;color:${color}">${ps.percentage}%</div>
            <div style="color:var(--text-dim)">propagiert (${ps.servers_responding}/${ps.total_servers} Server)</div>
        `;
        
        results.innerHTML = data.servers.map(s => `
            <div class="prop-card">
                <div class="prop-card-header">
                    <h4>${s.server}</h4>
                    <span class="prop-status ${s.records.length ? 'online' : 'offline'}"></span>
                </div>
                <div class="prop-card-info">${s.ip} • ${s.location}</div>
                <div class="prop-card-result">${s.records.length ? s.records.join('<br>') : 'Keine Records'}</div>
                <div class="prop-card-time">${s.response_time}ms</div>
            </div>
        `).join('');
    } catch (e) {
        progress.style.display = 'none';
        status.innerHTML = `<span class="error">Fehler: ${e.message}</span>`;
    }
}

// WHOIS Lookup
async function whoisLookup() {
    const domain = document.getElementById('whois-domain').value.trim();
    const results = document.getElementById('whois-results');
    const raw = document.getElementById('whois-raw');
    
    if (!domain) {
        results.innerHTML = '<div class="info-card error"><h4>Fehler</h4><p>Bitte Domain eingeben</p></div>';
        return;
    }
    
    results.innerHTML = '<div class="info-card"><h4>Laden...</h4><p>WHOIS-Daten werden abgefragt...</p></div>';
    raw.innerHTML = '';
    
    try {
        const res = await fetch(`${API}/whois-lookup.php?domain=${encodeURIComponent(domain)}`);
        const data = await res.json();
        
        if (data.error) {
            results.innerHTML = `<div class="info-card error"><h4>Fehler</h4><p>${data.error}</p></div>`;
            return;
        }
        
        const p = data.whois.parsed;
        results.innerHTML = `
            <div class="info-card"><h4>Domain</h4><p>${p.domain_name}</p></div>
            ${p.registrar ? `<div class="info-card"><h4>Registrar</h4><p>${p.registrar}</p></div>` : ''}
            ${p.creation_date ? `<div class="info-card"><h4>Registriert</h4><p>${p.creation_date}</p></div>` : ''}
            ${p.expiration_date ? `<div class="info-card"><h4>Läuft ab</h4><p>${p.expiration_date}</p></div>` : ''}
            ${p.updated_date ? `<div class="info-card"><h4>Aktualisiert</h4><p>${p.updated_date}</p></div>` : ''}
            ${p.nameservers?.length ? `<div class="info-card"><h4>Nameserver</h4><p>${p.nameservers.join('<br>')}</p></div>` : ''}
            ${p.dnssec ? `<div class="info-card"><h4>DNSSEC</h4><p>${p.dnssec}</p></div>` : ''}
        `;
        raw.innerHTML = `<pre style="white-space:pre-wrap;word-break:break-all;color:var(--text-dim)">${data.whois.raw.replace(/</g,'&lt;')}</pre>`;
    } catch (e) {
        results.innerHTML = `<div class="info-card error"><h4>Fehler</h4><p>${e.message}</p></div>`;
    }
}

// SSL Check
async function sslCheck() {
    const domain = document.getElementById('ssl-domain').value.trim();
    const results = document.getElementById('ssl-results');
    
    if (!domain) {
        results.innerHTML = '<div class="info-card error"><h4>Fehler</h4><p>Bitte Domain eingeben</p></div>';
        return;
    }
    
    results.innerHTML = '<div class="info-card"><h4>Laden...</h4><p>SSL-Zertifikat wird geprüft...</p></div>';
    
    try {
        const res = await fetch(`${API}/ssl-check.php?domain=${encodeURIComponent(domain)}`);
        const data = await res.json();
        const ssl = data.ssl;
        
        if (!ssl.has_ssl) {
            results.innerHTML = `<div class="info-card error"><h4>Kein SSL</h4><p>${ssl.error || 'Kein SSL-Zertifikat gefunden'}</p></div>`;
            return;
        }
        
        const cert = ssl.certificate;
        const statusClass = ssl.is_valid ? (cert.days_until_expiry <= 30 ? 'warning' : 'success') : 'error';
        
        results.innerHTML = `
            <div class="info-card ${statusClass}"><h4>Status</h4><p>${ssl.is_valid ? (cert.is_expired ? '❌ Abgelaufen' : '✅ Gültig') : '❌ Ungültig'}</p></div>
            <div class="info-card"><h4>Domain</h4><p>${cert.subject?.common_name || domain}</p></div>
            <div class="info-card"><h4>Aussteller</h4><p>${cert.issuer?.organization || cert.issuer?.common_name || '-'}</p></div>
            <div class="info-card"><h4>Gültig ab</h4><p>${cert.valid_from}</p></div>
            <div class="info-card ${cert.days_until_expiry <= 30 ? 'warning' : ''}"><h4>Gültig bis</h4><p>${cert.valid_to}<br><small>${cert.days_until_expiry} Tage verbleibend</small></p></div>
            <div class="info-card"><h4>Algorithmus</h4><p>${cert.signature_algorithm || '-'}</p></div>
            ${cert.san_domains?.length ? `<div class="info-card"><h4>Alternative Namen</h4><p>${cert.san_domains.slice(0,5).join('<br>')}${cert.san_domains.length > 5 ? `<br><small>+${cert.san_domains.length-5} weitere</small>` : ''}</p></div>` : ''}
        `;
    } catch (e) {
        results.innerHTML = `<div class="info-card error"><h4>Fehler</h4><p>${e.message}</p></div>`;
    }
}

// Ping Check
async function pingCheck() {
    const domain = document.getElementById('ping-domain').value.trim();
    const results = document.getElementById('ping-results');
    
    if (!domain) {
        results.innerHTML = '<div class="info-card error"><h4>Fehler</h4><p>Bitte Domain eingeben</p></div>';
        return;
    }
    
    results.innerHTML = '<div class="info-card"><h4>Laden...</h4><p>Verfügbarkeit wird geprüft...</p></div>';
    
    try {
        const res = await fetch(`${API}/ping-check.php?domain=${encodeURIComponent(domain)}`);
        const data = await res.json();
        const r = data.results;
        
        const statusColors = { online: 'success', partial: 'warning', dns_only: 'warning', offline: 'error' };
        const statusText = { online: '✅ Online', partial: '⚠️ Teilweise erreichbar', dns_only: '⚠️ Nur DNS', offline: '❌ Offline' };
        
        results.innerHTML = `
            <div class="info-card ${statusColors[r.overall_status]}"><h4>Status</h4><p>${statusText[r.overall_status]}</p></div>
            <div class="info-card ${r.dns_resolution.resolved ? 'success' : 'error'}"><h4>DNS</h4><p>${r.dns_resolution.resolved ? `✅ ${r.dns_resolution.ip}` : '❌ Nicht auflösbar'}<br><small>${r.dns_resolution.response_time_ms}ms</small></p></div>
            <div class="info-card ${r.https.reachable ? 'success' : 'error'}"><h4>HTTPS (443)</h4><p>${r.https.reachable ? `✅ Status ${r.https.status_code}` : '❌ Nicht erreichbar'}<br><small>${r.https.response_time_ms}ms</small></p></div>
            <div class="info-card ${r.http.reachable ? 'success' : 'error'}"><h4>HTTP (80)</h4><p>${r.http.reachable ? `✅ Status ${r.http.status_code}` : '❌ Nicht erreichbar'}<br><small>${r.http.response_time_ms}ms</small></p></div>
            <div class="info-card ${r.icmp_ping.reachable ? 'success' : ''}"><h4>ICMP Ping</h4><p>${r.icmp_ping.reachable ? `✅ ${r.icmp_ping.response_time_ms}ms` : '⚠️ Nicht verfügbar'}<br><small>Packet Loss: ${r.icmp_ping.packet_loss ?? '-'}%</small></p></div>
            ${r.https.server ? `<div class="info-card"><h4>Server</h4><p>${r.https.server}</p></div>` : ''}
        `;
    } catch (e) {
        results.innerHTML = `<div class="info-card error"><h4>Fehler</h4><p>${e.message}</p></div>`;
    }
}

// Reverse DNS
async function reverseLookup() {
    const ip = document.getElementById('reverse-ip').value.trim();
    const results = document.getElementById('reverse-results');
    
    if (!ip) {
        results.innerHTML = '<div class="info-card error"><h4>Fehler</h4><p>Bitte IP-Adresse eingeben</p></div>';
        return;
    }
    
    results.innerHTML = '<div class="info-card"><h4>Laden...</h4><p>Reverse Lookup wird durchgeführt...</p></div>';
    
    try {
        const res = await fetch(`${API}/reverse-dns.php?ip=${encodeURIComponent(ip)}`);
        const data = await res.json();
        
        if (data.error) {
            results.innerHTML = `<div class="info-card error"><h4>Fehler</h4><p>${data.error}</p></div>`;
            return;
        }
        
        const r = data.result;
        results.innerHTML = `
            <div class="info-card"><h4>IP-Adresse</h4><p>${data.ip}<br><small>${data.ip_version}</small></p></div>
            <div class="info-card ${r.hostname ? 'success' : 'warning'}"><h4>Hostname</h4><p>${r.hostname || 'Kein PTR-Record gefunden'}</p></div>
            ${r.forward_verified !== undefined ? `<div class="info-card ${r.forward_verified ? 'success' : 'warning'}"><h4>Forward-Check</h4><p>${r.forward_verified ? '✅ Verifiziert' : '⚠️ Nicht verifiziert'}</p></div>` : ''}
            <div class="info-card"><h4>IP-Typ</h4><p>${r.ip_info?.type || '-'}</p></div>
            ${r.additional_info?.provider ? `<div class="info-card"><h4>Provider</h4><p>${r.additional_info.provider}</p></div>` : ''}
        `;
    } catch (e) {
        results.innerHTML = `<div class="info-card error"><h4>Fehler</h4><p>${e.message}</p></div>`;
    }
}

// Network Animation
(function() {
    const canvas = document.getElementById('networkCanvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    let width, height, particles = [];
    const particleCount = 40;
    
    function init() {
        resize();
        particles = [];
        for (let i = 0; i < particleCount; i++) {
            particles.push({
                x: Math.random() * width,
                y: Math.random() * height,
                vx: (Math.random() - 0.5) * 0.3,
                vy: (Math.random() - 0.5) * 0.3,
                r: Math.random() * 2 + 1
            });
        }
    }
    
    function resize() {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
    }
    
    function animate() {
        ctx.clearRect(0, 0, width, height);
        
        particles.forEach((p, i) => {
            p.x += p.vx;
            p.y += p.vy;
            
            if (p.x < 0 || p.x > width) p.vx *= -1;
            if (p.y < 0 || p.y > height) p.vy *= -1;
            
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(255,81,249,0.4)';
            ctx.fill();
            
            for (let j = i + 1; j < particles.length; j++) {
                const p2 = particles[j];
                const dx = p.x - p2.x;
                const dy = p.y - p2.y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                
                if (dist < 120) {
                    ctx.beginPath();
                    ctx.moveTo(p.x, p.y);
                    ctx.lineTo(p2.x, p2.y);
                    ctx.strokeStyle = `rgba(0,207,255,${(1 - dist / 120) * 0.2})`;
                    ctx.stroke();
                }
            }
        });
        
        requestAnimationFrame(animate);
    }
    
    window.addEventListener('resize', resize);
    init();
    animate();
})();
