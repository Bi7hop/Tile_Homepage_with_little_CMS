<?php
require_once 'config.php';

$error = '';

// Wenn Benutzer bereits eingeloggt ist, zum Dashboard weiterleiten
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

// Login-Formular verarbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === ADMIN_USERNAME && password_verify($password, ADMIN_PASSWORD)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = ADMIN_USERNAME;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Ungültige Zugangsdaten. Bitte versuchen Sie es erneut.';
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Fliesen Runnebaum Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin-style.css">
    <link rel="icon" href="assets/img/fliesenrunnebaum_favicon.ico" type="image/x-icon">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-header">
            <!-- Falls ein Logo vorhanden ist -->
            <img src="../assets/img/logo.png" alt="Fliesen Runnebaum" class="login-logo" onerror="this.style.display='none'">
            <h1>Fliesen Runnebaum</h1>
            <p>Admin-Bereich für Fliese des Monats</p>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-danger">
                <div class="alert-icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="alert-content">
                    <div class="alert-title">Anmeldung fehlgeschlagen</div>
                    <p><?php echo $error; ?></p>
                </div>
            </div>
        <?php endif; ?>
        
        <form class="login-form" method="post" action="">
            <div class="form-group">
                <label for="username">Benutzername</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>
            
            <div class="form-group">
                <label for="password">Passwort</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg">
                    <i class="fas fa-sign-in-alt btn-icon"></i>
                    Anmelden
                </button>
            </div>
        </form>
        
        <div class="login-footer">
            <p>&copy; <?php echo date('Y'); ?> Fliesen Runnebaum</p>
        </div>
    </div>
</body>
</html>