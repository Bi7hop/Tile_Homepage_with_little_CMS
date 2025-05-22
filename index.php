<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fliesen Runnebaum - Ihr Fliesenleger in Steinfeld</title>
    <meta name="description" content="Professionelle Fliesenverlegung in Steinfeld und Umgebung. Qualität, Erfahrung und Zuverlässigkeit seit über 20 Jahren.">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/common.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/cookie.css">
    
    <style>
        :root {
            --primary-color: #126e82;
            --secondary-color: #f8f9fa;
            --accent-color: #d96941;
            --text-color: #333;
            --light-gray: #e9ecef;
            --dark-gray: #343a40;
            --white: #fff;
            --box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        body {
            margin: 0;
            font-family: 'Inter', 'Open Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.7;
            color: var(--text-color);
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .header {
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 0;
        }
        .logo {
            font-family: 'Montserrat', 'Poppins', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .hero {
            background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/img/mosaik.png');
            background-size: cover;
            background-position: center;
            min-height: 70vh;
            display: flex;
            align-items: center;
            color: var(--white);
            margin-bottom: 3rem;
            position: relative;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }
        .btn {
            display: inline-block;
            background-color: var(--accent-color);
            color: var(--white);
            padding: 0.9rem 1.8rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--white);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .loader {
            width: 50px;
            height: 50px;
            border: 3px solid var(--light-gray);
            border-radius: 50%;
            border-top-color: var(--primary-color);
            border-bottom-color: var(--accent-color);
            animation: spin 1s infinite ease-in-out;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    
    <script src="assets/js/animations.js" defer></script>
    <script src="assets/js/main.js" defer></script>
    <script src="assets/js/cookie.js" defer></script>
    <script src="assets/js/preloader.js" defer></script>
</head>
<body>
    <div class="preloader">
        <div class="loader"></div>
    </div>

    <header class="header">
        <div class="container">
            <nav class="navbar">
                <a href="index.html" class="logo">Fliesen Runnebaum</a>
                <button class="menu-toggle" aria-label="Menü öffnen">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="index.html" class="nav-link active">Start</a></li>
                    <li class="nav-item"><a href="leistungen.html" class="nav-link">Leistungen</a></li>
                    <li class="nav-item"><a href="galerie.html" class="nav-link">Galerie</a></li>
                    <li class="nav-item"><a href="kontakt.html" class="nav-link">Kontakt</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Fliesen Runnebaum</h1>
            <p>Ihr zuverlässiger Fliesenleger in Steinfeld und Umgebung</p>
            <a href="kontakt.html" class="btn">Jetzt anfragen</a>
        </div>
    </div>
</section>

<?php
// Datei mit den Fliesen-des-Monats-Daten laden
$tile_data_file = __DIR__ . '/data/tile-of-month.json';
$tile_data = [];

if (file_exists($tile_data_file)) {
    $tile_data = json_decode(file_get_contents($tile_data_file), true);
}

// Standardwerte für den Fall, dass keine Datei existiert
if (empty($tile_data)) {
    $tile_data = [
        'month' => date('F Y'),
        'title' => 'XXL-Betonoptik Fliesen',
        'description' => 'Moderne Großformatfliesen in zeitloser Betonoptik.',
        'features' => ['120×60cm', 'Frostsicher', 'Für Fußbodenheizung'],
        'old_price' => '59.95',
        'new_price' => '49.95',
        'main_image' => 'fliesedesmonats.png'
    ];
}
?>

<section class="tile-spotlight">
    <div class="container">
        <div class="tile-spotlight-inner">
            <div class="tile-spotlight-image">
                <img src="assets/img/tile-of-month/<?php echo htmlspecialchars($tile_data['main_image']); ?>" alt="<?php echo htmlspecialchars($tile_data['title']); ?> - <?php echo htmlspecialchars($tile_data['month']); ?>" width="400" height="300">
                <div class="tile-spotlight-badge">
                    <span class="tile-badge-text">FLIESE DES MONATS</span>
                    <span class="tile-badge-month"><?php echo htmlspecialchars($tile_data['month']); ?></span>
                </div>
            </div>
            <div class="tile-spotlight-content">
                <h2><?php echo htmlspecialchars($tile_data['title']); ?></h2>
                <p><?php echo htmlspecialchars($tile_data['description']); ?></p>
                <div class="tile-spotlight-features">
                    <?php foreach ($tile_data['features'] as $feature): ?>
                        <span><?php echo htmlspecialchars($feature); ?></span>
                    <?php endforeach; ?>
                </div>
                <div class="tile-spotlight-price">
                    <div class="price-tag">
                        <span class="old-price"><?php echo htmlspecialchars($tile_data['old_price']); ?> €/m²</span>
                        <span class="new-price"><?php echo htmlspecialchars($tile_data['new_price']); ?> €/m²</span>
                    </div>
                    <a href="fliese-des-monats.php" class="btn">MEHR ERFAHREN</a>
                </div>
            </div>
        </div>
    </div>
</section>

    <main>
        <section class="container">
            <div class="about-section">
                <h2 class="animate-on-scroll">Willkommen bei Fliesen Runnebaum</h2>
                <div class="about-content">
                    <div class="about-text animate-on-scroll">
                        <p>Seit über 20 Jahren sind wir Ihr kompetenter Partner für hochwertige Fliesenarbeiten in Steinfeld und der gesamten Region. Ob Badezimmer, Küche, Wohnbereich oder Terrasse – wir verlegen Ihre Fliesen fachgerecht und mit Liebe zum Detail.</p>
                        <p>Unsere langjährige Erfahrung und das handwerkliche Können unseres Teams garantieren Ihnen ein perfektes Ergebnis. Wir beraten Sie gerne und setzen Ihre individuellen Wünsche professionell um.</p>
                        <a href="leistungen.html" class="btn">Unsere Leistungen</a>
                    </div>
                    <div class="about-image animate-on-scroll">
                        <img src="assets/img/olli.png" alt="Fliesenleger bei der Arbeit" width="600" height="400" loading="lazy">
                    </div>
                </div>
            </div>
        </section>

        <!-- <section class="services-preview">
            <div class="container">
                <h2 class="text-center animate-on-scroll">Unsere Leistungen im Überblick</h2>
                <div class="services-grid">
                    <div class="service-card animate-on-scroll">
                        <img src="assets/img/bad.png" alt="Badezimmer" width="400" height="300" loading="lazy">
                        <h3>Badezimmer</h3>
                        <p>Moderne Bäder mit hochwertigen Fliesen in verschiedenen Designs und Formaten.</p>
                    </div>
                    <div class="service-card animate-on-scroll">
                        <img src="assets/img/küche.png" alt="Küche" width="400" height="300" loading="lazy">
                        <h3>Küche</h3>
                        <p>Funktionale und stilvolle Fliesenlösungen für Ihre Küche, die höchsten Ansprüchen gerecht werden.</p>
                    </div>
                    <div class="service-card animate-on-scroll">
                        <img src="assets/img/terasse.png" alt="Terrasse" width="400" height="300" loading="lazy">
                        <h3>Außenbereich</h3>
                        <p>Robuste und wetterfeste Fliesen für Terrassen, Balkone und Eingangsbereiche.</p>
                    </div>
                </div>
                <div class="services-cta animate-on-scroll">
                    <a href="leistungen.html" class="btn">Alle Leistungen entdecken</a>
                </div>
            </div>
        </section> -->

        <section class="cta-section">
            <div class="container">
                <div class="cta-content">
                    <h2>Sind Sie bereit für Ihr neues Fliesenprojekt?</h2>
                    <p>Kontaktieren Sie uns für eine unverbindliche Beratung und ein individuelles Angebot.</p>
                    <a href="kontakt.html" class="btn">Jetzt Kontakt aufnehmen</a>
                </div>
            </div>
        </section>
    </main>

    <section class="map-section">
        <div class="container">
            <h2 class="animate-on-scroll">Hier finden Sie uns</h2>
            <div class="map-container animate-on-scroll">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d19488.590502229807!2d8.380192836889648!3d52.57118990000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47b9ddd7f45f6d71%3A0x55a8d0f4b5d3af18!2sSteinfeld%2C%20Germany!5e0!3m2!1sen!2sus!4v1721127701744!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <h3>Fliesen Runnebaum</h3>
                    <p>Musterstraße 123<br>49439 Steinfeld</p>
                    <p>Telefon: 05492 / 12345<br>E-Mail: info@fliesen-runnebaum.de</p>
                </div>
                <div class="footer-nav">
                    <h3>Navigation</h3>
                    <ul>
                        <li><a href="index.html">Start</a></li>
                        <li><a href="leistungen.html">Leistungen</a></li>
                        <li><a href="galerie.html">Galerie</a></li>
                        <li><a href="kontakt.html">Kontakt</a></li>
                    </ul>
                </div>
                <div class="footer-hours">
                    <h3>Öffnungszeiten</h3>
                    <p>Mo - Fr: 8:00 - 17:00 Uhr<br>Sa: Nach Vereinbarung<br>So: Geschlossen</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Fliesen Runnebaum. Alle Rechte vorbehalten.</p>
                <p><a href="impressum.html">Impressum</a> | <a href="datenschutz.html">Datenschutz</a></p>
            </div>
        </div>
    </footer>
    <a href="#" class="back-to-top" aria-label="Nach oben scrollen">&#8679;</a>

    <div id="cookie-modal" class="modal-overlay">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title">Cookie-Einstellungen</h3>
            <button class="modal-close" id="cookie-close">&times;</button>
        </div>
        <div class="modal-body">
            <p>Diese Website verwendet Cookies, um Ihre Erfahrung zu verbessern. Notwendige Cookies werden immer aktiviert. Sie können jedoch wählen, ob Sie Analyse- und Marketing-Cookies zulassen möchten.</p>
            
            <div class="cookie-options">
                <div class="cookie-option">
                    <input type="checkbox" id="essential-cookies" checked disabled>
                    <label for="essential-cookies">
                        <strong>Notwendige Cookies</strong>
                        <p>Diese Cookies sind für die Grundfunktionen der Website erforderlich und können nicht deaktiviert werden.</p>
                    </label>
                </div>
                
                <div class="cookie-option">
                    <input type="checkbox" id="analytics-cookies">
                    <label for="analytics-cookies">
                        <strong>Analyse-Cookies</strong>
                        <p>Diese Cookies helfen uns, die Nutzung der Website zu verstehen und zu verbessern.</p>
                    </label>
                </div>
                
                <div class="cookie-option">
                    <input type="checkbox" id="marketing-cookies">
                    <label for="marketing-cookies">
                        <strong>Marketing-Cookies</strong>
                        <p>Diese Cookies werden verwendet, um relevante Werbung anzuzeigen.</p>
                    </label>
                </div>
            </div>
            
            <p class="cookie-info-text">Weitere Informationen finden Sie in unserer <a href="datenschutz.html">Datenschutzerklärung</a>.</p>
        </div>
        <div class="modal-footer">
            <button id="cookie-reject-all" class="btn btn-secondary">Alle ablehnen</button>
            <button id="cookie-save" class="btn">Auswahl speichern</button>
            <button id="cookie-accept-all" class="btn">Alle akzeptieren</button>
        </div>
    </div>
</div>
</body>
</html>