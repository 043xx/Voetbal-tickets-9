<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$user]);
    $account = $stmt->fetch();

//    if ($account && password_verify($pass, $account['password'])) {
//        $_SESSION['user'] = $account['username'];
//        echo "Welkom, " . htmlspecialchars($account['username']) . "! Je bent ingelogd.";
// We vergelijken nu direct of de tekst uit het formulier 
// exact hetzelfde is als de tekst uit de database
if ($account && $pass === $account['password']) {
    $_SESSION['user'] = $account['username'];
    echo "Welkom, " . htmlspecialchars($account['username']) . "! Je bent ingelogd.";
} else {
        echo "Onjuiste gegevens.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inloggen.css">
    <title>Inloggen | Eredivisie</title>
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <h2>Inloggen</h2>
            <form method="POST" action="login_process.php">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Gebruikersnaam" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Wachtwoord" required>
                </div>
                <button type="submit" class="login-button">Inloggen</button>
            </form>
            <p class="register-link">Nog geen account? <a href="register.php">Registreer hier</a></p>
                <p class="register-link"> <a href="index.html"> Terug naar home</a></p>
        </div>
    </div>

</body>
</html>