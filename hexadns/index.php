<?php
/**
 * HexaDNS.de - DNS Tools & Server Landing Page
 */

$page_title = 'HexaDNS.de - DNS Tools & Server für HexaHost Dienste';
$page_description = 'HexaDNS.de - DNS-Tools, Propagation Check, WHOIS, SSL-Check und mehr. Der DNS-Server für alle HexaHost Dienste.';
$api_base = '/api';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta name="robots" content="index, follow">
    <meta name="author" content="HexaHost.de">
    <meta name="theme-color" content="#0d0821">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="HexaDNS.de">
    <meta property="og:title" content="HexaDNS.de - DNS Tools">
    <meta property="og:description" content="DNS-Tools, Propagation Check, WHOIS und mehr">
    <meta property="og:locale" content="de_DE">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Russo+One&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext y='.9em' font-size='90'%3E🌐%3C/text%3E%3C/svg%3E">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body data-api="<?php echo $api_base; ?>">
    <canvas class="network-bg" id="networkCanvas"></canvas>
    
    <header class="header">
        <nav class="nav">
            <div class="nav-left">
                <a href="/" class="logo">
                    <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    <span>HexaDNS</span>
                </a>
                <div class="status-badge"><span class="status-dot"></span>Alle Systeme online</div>
            </div>
            <a href="https://hexahost.de" class="nav-link">← HexaHost.de</a>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="hero-content">
                <svg class="hero-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/><circle cx="12" cy="12" r="3" fill="currentColor" opacity="0.3"/></svg>
                <h1><span class="highlight">HexaDNS</span> Tools</h1>
                <p>DNS Lookup, Propagation Check, WHOIS, SSL-Check und mehr.<br>Kostenlose DNS-Tools für Webmaster und Entwickler.</p>
            </div>
        </section>

        <section class="tools-section">
            <div class="tool-tabs">
                <button class="tool-tab active" data-tool="dns"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10"/></svg><span>DNS Lookup</span></button>
                <button class="tool-tab" data-tool="propagation"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><circle cx="12" cy="12" r="8"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/></svg><span>Propagation</span></button>
                <button class="tool-tab" data-tool="whois"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg><span>WHOIS</span></button>
                <button class="tool-tab" data-tool="ssl"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg><span>SSL Check</span></button>
                <button class="tool-tab" data-tool="ping"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg><span>Ping</span></button>
                <button class="tool-tab" data-tool="reverse"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg><span>Reverse DNS</span></button>
            </div>

            <!-- DNS Lookup Panel -->
            <div class="tool-panel active" id="panel-dns">
                <div class="tool-card glass">
                    <div class="tool-header">
                        <h2>DNS Lookup</h2>
                        <p>Frage DNS-Records einer Domain ab (A, AAAA, MX, NS, TXT, CNAME, SOA)</p>
                    </div>
                    <div class="input-group">
                        <input type="text" id="dns-domain" placeholder="z.B. hexahost.de" value="hexahost.de">
                        <button class="btn" onclick="dnsLookup()"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>Lookup</button>
                    </div>
                    <div class="results" id="dns-results"><div class="line comment">; Gib eine Domain ein und klicke auf "Lookup"</div></div>
                </div>
            </div>

            <!-- Propagation Panel -->
            <div class="tool-panel" id="panel-propagation">
                <div class="tool-card glass">
                    <div class="tool-header">
                        <h2>DNS Propagation Check</h2>
                        <p>Prüfe ob DNS-Änderungen weltweit propagiert wurden</p>
                    </div>
                    <div class="input-group">
                        <input type="text" id="prop-domain" placeholder="z.B. hexahost.de">
                        <select id="prop-type"><option value="A">A</option><option value="AAAA">AAAA</option><option value="MX">MX</option><option value="NS">NS</option><option value="TXT">TXT</option></select>
                        <button class="btn" onclick="propagationCheck()"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Prüfen</button>
                    </div>
                    <div id="prop-progress" style="display:none;"><div class="progress-bar"><div class="progress-fill" id="prop-progress-fill"></div></div><p style="text-align:center;color:var(--text-dim);font-size:0.9rem;">Abfrage läuft...</p></div>
                    <div id="prop-status" style="text-align:center;margin:1rem 0;"></div>
                    <div class="prop-grid" id="prop-results"></div>
                </div>
            </div>

            <!-- WHOIS Panel -->
            <div class="tool-panel" id="panel-whois">
                <div class="tool-card glass">
                    <div class="tool-header">
                        <h2>WHOIS Lookup</h2>
                        <p>Domain-Registrierungsinformationen abfragen</p>
                    </div>
                    <div class="input-group">
                        <input type="text" id="whois-domain" placeholder="z.B. hexahost.de">
                        <button class="btn" onclick="whoisLookup()"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>Abfragen</button>
                    </div>
                    <div class="info-grid" id="whois-results"></div>
                    <details style="margin-top:1rem;"><summary style="color:var(--text-dim);cursor:pointer;font-size:0.9rem;">Raw WHOIS-Daten anzeigen</summary><div class="results" id="whois-raw" style="margin-top:0.5rem;max-height:300px;"></div></details>
                </div>
            </div>

            <!-- SSL Panel -->
            <div class="tool-panel" id="panel-ssl">
                <div class="tool-card glass">
                    <div class="tool-header">
                        <h2>SSL/TLS Check</h2>
                        <p>Zertifikat-Informationen und Gültigkeit prüfen</p>
                    </div>
                    <div class="input-group">
                        <input type="text" id="ssl-domain" placeholder="z.B. hexahost.de">
                        <button class="btn" onclick="sslCheck()"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>Prüfen</button>
                    </div>
                    <div class="info-grid" id="ssl-results"></div>
                </div>
            </div>

            <!-- Ping Panel -->
            <div class="tool-panel" id="panel-ping">
                <div class="tool-card glass">
                    <div class="tool-header">
                        <h2>Ping & Verfügbarkeit</h2>
                        <p>Erreichbarkeit einer Domain über verschiedene Protokolle testen</p>
                    </div>
                    <div class="input-group">
                        <input type="text" id="ping-domain" placeholder="z.B. hexahost.de">
                        <button class="btn" onclick="pingCheck()"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>Testen</button>
                    </div>
                    <div class="info-grid" id="ping-results"></div>
                </div>
            </div>

            <!-- Reverse DNS Panel -->
            <div class="tool-panel" id="panel-reverse">
                <div class="tool-card glass">
                    <div class="tool-header">
                        <h2>Reverse DNS Lookup</h2>
                        <p>IP-Adresse zu Hostname auflösen (PTR-Record)</p>
                    </div>
                    <div class="input-group">
                        <input type="text" id="reverse-ip" placeholder="z.B. 8.8.8.8">
                        <button class="btn" onclick="reverseLookup()"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>Auflösen</button>
                    </div>
                    <div class="info-grid" id="reverse-results"></div>
                </div>
            </div>
        </section>

        <!-- DNS Explanation -->
        <section class="dns-explain">
            <div class="dns-explain-container">
                <h2 class="section-title">DNS Record-Typen erklärt</h2>
                <div class="record-types">
                    <div class="record-type glass">
                        <div class="record-type-header"><span class="record-type-badge">A</span><h3>Address Record</h3></div>
                        <p>Verknüpft eine Domain mit einer <code>IPv4-Adresse</code>. Der wichtigste Record-Typ - ohne ihn kann keine Website aufgerufen werden.</p>
                    </div>
                    <div class="record-type glass">
                        <div class="record-type-header"><span class="record-type-badge">AAAA</span><h3>IPv6 Address</h3></div>
                        <p>Wie A-Record, aber für <code>IPv6-Adressen</code>. Wichtig für die Zukunft des Internets, da IPv4-Adressen knapp werden.</p>
                    </div>
                    <div class="record-type glass">
                        <div class="record-type-header"><span class="record-type-badge">MX</span><h3>Mail Exchange</h3></div>
                        <p>Definiert welche Server <code>E-Mails</code> für die Domain empfangen. Die Priorität (niedrigere = bevorzugt) regelt die Reihenfolge.</p>
                    </div>
                    <div class="record-type glass">
                        <div class="record-type-header"><span class="record-type-badge">NS</span><h3>Nameserver</h3></div>
                        <p>Zeigt auf die <code>autoritativen DNS-Server</code> der Domain. Diese Server kennen alle DNS-Records der Domain.</p>
                    </div>
                    <div class="record-type glass">
                        <div class="record-type-header"><span class="record-type-badge">TXT</span><h3>Text Record</h3></div>
                        <p>Speichert beliebigen Text. Wird oft für <code>SPF</code>, <code>DKIM</code>, <code>DMARC</code> (E-Mail-Sicherheit) und Domain-Verifikation genutzt.</p>
                    </div>
                    <div class="record-type glass">
                        <div class="record-type-header"><span class="record-type-badge">CNAME</span><h3>Canonical Name</h3></div>
                        <p>Erstellt einen <code>Alias</code> für eine andere Domain. z.B. <code>www.example.de</code> → <code>example.de</code></p>
                    </div>
                </div>

                <div class="dns-flow glass">
                    <h3>Wie funktioniert eine DNS-Abfrage?</h3>
                    <div class="flow-container">
                        <div class="flow-step">
                            <span class="flow-step-num">1</span>
                            <svg class="flow-step-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                            <strong>Browser</strong>
                            <p>Fragt: "Was ist die IP von hexahost.de?"</p>
                        </div>
                        <span class="flow-arrow">→</span>
                        <div class="flow-step">
                            <span class="flow-step-num">2</span>
                            <svg class="flow-step-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                            <strong>DNS Resolver</strong>
                            <p>Sucht in Cache oder fragt weiter</p>
                        </div>
                        <span class="flow-arrow">→</span>
                        <div class="flow-step">
                            <span class="flow-step-num">3</span>
                            <svg class="flow-step-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10"/></svg>
                            <strong>Root Server</strong>
                            <p>Verweist auf .de TLD-Server</p>
                        </div>
                        <span class="flow-arrow">→</span>
                        <div class="flow-step">
                            <span class="flow-step-num">4</span>
                            <svg class="flow-step-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            <strong>Autoritativer NS</strong>
                            <p>Antwortet: "185.x.x.x"</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section class="features">
            <h2 class="section-title">Warum HexaDNS?</h2>
            <div class="features-grid">
                <div class="feature glass">
                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    <h3>Schnelle Auflösung</h3>
                    <p>Optimierte DNS-Server für minimale Latenzzeiten.</p>
                </div>
                <div class="feature glass">
                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    <h3>DNSSEC Support</h3>
                    <p>Kryptographische Absicherung gegen DNS-Spoofing.</p>
                </div>
                <div class="feature glass">
                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <h3>Standort Deutschland</h3>
                    <p>Server-Infrastruktur in Deutschland für Datenschutz.</p>
                </div>
                <div class="feature glass">
                    <svg class="feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <h3>99.9% Uptime</h3>
                    <p>Redundante Systeme für maximale Verfügbarkeit.</p>
                </div>
            </div>
        </section>

        <!-- DNS Servers -->
        <section class="dns-servers">
            <div class="dns-servers-container">
                <h2 class="section-title">HexaDNS Nameserver</h2>
                <p style="color:var(--text-dim);margin-bottom:1rem;">Für HexaHost-Domains verwenden</p>
                <div class="server-cards">
                    <div class="server-card glass"><h4>Primär</h4><span class="server-name">ns1.wob.hexadns.de</span></div>
                    <div class="server-card glass"><h4>Sekundär</h4><span class="server-name">ns2.wob.hexadns.de</span></div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> HexaDNS.de - Ein Service von HexaHost.de</p>
        <div class="footer-links">
            <a href="https://hexahost.de">HexaHost.de</a>
            <a href="https://hexahost.de/impressum">Impressum</a>
            <a href="https://hexahost.de/datenschutz">Datenschutz</a>
            <a href="https://hexahost.de/contact">Kontakt</a>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>
