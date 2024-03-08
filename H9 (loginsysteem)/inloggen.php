<?php
// voeg de databaseconfiguratie toe 
require 'config.php';
// start een nieuwe sessie of hervat de bestaande sessie
session_start();
// controleer of het inlogformulier is verzonden

if (isset($_POST["inloggen"])) {
    try {
        // Maak een nieuwe databaseverbinding met PDO class
        $db = new PDO($dsn, $user, $pass);

        // Filter de gebruikersnaam om XSS-aanvallen te voorkomen
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);

        // Haal het wachtwoord direct uit de POST-array 
        $password = $_POST['password'];

        // Bereid de ingevoerde gebruikersnaam voor op de query
        $query = $db->prepare("SELECT * FROM gebruikers WHERE username = :user");

        // Bind de ingevoerde gebruikersnaam aan de query
        $query->bindParam(":user", $username, PDO::PARAM_STR);

        // Voer de query uit
        $query->execute();

        // Controleer of er precies één gebruiker is gevonden
        if ($query->rowCount() == 1) {
            // Haal de gebruikersgegevens op
            $result = $query->fetch();

            // Controleer of het ingevoerde wachtwoord overeenkomt met het gehashte wachtwoord in de database
            if (password_verify($password, $result["password"])) {
                // Sla de gebruikersnaam op in een sessievariabele 
                $_SESSION['gebruiker'] = $username;

                // Stuur de gebruiker door naar de welkom-pagina
                header("location: welkom.php");
                exit();
            } else {
                // Toon een foutmelding als het wachtwoord niet klopt
                echo "Onjuiste gegevens";
            }
        } else {
            // Toon een foutmelding als de gebruikersnaam niet is gevonden 
            echo "Onjuiste gegevens";
        }
    } catch (PDOException $e) {
        // Vang eventuele databaseverbindingfouten op
        die("Error!: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv = "X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inlogging </title>
</head>
<body>
    <h1> inloggen <h1>
    <form action="" method="post">
        <div>
  <label for="username"> gebruikersnaam:</label><br>
  <input type="text" id="username" name="username" required><br>
  </div>
<div>
  <label for="password">wachtwoord:</label><br>
  <input type="password" id="password" name="password" required><br><br>
  </div>
  <div>
  <input type="submit"  name= "inloggen" value="Inloggen">
  </div>
</form> 
<br/><a href="registreren.php"> Registreren</a>
</body>
</html>