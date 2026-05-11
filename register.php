<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Haal de gegevens op uit de POST data
    $user  = $_POST['username'];
    $email = $_POST['email'];
    $name  = $_POST['name'];
    $lastname = $_POST['lastname']; // Sla dit op in een eigen variabele
    
    // 2. Veiligheid: Gebruik ALTIJD password_hash!
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    // 3. Bereid de query voor
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, name, lastname) VALUES (?, ?, ?, ?, ?)");
    
    try {
        // 4. Geef de variabelen in de juiste volgorde mee
        $stmt->execute([$user, $pass, $email, $name, $lastname]);
      $message = "<div class='alert success'>Account aangemaakt! <a href='index.html'>Log hier in</a></div>";
    } catch (Exception $e) {
        // Tip: Controleer of de foutmelding echt over een bestaande gebruiker gaat
        echo "Er is een fout opgetreden. Mogelijk bestaat de gebruikersnaam of het e-mailadres al.";
        // echo "Foutmelding voor debuggen: " . $e->getMessage(); 
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inloggen.css">
    <title>Registreren | Eredivisie</title>
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <h2>Registreren</h2>
            
            <form method="POST">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Gebruikersnaam" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Wachtwoord" required>
                </div>
                <div class="input-group">
                    <input type="text" name="name" placeholder="Voornaam" required>
                </div>
                <div class="input-group">
                    <input type="text" name="lastname" placeholder="Achternaam" required>
                </div>
                <div class="input-group">
                    <input type="email" name="email" placeholder="E-mail" required>
                </div>



                <a href=inloggen.php>
                <button type="submit" class="login-button">Maak account aan</button>
                </a>
                
            </form>
            
            <p class="register-link">Al een account? <a href="inloggen.php">Log hier in</a></p>
                   <p class="register-link"> <a href="index.html"> Terug naar home</a></p>

        </div>
        
    </div>

</body>
</html>