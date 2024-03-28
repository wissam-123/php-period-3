<?php
// Verbinding maken met de database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "poll";

$conn = new mysqli($servername, $username, $password, $dbname);

// Controleren op fouten bij de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// // Query om de vraag op te halen
// $sql = "SELECT vraag FROM poll WHERE id = 1";
// $result = $conn->query($sql);

// // Controleren of er resultaten zijn
// if ($result->num_rows > 0) {
//     // Uitvoeren van de vraag
//     while($row = $result->fetch_assoc()) {
//         echo "<h2>" . $row["vraag"] . "</h2>";
//     }
// } else {
//     echo "Geen vraag gevonden";
// }


echo "<form action='stem_verwerken.php' method='post'>";
// Query om de opties op te halen
$sql = "SELECT id, antwoord FROM optie WHERE poll_id = 1";
$result = $conn->query($sql);

// Controleren of er resultaten zijn
if ($result->num_rows > 0) {
    // Uitvoeren van de opties
    while($row = $result->fetch_assoc()) {
        echo "<input type='radio' name='optie' value='" . $row["id"] . "'>" . $row["antwoord"] . "<br>";
    }
    // Verzendknop toevoegen
    echo "<input type='submit' name='submit' value='Verzenden'>";
    // Knop voor verwerken of verwijderen toevoegen
    echo "<input type='submit' name='action' value='Verwerken'>";
    echo "<input type='submit' name='action' value='Verwijderen'>";
} else {
    echo "Geen opties gevonden";
}

echo "</form>";

//hier oude
// Formulier maken om te stemmen
echo "<form action='stem_verwerken.php' method='post'>";
// Query om de opties op te halen
$sql = "SELECT id, antwoord FROM optie WHERE poll_id = 1";
$result = $conn->query($sql);

// Controleren of er resultaten zijn
if ($result->num_rows > 0) {
    // Uitvoeren van de opties
    while($row = $result->fetch_assoc()) {
        echo "<input type='radio' name='optie' value='" . $row["id"] . "'>" . $row["antwoord"] . "<br>";
    }
    // Verzendknop toevoegen
    echo "<input type='submit' value='Verzenden'>";
} else {
    echo "Geen opties gevonden";
}

echo "</form>";

// Databaseverbinding sluiten
$conn->close();
?>
