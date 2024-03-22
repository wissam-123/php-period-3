<?php
// Auteur: Wissam hatat
// Functie: Aanpassen van berichten als beheerder
session_start();
include 'config.php';
 
// Controleren of de gebruiker is ingelogd en een beheerder is
if (!isset($_SESSION['gebruikersid']) || !isset($_SESSION['isadmin']) || $_SESSION['isadmin'] != 1) {
    header("Location: login.php");
    exit();
}
 
// Controleren of het bericht-ID is ingesteld en een geldige waarde heeft
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: homepage.php");
    exit();
}
 
$bericht_id = $_GET['id'];
 
// Ophalen van het geselecteerde bericht uit de database
$query = "SELECT * FROM gastenboek WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $bericht_id);
$stmt->execute();
$bericht = $stmt->fetch(PDO::FETCH_ASSOC);
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verwerken van de bewerkte berichtgegevens en bijwerken in de database
    $berichttekst = $_POST['bericht'];
    $sql_update = "UPDATE gastenboek SET bericht = :bericht WHERE id = :id";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bindParam(':bericht', $berichttekst);
    $stmt_update->bindParam(':id', $bericht_id);
    if ($stmt_update->execute()) {
        header("Location: homepage.php");
        exit();
    } else {
        echo "Fout bij bewerken van het bericht.";
    }
}
?>
 
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bericht Bewerken</title>
</head>
<body>
    <h2>Bericht Bewerken</h2>
    <!-- Formulier om het bericht te bewerken -->
    <form action="edit.php?id=<?php echo $bericht_id; ?>" method="post">
        <label for="bericht">Bericht:</label><br>
        <textarea id="bericht" name="bericht" rows="4" cols="50" required><?php echo $bericht['bericht']; ?></textarea><br>
        <button type="submit">Opslaan</button>
    </form>
</body>
</html>
 