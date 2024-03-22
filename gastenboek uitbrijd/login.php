<?php
// Auteur: Wissam Hatat 
// Functie: Het maken van een simpel loginsysteem
session_start();
include 'config.php';
 
// Verwerken van het inlogformulier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord'];
 
    // Controleren of de gebruiker bestaat in de database
    $stmt = $conn->prepare("SELECT id, gebruikersnaam, wachtwoord, isadmin FROM gebruikers WHERE gebruikersnaam = :gebruikersnaam");
    $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
    if ($user) {
        // Controleren of het wachtwoord overeenkomt
        if (password_verify($wachtwoord, $user['wachtwoord'])) {
            // Gebruikergegevens in de sessie opslaan en doorsturen naar de homepage
            $_SESSION['gebruikersid'] = $user['id'];
            $_SESSION['gebruikersnaam'] = $user['gebruikersnaam'];
            $_SESSION['isadmin'] = $user['isadmin'];
            header("Location: homepage.php");
            exit();
        } else {
            $error_message = "Ongeldige gebruikersnaam of wachtwoord.";
        }
    } else {
        $error_message = "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Log in</h2>
    <!-- Weergeven van eventuele foutmeldingen -->
    <?php if(isset($error_message)) { echo "<p>$error_message</p>"; } ?>
    <!-- Inlogformulier -->
    <form method="post" action="">
        <label for="gebruikersnaam">Gebruikersnaam:</label><br>
        <input type="text" id="gebruikersnaam" name="gebruikersnaam" required><br>
        <label for="wachtwoord">Wachtwoord:</label><br>
        <input type="password" id="wachtwoord" name="wachtwoord" required><br>
        <input type="submit" value="Inloggen">
    </form>
 
    <!-- Link naar registratiepagina -->
    <form action="register.php">
        <input type="submit" value="Nog niet geregistreerd? Registreer hier!">
    </form>
</body>
</html>

<?php
// Auteur:wissam hatat 
// Functie: Het maken van een registratiepagina
include 'config.php';
 
// Verwerken van het registratieformulier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
 
    // Controleren of de gebruikersnaam al bestaat
    $stmt = $conn->prepare("SELECT id FROM gebruikers WHERE gebruikersnaam = :gebruikersnaam");
    $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
    $stmt->execute();
 
    if ($stmt->rowCount() > 0) {
        echo "Deze gebruikersnaam bestaat al. Kies een andere.";
    } else {
        // Wachtwoord hashen en gebruiker toevoegen aan de database
        $hashed_wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $sql = "INSERT INTO gebruikers (gebruikersnaam, email, wachtwoord) VALUES (:gebruikersnaam, :email, :wachtwoord)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':wachtwoord', $hashed_wachtwoord);
        if ($stmt->execute()) {
            // Controleren of dit de eerste gebruiker is en deze markeren als beheerder
            if ($conn->lastInsertId() == 2) {
                $sql_admin = "UPDATE gebruikers SET isadmin = 1 WHERE id = 2";
                $conn->exec($sql_admin);
            }
            echo "Registratie succesvol!";
        } else {
            echo "Fout bij registratie.";
        }
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registratiepagina</title>
</head>
<body>
    <h2>Registreer</h2>
    <!-- Registratieformulier -->
    <form method="post" action="">
        <label for="gebruikersnaam">Gebruikersnaam:</label><br>
        <input type="text" id="gebruikersnaam" name="gebruikersnaam" required><br>
        <label for="wachtwoord">Wachtwoord:</label><br>
        <input type="password" id="wachtwoord" name="wachtwoord" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Registreren">
    </form>
</body>
</html>
 