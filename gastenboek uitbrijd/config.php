<?php
// Auteur: Wissam hatat
// Functie: Databaseverbinding instellen
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gastenboek";
 
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Er is iets mis..";
}
?>