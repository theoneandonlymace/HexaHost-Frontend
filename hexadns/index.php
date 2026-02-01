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
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg-color: #0d0821;
            --primary: #ff51f9;
            --accent-1: #a348ff;
            --accent-2: #3978ff;
            --neon-blue: #00cfff;
            --success: #32fba2;
            --warning: #ffcc00;
            --error: #ff4d6d;
            --text: #ffffff;
            --text-dim: #cfc9dd;
            --glass-bg: rgba(255,255,255,0.05);
            --glass-border: rgba(255,255,255,0.1);
            --font: 'Inter', sans-serif;
            --font-logo: 'Russo One', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
        }
        body { font-family: var(--font); line-height: 1.6; color: var(--text); background: var(--bg-color); min-height: 100vh; overflow-x: hidden; }
        .glass { background: var(--glass-bg); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid var(--glass-border); border-radius: 1rem; }
        
        /* Header */
        .header { position: fixed; top: 0; left: 0; right: 0; z-index: 1000; background: rgba(13,8,33,0.9); backdrop-filter: blur(20px); border-bottom: 1px solid var(--glass-border); }
        .nav { max-width: 1400px; margin: 0 auto; padding: 0 1.5rem; display: flex; align-items: center; justify-content: space-between; height: 70px; }
        .nav-left { display: flex; align-items: center; gap: 1.5rem; }
        .logo { font-family: var(--font-logo); font-size: 1.5rem; text-decoration: none; display: flex; align-items: center; gap: 0.5rem; }
        .logo-icon { width: 40px; height: 40px; color: var(--primary); }
        .logo span { background: linear-gradient(135deg, var(--primary), var(--neon-blue)); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .status-badge { display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(50,251,162,0.1); border: 1px solid rgba(50,251,162,0.3); padding: 0.4rem 0.875rem; border-radius: 2rem; font-size: 0.8rem; font-weight: 500; color: var(--success); }
        .status-dot { width: 8px; height: 8px; background: var(--success); border-radius: 50%; animation: pulse 2s infinite; }
        @keyframes pulse { 0%,100% { opacity: 1; } 50% { opacity: 0.5; } }
        .nav-link { color: var(--text-dim); text-decoration: none; font-weight: 500; padding: 0.5rem 1rem; border-radius: 0.5rem; transition: 0.3s; }
        .nav-link:hover { color: var(--text); background: var(--glass-bg); }
        
        /* Network Background */
        .network-bg { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; }
        
        /* Hero */
        .hero { min-height: 70vh; display: flex; align-items: center; justify-content: center; padding: 120px 1.5rem 60px; text-align: center; }
        .hero-content { max-width: 800px; }
        .hero-icon { width: 100px; height: 100px; margin: 0 auto 1.5rem; color: var(--primary); animation: float 3s ease-in-out infinite; }
        @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
        .hero h1 { font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 700; margin-bottom: 1rem; }
        .highlight { background: linear-gradient(135deg, var(--primary), var(--neon-blue)); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .hero p { font-size: 1.1rem; color: var(--text-dim); margin-bottom: 2rem; }
        
        /* Tools Section */
        .tools-section { padding: 2rem 1.5rem 4rem; max-width: 1400px; margin: 0 auto; }
        .section-title { font-size: 1.75rem; font-weight: 700; text-align: center; margin-bottom: 2rem; }
        
        /* Tool Tabs */
        .tool-tabs { display: flex; flex-wrap: wrap; gap: 0.5rem; justify-content: center; margin-bottom: 2rem; padding: 0.5rem; border-radius: 1rem; background: rgba(0,0,0,0.2); }
        .tool-tab { padding: 0.75rem 1.25rem; border: none; background: transparent; color: var(--text-dim); font-family: var(--font); font-size: 0.9rem; font-weight: 500; cursor: pointer; border-radius: 0.75rem; transition: 0.3s; display: flex; align-items: center; gap: 0.5rem; }
        .tool-tab:hover { color: var(--text); background: var(--glass-bg); }
        .tool-tab.active { background: linear-gradient(135deg, var(--primary), var(--accent-1)); color: var(--text); }
        .tool-tab svg { width: 18px; height: 18px; }
        
        /* Tool Panels */
        .tool-panel { display: none; animation: fadeIn 0.3s ease; }
        .tool-panel.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        
        /* Tool Card */
        .tool-card { padding: 2rem; max-width: 900px; margin: 0 auto; }
        .tool-header { text-align: center; margin-bottom: 1.5rem; }
        .tool-header h2 { font-size: 1.5rem; margin-bottom: 0.5rem; }
        .tool-header p { color: var(--text-dim); font-size: 0.95rem; }
        
        /* Input Group */
        .input-group { display: flex; gap: 1rem; margin-bottom: 1.5rem; }
        .input-group input, .input-group select { flex: 1; padding: 0.875rem 1rem; border: 1px solid var(--glass-border); border-radius: 0.5rem; background: rgba(255,255,255,0.05); color: var(--text); font-family: var(--font); font-size: 1rem; transition: 0.3s; }
        .input-group input:focus, .input-group select:focus { outline: none; border-color: var(--primary); background: rgba(255,255,255,0.08); }
        .input-group input::placeholder { color: var(--text-dim); }
        .input-group select { min-width: 120px; flex: 0; cursor: pointer; }
        .input-group select option { background: var(--bg-color); }
        .btn { padding: 0.875rem 1.5rem; background: linear-gradient(135deg, var(--primary), var(--accent-1)); border: none; border-radius: 0.5rem; color: var(--text); font-family: var(--font); font-weight: 600; cursor: pointer; transition: 0.3s; display: flex; align-items: center; gap: 0.5rem; white-space: nowrap; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(255,81,249,0.4); }
        .btn:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
        .btn svg { width: 18px; height: 18px; }
        
        /* Results */
        .results { background: rgba(0,0,0,0.3); border-radius: 0.75rem; padding: 1.25rem; font-family: var(--font-mono); font-size: 0.85rem; min-height: 200px; max-height: 500px; overflow-y: auto; }
        .results::-webkit-scrollbar { width: 6px; }
        .results::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); border-radius: 3px; }
        .results::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 3px; }
        .line { padding: 0.2rem 0; animation: typeLine 0.2s ease forwards; }
        @keyframes typeLine { from { opacity: 0; transform: translateX(-5px); } to { opacity: 1; transform: translateX(0); } }
        .line.comment { color: var(--text-dim); }
        .line.header { color: var(--primary); font-weight: 600; }
        .line.record { color: var(--neon-blue); }
        .line.success { color: var(--success); }
        .line.warning { color: var(--warning); }
        .line.error { color: var(--error); }
        .line.info { color: var(--text-dim); }
        
        /* Propagation Grid */
        .prop-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1rem; margin-top: 1rem; }
        .prop-card { padding: 1rem; border-radius: 0.75rem; background: rgba(255,255,255,0.03); border: 1px solid var(--glass-border); }
        .prop-card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem; }
        .prop-card-header h4 { font-size: 0.95rem; font-weight: 600; }
        .prop-status { width: 10px; height: 10px; border-radius: 50%; }
        .prop-status.online { background: var(--success); }
        .prop-status.offline { background: var(--error); }
        .prop-card-info { font-size: 0.8rem; color: var(--text-dim); margin-bottom: 0.5rem; }
        .prop-card-result { font-family: var(--font-mono); font-size: 0.85rem; color: var(--neon-blue); word-break: break-all; }
        .prop-card-time { font-size: 0.75rem; color: var(--text-dim); margin-top: 0.5rem; }
        
        /* Progress Bar */
        .progress-bar { height: 6px; background: rgba(255,255,255,0.1); border-radius: 3px; overflow: hidden; margin: 1rem 0; }
        .progress-fill { height: 100%; background: linear-gradient(90deg, var(--primary), var(--neon-blue)); border-radius: 3px; transition: width 0.3s; }
        
        /* SSL/WHOIS Cards */
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-top: 1rem; }
        .info-card { padding: 1.25rem; border-radius: 0.75rem; background: rgba(255,255,255,0.03); border: 1px solid var(--glass-border); }
        .info-card h4 { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--primary); margin-bottom: 0.5rem; }
        .info-card p { font-size: 0.95rem; color: var(--text); word-break: break-all; }
        .info-card.success { border-color: rgba(50,251,162,0.3); }
        .info-card.warning { border-color: rgba(255,204,0,0.3); }
        .info-card.error { border-color: rgba(255,77,109,0.3); }
        
        /* DNS Explanation Section */
        .dns-explain { padding: 4rem 1.5rem; background: rgba(255,255,255,0.02); }
        .dns-explain-container { max-width: 1200px; margin: 0 auto; }
        .record-types { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 2rem; }
        .record-type { padding: 1.5rem; transition: transform 0.3s, box-shadow 0.3s; }
        .record-type:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(255,81,249,0.2); }
        .record-type-header { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; }
        .record-type-badge { padding: 0.25rem 0.75rem; background: linear-gradient(135deg, var(--primary), var(--accent-1)); border-radius: 0.5rem; font-family: var(--font-mono); font-size: 0.85rem; font-weight: 600; }
        .record-type h3 { font-size: 1.1rem; font-weight: 600; }
        .record-type p { color: var(--text-dim); font-size: 0.9rem; line-height: 1.6; }
        .record-type code { background: rgba(0,207,255,0.1); color: var(--neon-blue); padding: 0.1rem 0.4rem; border-radius: 0.25rem; font-family: var(--font-mono); font-size: 0.85rem; }
        
        /* DNS Flow Animation */
        .dns-flow { margin-top: 3rem; padding: 2rem; text-align: center; }
        .dns-flow h3 { margin-bottom: 2rem; font-size: 1.25rem; }
        .flow-container { display: flex; align-items: center; justify-content: center; gap: 1rem; flex-wrap: wrap; padding: 2rem 0; }
        .flow-step { padding: 1rem 1.5rem; border-radius: 0.75rem; background: var(--glass-bg); border: 1px solid var(--glass-border); min-width: 120px; text-align: center; position: relative; }
        .flow-step-num { position: absolute; top: -10px; left: 50%; transform: translateX(-50%); width: 24px; height: 24px; background: var(--primary); border-radius: 50%; font-size: 0.75rem; font-weight: 700; display: flex; align-items: center; justify-content: center; }
        .flow-step-icon { width: 32px; height: 32px; margin: 0 auto 0.5rem; color: var(--neon-blue); }
        .flow-step p { font-size: 0.85rem; color: var(--text-dim); }
        .flow-step strong { display: block; margin-bottom: 0.25rem; color: var(--text); }
        .flow-arrow { color: var(--primary); font-size: 1.5rem; }
        
        /* Features Section */
        .features { padding: 4rem 1.5rem; max-width: 1200px; margin: 0 auto; }
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; }
        .feature { padding: 1.5rem; text-align: center; transition: transform 0.3s; }
        .feature:hover { transform: translateY(-5px); }
        .feature-icon { width: 48px; height: 48px; margin: 0 auto 1rem; color: var(--primary); }
        .feature h3 { font-size: 1.1rem; margin-bottom: 0.5rem; }
        .feature p { color: var(--text-dim); font-size: 0.9rem; }
        
        /* DNS Server Info */
        .dns-servers { padding: 4rem 1.5rem; background: rgba(255,255,255,0.02); }
        .dns-servers-container { max-width: 800px; margin: 0 auto; text-align: center; }
        .server-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-top: 2rem; }
        .server-card { padding: 1.5rem; text-align: center; }
        .server-card h4 { color: var(--primary); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.75rem; }
        .server-name { font-family: var(--font-mono); font-size: 1rem; color: var(--neon-blue); background: rgba(0,207,255,0.1); padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; }
        
        /* Footer */
        .footer { padding: 3rem 1.5rem 2rem; text-align: center; border-top: 1px solid var(--glass-border); margin-top: 4rem; }
        .footer p { color: var(--text-dim); font-size: 0.875rem; margin-bottom: 1rem; }
        .footer-links { display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap; }
        .footer-links a { color: var(--text-dim); text-decoration: none; font-size: 0.875rem; transition: 0.3s; }
        .footer-links a:hover { color: var(--primary); }
        
        /* Responsive */
        @media (max-width: 768px) {
            .nav-left .status-badge { display: none; }
            .input-group { flex-direction: column; }
            .input-group select { min-width: 100%; }
            .btn { width: 100%; justify-content: center; }
            .tool-tabs { gap: 0.25rem; }
            .tool-tab { padding: 0.6rem 0.8rem; font-size: 0.8rem; }
            .tool-tab span { display: none; }
            .flow-container { flex-direction: column; }
            .flow-arrow { transform: rotate(90deg); }
            .footer-links { flex-direction: column; gap: 1rem; }
        }
        
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    </style>
</head>
<body>
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

    <script>
        const API = '<?php echo $api_base; ?>';
        
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
            if (el) el.addEventListener('keypress', e => { if (e.key === 'Enter') el.closest('.tool-card').querySelector('.btn').click(); });
        });
        
        // DNS Lookup
        async function dnsLookup() {
            const domain = document.getElementById('dns-domain').value.trim();
            const results = document.getElementById('dns-results');
            if (!domain) { results.innerHTML = '<div class="line error">Bitte Domain eingeben</div>'; return; }
            results.innerHTML = '<div class="line comment">; Abfrage läuft...</div>';
            try {
                const res = await fetch(`${API}/dns-lookup.php?domain=${encodeURIComponent(domain)}`);
                const data = await res.json();
                if (data.error) { results.innerHTML = `<div class="line error">; Fehler: ${data.error}</div>`; return; }
                displayDnsResults(data);
            } catch (e) { results.innerHTML = `<div class="line error">; Netzwerkfehler: ${e.message}</div>`; }
        }
        
        function displayDnsResults(data) {
            const results = document.getElementById('dns-results');
            let html = `<div class="line comment">; <<>> HexaDNS Lookup <<>> ${data.domain}</div><div class="line comment">; Abfrage um ${data.timestamp}</div><div class="line comment">;</div>`;
            const r = data.records;
            if (r.A?.length) { html += `<div class="line header">;; A RECORDS (IPv4):</div>`; r.A.forEach(a => html += `<div class="line record">${data.domain}.    ${a.ttl}    IN    A    ${a.ip}</div>`); }
            if (r.AAAA?.length) { html += `<div class="line header">;; AAAA RECORDS (IPv6):</div>`; r.AAAA.forEach(a => html += `<div class="line record">${data.domain}.    ${a.ttl}    IN    AAAA    ${a.ipv6}</div>`); }
            if (r.NS?.length) { html += `<div class="line header">;; NS RECORDS:</div>`; r.NS.forEach(a => html += `<div class="line record">${data.domain}.    ${a.ttl}    IN    NS    ${a.target}</div>`); }
            if (r.MX?.length) { html += `<div class="line header">;; MX RECORDS:</div>`; r.MX.forEach(a => html += `<div class="line record">${data.domain}.    ${a.ttl}    IN    MX    ${a.priority} ${a.target}</div>`); }
            if (r.TXT?.length) { html += `<div class="line header">;; TXT RECORDS:</div>`; r.TXT.forEach(a => html += `<div class="line record">${data.domain}.    ${a.ttl}    IN    TXT    "${a.txt}"</div>`); }
            if (r.CNAME?.length) { html += `<div class="line header">;; CNAME RECORDS:</div>`; r.CNAME.forEach(a => html += `<div class="line record">${data.domain}.    ${a.ttl}    IN    CNAME    ${a.target}</div>`); }
            if (r.SOA?.length) { html += `<div class="line header">;; SOA RECORD:</div>`; r.SOA.forEach(a => html += `<div class="line record">${data.domain}.    ${a.ttl}    IN    SOA    ${a.mname} ${a.rname} ${a.serial}</div>`); }
            html += `<div class="line comment"></div><div class="line success">;; Query time: ${data.query_time_ms} msec</div><div class="line success">;; WHEN: ${data.timestamp}</div>`;
            results.innerHTML = html;
        }
        
        // Propagation Check
        async function propagationCheck() {
            const domain = document.getElementById('prop-domain').value.trim();
            const type = document.getElementById('prop-type').value;
            const results = document.getElementById('prop-results');
            const status = document.getElementById('prop-status');
            const progress = document.getElementById('prop-progress');
            if (!domain) { status.innerHTML = '<span class="error">Bitte Domain eingeben</span>'; return; }
            results.innerHTML = ''; status.innerHTML = ''; progress.style.display = 'block';
            document.getElementById('prop-progress-fill').style.width = '30%';
            try {
                const res = await fetch(`${API}/dns-propagation.php?domain=${encodeURIComponent(domain)}&type=${type}`);
                document.getElementById('prop-progress-fill').style.width = '100%';
                setTimeout(() => progress.style.display = 'none', 500);
                const data = await res.json();
                if (data.error) { status.innerHTML = `<span class="error">${data.error}</span>`; return; }
                const ps = data.propagation_status;
                const color = ps.percentage === 100 ? 'var(--success)' : ps.percentage > 50 ? 'var(--warning)' : 'var(--error)';
                status.innerHTML = `<div style="font-size:2rem;font-weight:700;color:${color}">${ps.percentage}%</div><div style="color:var(--text-dim)">propagiert (${ps.servers_responding}/${ps.total_servers} Server)</div>`;
                results.innerHTML = data.servers.map(s => `<div class="prop-card"><div class="prop-card-header"><h4>${s.server}</h4><span class="prop-status ${s.records.length ? 'online' : 'offline'}"></span></div><div class="prop-card-info">${s.ip} • ${s.location}</div><div class="prop-card-result">${s.records.length ? s.records.join('<br>') : 'Keine Records'}</div><div class="prop-card-time">${s.response_time}ms</div></div>`).join('');
            } catch (e) { progress.style.display = 'none'; status.innerHTML = `<span class="error">Fehler: ${e.message}</span>`; }
        }
        
        // WHOIS Lookup
        async function whoisLookup() {
            const domain = document.getElementById('whois-domain').value.trim();
            const results = document.getElementById('whois-results');
            const raw = document.getElementById('whois-raw');
            if (!domain) { results.innerHTML = '<div class="info-card error"><h4>Fehler</h4><p>Bitte Domain eingeben</p></div>'; return; }
            results.innerHTML = '<div class="info-card"><h4>Laden...</h4><p>WHOIS-Daten werden abgefragt...</p></div>'; raw.innerHTML = '';
            try {
                const res = await fetch(`${API}/whois-lookup.php?domain=${encodeURIComponent(domain)}`);
                const data = await res.json();
                if (data.error) { results.innerHTML = `<div class="info-card error"><h4>Fehler</h4><p>${data.error}</p></div>`; return; }
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
            } catch (e) { results.innerHTML = `<div class="info-card error"><h4>Fehler</h4><p>${e.message}</p></div>`; }
        }
        
        // SSL Check
        async function sslCheck() {
            const domain = document.getElementById('ssl-domain').value.trim();
            const results = document.getElementById('ssl-results');
            if (!domain) { results.innerHTML = '<div class="info-card error"><h4>Fehler</h4><p>Bitte Domain eingeben</p></div>'; return; }
            results.innerHTML = '<div class="info-card"><h4>Laden...</h4><p>SSL-Zertifikat wird geprüft...</p></div>';
            try {
                const res = await fetch(`${API}/ssl-check.php?domain=${encodeURIComponent(domain)}`);
                const data = await res.json();
                const ssl = data.ssl;
                if (!ssl.has_ssl) { results.innerHTML = `<div class="info-card error"><h4>Kein SSL</h4><p>${ssl.error || 'Kein SSL-Zertifikat gefunden'}</p></div>`; return; }
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
            } catch (e) { results.innerHTML = `<div class="info-card error"><h4>Fehler</h4><p>${e.message}</p></div>`; }
        }
        
        // Ping Check
        async function pingCheck() {
            const domain = document.getElementById('ping-domain').value.trim();
            const results = document.getElementById('ping-results');
            if (!domain) { results.innerHTML = '<div class="info-card error"><h4>Fehler</h4><p>Bitte Domain eingeben</p></div>'; return; }
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
            } catch (e) { results.innerHTML = `<div class="info-card error"><h4>Fehler</h4><p>${e.message}</p></div>`; }
        }
        
        // Reverse DNS
        async function reverseLookup() {
            const ip = document.getElementById('reverse-ip').value.trim();
            const results = document.getElementById('reverse-results');
            if (!ip) { results.innerHTML = '<div class="info-card error"><h4>Fehler</h4><p>Bitte IP-Adresse eingeben</p></div>'; return; }
            results.innerHTML = '<div class="info-card"><h4>Laden...</h4><p>Reverse Lookup wird durchgeführt...</p></div>';
            try {
                const res = await fetch(`${API}/reverse-dns.php?ip=${encodeURIComponent(ip)}`);
                const data = await res.json();
                if (data.error) { results.innerHTML = `<div class="info-card error"><h4>Fehler</h4><p>${data.error}</p></div>`; return; }
                const r = data.result;
                results.innerHTML = `
                    <div class="info-card"><h4>IP-Adresse</h4><p>${data.ip}<br><small>${data.ip_version}</small></p></div>
                    <div class="info-card ${r.hostname ? 'success' : 'warning'}"><h4>Hostname</h4><p>${r.hostname || 'Kein PTR-Record gefunden'}</p></div>
                    ${r.forward_verified !== undefined ? `<div class="info-card ${r.forward_verified ? 'success' : 'warning'}"><h4>Forward-Check</h4><p>${r.forward_verified ? '✅ Verifiziert' : '⚠️ Nicht verifiziert'}</p></div>` : ''}
                    <div class="info-card"><h4>IP-Typ</h4><p>${r.ip_info?.type || '-'}</p></div>
                    ${r.additional_info?.provider ? `<div class="info-card"><h4>Provider</h4><p>${r.additional_info.provider}</p></div>` : ''}
                `;
            } catch (e) { results.innerHTML = `<div class="info-card error"><h4>Fehler</h4><p>${e.message}</p></div>`; }
        }
        
        // Network Animation
        (function() {
            const canvas = document.getElementById('networkCanvas');
            const ctx = canvas.getContext('2d');
            let width, height, particles = [];
            const particleCount = 40;
            function init() { resize(); particles = []; for (let i = 0; i < particleCount; i++) particles.push({ x: Math.random() * width, y: Math.random() * height, vx: (Math.random() - 0.5) * 0.3, vy: (Math.random() - 0.5) * 0.3, r: Math.random() * 2 + 1 }); }
            function resize() { width = canvas.width = window.innerWidth; height = canvas.height = window.innerHeight; }
            function animate() {
                ctx.clearRect(0, 0, width, height);
                particles.forEach((p, i) => {
                    p.x += p.vx; p.y += p.vy;
                    if (p.x < 0 || p.x > width) p.vx *= -1;
                    if (p.y < 0 || p.y > height) p.vy *= -1;
                    ctx.beginPath(); ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2); ctx.fillStyle = 'rgba(255,81,249,0.4)'; ctx.fill();
                    for (let j = i + 1; j < particles.length; j++) {
                        const p2 = particles[j], dx = p.x - p2.x, dy = p.y - p2.y, dist = Math.sqrt(dx*dx + dy*dy);
                        if (dist < 120) { ctx.beginPath(); ctx.moveTo(p.x, p.y); ctx.lineTo(p2.x, p2.y); ctx.strokeStyle = `rgba(0,207,255,${(1-dist/120)*0.2})`; ctx.stroke(); }
                    }
                });
                requestAnimationFrame(animate);
            }
            window.addEventListener('resize', resize);
            init(); animate();
        })();
    </script>
</body>
</html>
