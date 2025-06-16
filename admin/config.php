<?php
/**
 * Admin-Konfiguration für Fliesen Runnebaum
 * Kundenfreundliche Version - Einfach und sicher
 */

// Sitzung starten
session_start();

// Zeitzone setzen
date_default_timezone_set('Europe/Berlin');

// Fehlerbehandlung (Fehler verstecken für Sicherheit)
ini_set('display_errors', 0);
error_reporting(E_ALL);

// ==========================================
// GRUNDLEGENDE SICHERHEIT
// ==========================================

// Session-Sicherheit
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_samesite', 'Strict');

// Session-Timeout (30 Minuten)
define('SESSION_TIMEOUT', 1800);

// Login-Versuche begrenzen (5 Versuche, dann 15 Min Sperre)
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_LOCKOUT_TIME', 900);

// ==========================================
// ADMIN-ZUGANGSDATEN
// ==========================================

define('ADMIN_USERNAME', 'admin'); 
define('ADMIN_PASSWORD_HASH', '$2y$10$ub.y.9C7o3MQWShdfWcm..8zEYVOHXtmx1Xe1AsURmmT1hKNpHfGG'); 

// ==========================================
// PFADE
// ==========================================

define('BASE_PATH', dirname(__DIR__));
define('DATA_PATH', BASE_PATH . '/data');
define('TILE_DATA_FILE', DATA_PATH . '/tile-of-month.json');
define('UPLOAD_PATH', BASE_PATH . '/assets/img/tile-of-month');

// Verzeichnisse erstellen
if (!is_dir(DATA_PATH)) {
    mkdir(DATA_PATH, 0755, true);
}

if (!is_dir(UPLOAD_PATH)) {
    mkdir(UPLOAD_PATH, 0755, true);
}

// ==========================================
// EINFACHE SICHERHEITSFUNKTIONEN
// ==========================================

/**
 * Client-IP ermitteln
 */
function get_client_ip() {
    return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
}

/**
 * CSRF-Token generieren
 */
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * CSRF-Token validieren
 */
function validate_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Einfaches Logging (nur bei kritischen Ereignissen)
 */
function simple_security_log($message) {
    $log_file = DATA_PATH . '/security.log';
    $log_entry = date('Y-m-d H:i:s') . " - " . $message . PHP_EOL;
    file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
}

/**
 * Login-Versuche prüfen (vereinfacht)
 */
function check_login_attempts($ip) {
    $attempts_file = DATA_PATH . '/login_attempts.json';
    $attempts = [];
    
    if (file_exists($attempts_file)) {
        $attempts = json_decode(file_get_contents($attempts_file), true) ?: [];
    }
    
    // Alte Versuche löschen
    $current_time = time();
    foreach ($attempts as $attempt_ip => $data) {
        if ($current_time - $data['last_attempt'] > LOGIN_LOCKOUT_TIME) {
            unset($attempts[$attempt_ip]);
        }
    }
    
    // Prüfen ob IP blockiert ist
    if (isset($attempts[$ip]) && $attempts[$ip]['count'] >= MAX_LOGIN_ATTEMPTS) {
        if ($current_time - $attempts[$ip]['last_attempt'] < LOGIN_LOCKOUT_TIME) {
            $remaining = LOGIN_LOCKOUT_TIME - ($current_time - $attempts[$ip]['last_attempt']);
            return [
                'blocked' => true,
                'remaining_minutes' => ceil($remaining / 60)
            ];
        }
    }
    
    return ['blocked' => false];
}

/**
 * Fehlgeschlagenen Login registrieren
 */
function register_failed_login($ip) {
    $attempts_file = DATA_PATH . '/login_attempts.json';
    $attempts = [];
    
    if (file_exists($attempts_file)) {
        $attempts = json_decode(file_get_contents($attempts_file), true) ?: [];
    }
    
    if (!isset($attempts[$ip])) {
        $attempts[$ip] = ['count' => 0, 'last_attempt' => 0];
    }
    
    $attempts[$ip]['count']++;
    $attempts[$ip]['last_attempt'] = time();
    
    file_put_contents($attempts_file, json_encode($attempts, JSON_PRETTY_PRINT));
    
    // Nur bei vielen Versuchen loggen
    if ($attempts[$ip]['count'] >= 3) {
        simple_security_log("Mehrere fehlgeschlagene Login-Versuche von IP: $ip");
    }
}

/**
 * Erfolgreichen Login registrieren
 */
function register_successful_login($ip) {
    // Login-Versuche zurücksetzen
    $attempts_file = DATA_PATH . '/login_attempts.json';
    if (file_exists($attempts_file)) {
        $attempts = json_decode(file_get_contents($attempts_file), true) ?: [];
        unset($attempts[$ip]);
        file_put_contents($attempts_file, json_encode($attempts, JSON_PRETTY_PRINT));
    }
}

/**
 * Login-Status prüfen
 */
function require_login() {
    // Session-Timeout prüfen
    if (isset($_SESSION['admin_last_activity'])) {
        if (time() - $_SESSION['admin_last_activity'] > SESSION_TIMEOUT) {
            session_destroy();
            header('Location: index.php?timeout=1');
            exit;
        }
    }
    
    // Login-Status prüfen
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: index.php');
        exit;
    }
    
    // Session-Aktivität aktualisieren
    $_SESSION['admin_last_activity'] = time();
    
    // Session-ID alle 15 Minuten regenerieren
    if (!isset($_SESSION['admin_session_regenerate']) || 
        time() - $_SESSION['admin_session_regenerate'] > 900) {
        session_regenerate_id(true);
        $_SESSION['admin_session_regenerate'] = time();
    }
}

/**
 * Fehlermeldungen
 */
function show_error($message = 'Ein Fehler ist aufgetreten.', $type = 'danger') {
    $_SESSION['message'] = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    $_SESSION['message_type'] = $type;
}

/**
 * Erfolgsmeldungen
 */
function show_success($message) {
    show_error($message, 'success');
}

// Functions.php laden (falls vorhanden)
if (file_exists(__DIR__ . '/functions.php')) {
    require_once 'functions.php';
}
?>