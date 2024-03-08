<?php
session_start(); // start of hervat de sessie

// centroleer of de sessievariabele voor gebruiker bestaat

if(!isset($_SESSION['gebruiker'])){
    //zo niet , omleiden naar de inlogpagina 
    heaeder("location: inloggen.php");
    exit();
}
//  als de sessie wel bestaat, toon dan de welkomstboodschap 
$gebruikersnaam = $_SESSION['gebruiker'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http_equiv = "X-UA-compatible" content = "IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welkom </title>
</head>
<body>
    <h1> welkom <?php echo htmlspecialchars($gebruikersnaam)?>!<h1>
   <p>je bent succesvol ingelogd</p>
    
   <?php
   if($gebruikersnaam =='admin')
   {
    echo"<p></p><a herf='wachtwoordwijzigen.php'>Admin kan wachtwoord wijzigen </a></p>";
   }
   ?>
   <a href="logout.php">uitloggen</a>
</body>
</html>