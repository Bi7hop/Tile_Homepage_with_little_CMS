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
    <link rel="icon" href="assets/img/fliesenrunnebaum_favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/common.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/cookie.css">

    <script src="assets/js/main.js" defer></script>
    <script src="assets/js/animations.js" defer></script>
    <script src="assets/js/cookie.js" defer></script>
    <script src="assets/js/preloader.js" defer></script>
    <script src="assets/js/lager-banner.js" defer></script>
</head>
<body>
    <div class="preloader">
        <div class="loader"></div>
    </div>

    <header class="header">
        <div class="container">
            <nav class="navbar">
                <a href="index.php" class="logo">Fliesen Runnebaum</a>
                <button class="menu-toggle" aria-label="Menü öffnen">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="index.php" class="nav-link active">Start</a></li>
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
                    <img src="assets/img/tile-of-month/<?php echo htmlspecialchars($tile_data['main_image']); ?>" 
                         alt="<?php echo htmlspecialchars($tile_data['title']); ?> - <?php echo htmlspecialchars($tile_data['month']); ?>" 
                         width="400" 
                         height="300">
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
        <h2>Hier finden Sie uns</h2>
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5553.16103854089!2d8.177531978027698!3d52.57729403198454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47b75ac6e19069b7%3A0xf14f911f9dc71425!2sRouen%20Kamp%201%2C%2049439%20Steinfeld%20(Oldenburg)!5e1!3m2!1sde!2sde!4v1750060174545!5m2!1sde!2sde"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Standort Fliesen Runnebaum - Rouen Kamp 1, 49439 Steinfeld">
            </iframe>
        </div>
    </div>
</section>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <h3>Fliesen Runnebaum</h3>
                    <p>Rouen Kamp 1<br>49439 Steinfeld</p>
                    <p>Telefon: 0176 / 10432567<br>E-Mail: info@fliesen-runnebaum.net</p>
                </div>
                <div class="footer-nav">
                    <h3>Navigation</h3>
                    <ul>
                        <li><a href="index.php">Start</a></li>
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
                <p>&copy; <?php echo date('Y'); ?> Fliesen Runnebaum. Alle Rechte vorbehalten.</p>
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