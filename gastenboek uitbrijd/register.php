<?php
// Auteur: Wissam hatat
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
 
[09:44]wissam hatat 
homepage.php:
<?php
// Auteur:wissam hatat 
// Functie: Homepage maken om berichten te kunnen toevoegen.
session_start();
include 'config.php';
 
// Controleren of de gebruiker is ingelogd
if (!isset($_SESSION['gebruikersid'])) {
    header("Location: login.php");
    exit();
}
 
// Toevoegen van een nieuw bericht
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bericht = $_POST['bericht'];
    $gebruikersid = $_SESSION['gebruikersid'];
    $sql = "INSERT INTO gastenboek (gebruikersid, bericht) VALUES (:gebruikersid, :bericht)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':gebruikersid', $gebruikersid);
    $stmt->bindParam(':bericht', $bericht);
    if ($stmt->execute()) {
        header("Location: homepage.php");
        exit();
    } else {
        echo "Fout bij toevoegen van bericht.";
    }
}
 
// Query om alle berichten op te halen
$query = "SELECT gastenboek.*, gebruikers.gebruikersnaam FROM gastenboek INNER JOIN gebruikers ON gastenboek.gebruikersid = gebruikers.id ORDER BY gastenboek.datumtijd DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$berichten = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
 
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <h2>Welkom, <?php echo $_SESSION['gebruikersnaam']; ?></h2>
    <!-- Formulier om een nieuw bericht toe te voegen -->
    <form action="homepage.php" method="post">
        <label for="bericht">Bericht:</label><br>
        <input type="text" id="bericht" name="bericht" required><br>
        <button type="submit">Voeg Bericht Toe</button>
    </form>
 
    <!-- Toon alle berichten -->
    <h3>Berichten:</h3>
    <ul>
        <?php foreach ($berichten as $bericht): ?>
            <li>
                <!-- Toon de gebruikersnaam, bericht en datumtijd -->
                <strong><?php echo $bericht['gebruikersnaam']; ?>:</strong> <?php echo $bericht['bericht']; ?> (<?php echo $bericht['datumtijd']; ?>)
                <!-- Als de gebruiker een beheerder is, toon dan de bewerk- en verwijderknoppen -->
                <?php if(isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 1): ?>
                    <form action="edit.php" method="get" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $bericht['id']; ?>">
                        <button type="submit">Bewerk</button>
                    </form>
                    <form action="delete.php" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $bericht['id']; ?>">
                        <button type="submit">Verwijder</button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>