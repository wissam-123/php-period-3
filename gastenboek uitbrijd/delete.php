<?php
// Auteur : Wissam hatat 
// Functie: Verwijderen van berichten als beheerder
session_start();
include 'config.php';
 
// Controleren of de gebruiker is ingelogd en een beheerder is
if (!isset($_SESSION['gebruikersid']) || !isset($_SESSION['isadmin']) || $_SESSION['isadmin'] != 1) {
    header("Location: login.php");
    exit();
}
 
// Controleren of het bericht-ID is ingesteld en een geldige waarde heeft
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo "Ongeldig bericht-ID.";
    exit();
}
 
$bericht_id = $_POST['id'];
 
// Verwijderen van het bericht uit de database
$sql = "DELETE FROM gastenboek WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $bericht_id);
if ($stmt->execute()) {
    header("Location: homepage.php");
    exit();
} else {
    echo "Fout bij het verwijderen van het bericht.";
}
?>
 
 