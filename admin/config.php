<?php
// Sitzung starten
session_start();

// Zeitzone setzen
date_default_timezone_set('Europe/Berlin');

// Fehlerbericht-Einstellungen
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Zugangsdaten für Admin-Bereich
// SICHERHEITSHINWEIS: Das Passwort sollte über ein Tool wie https://www.php.net/manual/de/function.password-hash.php generiert werden
define('ADMIN_USERNAME', 'fliesenadmin');
define('ADMIN_PASSWORD', password_hash('sicheresPasswort123', PASSWORD_DEFAULT)); // Passwort in der Produktion ändern!

// Pfade
define('BASE_PATH', dirname(__DIR__));
define('DATA_PATH', BASE_PATH . '/data');
define('TILE_DATA_FILE', DATA_PATH . '/tile-of-month.json');
define('UPLOAD_PATH', BASE_PATH . '/assets/img/tile-of-month');
define('ADMIN_URL', '/admin');

// Verbindene Dateien
require_once 'functions.php';

// Sicherheitscheck - Nur für geschützte Seiten
function require_login() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: index.php');
        exit;
    }
}

// Benutzerfreundliche Fehlermeldungen
function show_error($message = 'Ein unbekannter Fehler ist aufgetreten.', $type = 'danger') {
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
}
?>