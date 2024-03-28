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

// // Controleren of er op de verzendknop is geklikt
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (isset($_POST["optie"])) {
//         $optie_id = $_POST["optie"];
        
//         // Query om het aantal stemmen voor de gekozen optie te verhogen
//         $sql = "UPDATE optie SET stemmen = stemmen + 1 WHERE id = $optie_id";
        
//         if ($conn->query($sql) === TRUE) {
//             // Haal de gekozen optie op
//             $optie_sql = "SELECT antwoord FROM optie WHERE id = $optie_id";
//             $optie_result = $conn->query($optie_sql);
//             if ($optie_result->num_rows > 0) {
//                 $optie_row = $optie_result->fetch_assoc();
//                 $gekozen_optie = $optie_row["antwoord"];
//                 echo "Stem succesvol toegevoegd. Je hebt gekozen voor: " . $gekozen_optie;
//             } else {
//                 echo "Geen optie gevonden";
//             }
//         } else {
//             echo "Fout bij het stemmen: " . $conn->error;
//         }
//     } else {
//         echo "Geen optie geselecteerd";
//     }
// }


// Controleren of er op de verzendknop is geklikt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["optie"])) {
        $optie_id = $_POST["optie"];

        // Controleer of de knop Verwerken is ingediend
        if (isset($_POST['action']) && $_POST['action'] == 'Verwerken') {
            // Query om het aantal stemmen voor de gekozen optie te verhogen
            $sql = "UPDATE optie SET stemmen = stemmen + 1 WHERE id = $optie_id";

            if ($conn->query($sql) === TRUE) {
                // Haal de gekozen optie op
                $optie_sql = "SELECT antwoord FROM optie WHERE id = $optie_id";
                $optie_result = $conn->query($optie_sql);
                if ($optie_result->num_rows > 0) {
                    $optie_row = $optie_result->fetch_assoc();
                    $gekozen_optie = $optie_row["antwoord"];
                    echo "Stem succesvol toegevoegd. Je hebt gekozen voor: " . $gekozen_optie;
                } else {
                    echo "Geen optie gevonden";
                }
            } else {
                echo "Fout bij het stemmen: " . $conn->error;
            }
        }

        // Controleer of de knop Verwijderen is ingediend
        elseif (isset($_POST['action']) && $_POST['action'] == 'Verwijderen') {
            // Query om de optie te verwijderen
            $delete_sql = "DELETE FROM optie WHERE id = $optie_id";

            if ($conn->query($delete_sql) === TRUE) {
                echo "Optie succesvol verwijderd.";
            } else {
                echo "Fout bij het verwijderen van de optie: " . $conn->error;
            }
        }
    } else {
        echo "Geen optie geselecteerd";
    }
}




// Databaseverbinding sluiten
$conn->close();
?>
