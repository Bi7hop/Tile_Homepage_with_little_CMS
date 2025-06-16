<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Nur POST-Requests erlauben
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Nur POST-Requests erlaubt']);
    exit;
}

// Konfiguration
$config = [
    'to_email' => 'bi7hop@googlemail.com', 
    'from_email' => 'noreply@fliesen-runnebaum.net', 
    'subject_prefix' => 'Kontaktanfrage von Website - ',
    'max_message_length' => 5000,
    'honeypot_field' => 'website', 
    'rate_limit_minutes' => 5, 
];

session_start();
$client_ip = $_SERVER['REMOTE_ADDR'];
$last_submission_key = 'last_contact_' . md5($client_ip);

if (isset($_SESSION[$last_submission_key])) {
    $time_diff = time() - $_SESSION[$last_submission_key];
    if ($time_diff < ($config['rate_limit_minutes'] * 60)) {
        http_response_code(429);
        echo json_encode([
            'success' => false, 
            'message' => 'Bitte warten Sie ' . $config['rate_limit_minutes'] . ' Minuten zwischen den Anfragen.'
        ]);
        exit;
    }
}

// Input-Daten abrufen und sanitizen
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

// Honeypot-Check (Spam-Schutz)
if (!empty($_POST[$config['honeypot_field']])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Spam erkannt']);
    exit;
}

// Pflichtfelder prüfen
$required_fields = ['name', 'email', 'message', 'privacy'];
$errors = [];

foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        $errors[] = "Das Feld '$field' ist erforderlich.";
    }
}

// E-Mail-Validierung
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Bitte geben Sie eine gültige E-Mail-Adresse ein.';
}

// Datenschutz-Checkbox prüfen
if ($_POST['privacy'] !== 'on') {
    $errors[] = 'Sie müssen der Datenschutzerklärung zustimmen.';
}

// Nachrichtenlänge prüfen
$message = sanitize_input($_POST['message']);
if (strlen($message) > $config['max_message_length']) {
    $errors[] = 'Die Nachricht ist zu lang (max. ' . $config['max_message_length'] . ' Zeichen).';
}

// Bei Fehlern abbrechen
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        'success' => false, 
        'message' => 'Fehler bei der Validierung: ' . implode(' ', $errors)
    ]);
    exit;
}

// Daten für E-Mail vorbereiten
$name = sanitize_input($_POST['name']);
$phone = !empty($_POST['phone']) ? sanitize_input($_POST['phone']) : 'Nicht angegeben';
$subject_user = !empty($_POST['subject']) ? sanitize_input($_POST['subject']) : 'Allgemeine Anfrage';

// E-Mail-Betreff und -Inhalt erstellen
$email_subject = $config['subject_prefix'] . $subject_user;

$email_body = "
Neue Kontaktanfrage von der Website
=====================================

Name: $name
E-Mail: $email
Telefon: $phone
Betreff: $subject_user

Nachricht:
----------
$message

=====================================
Gesendet am: " . date('d.m.Y H:i:s') . "
IP-Adresse: $client_ip
User-Agent: " . $_SERVER['HTTP_USER_AGENT'] . "
";

// E-Mail-Headers setzen
$headers = [
    'From: ' . $config['from_email'],
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
    'Content-Type: text/plain; charset=UTF-8',
    'Content-Transfer-Encoding: 8bit'
];

// E-Mail versenden
$mail_sent = mail(
    $config['to_email'],
    $email_subject,
    $email_body,
    implode("\r\n", $headers)
);

if ($mail_sent) {
    // Rate Limiting aktualisieren
    $_SESSION[$last_submission_key] = time();
    
    // Log-Eintrag (optional)
    error_log("Kontaktformular: E-Mail erfolgreich versendet von $email");
    
    // Erfolgs-Response
    echo json_encode([
        'success' => true,
        'message' => 'Vielen Dank für Ihre Nachricht! Wir werden uns schnellstmöglich bei Ihnen melden.'
    ]);
} else {
    // Fehler beim E-Mail-Versand
    error_log("Kontaktformular: Fehler beim E-Mail-Versand von $email");
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Ein technischer Fehler ist aufgetreten. Bitte versuchen Sie es später erneut oder kontaktieren Sie uns telefonisch.'
    ]);
}
?>