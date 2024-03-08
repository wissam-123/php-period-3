<?php
//wachtwoord_wijzigen_verwerken.php
require 'config.php';
session_start();

if(isset($_POST['username']) && isset($_POST['newPassword'])){
    $username = $_POST['username'];
    $newPassword = password_hash($_POST['newPassword'],PASSWORD_DEFAULT); // hush het nieuwe wachtwoord

    try{
        $db = new PDO("mysql:host=$host,dbname=$dbname",$user,$pass);
         // Prepare the query to update the password
         $query = $db->prepare("UPDATE gebruikers SET password = :newPassword WHERE username = :username");
         $query->bindParam(':newPassword', $newPassword);
         $query->bindParam(':username', $username);
       // Execute the query and check for success
       if ($query->execute()) {
        echo " het wachtwoord voor gebruikers $username is succesvol gewijzegd . <br> <a herf ='inloggen.php'> ga teurg</a>";
    } else {
        echo "ER is een fout opgetreden bij hetc  wijzigen van het wachtwoord.";
    }
    } catch(PDOException $e){
    die("Error! :".$e -> getMessage());
    }
} else {
    echo "vul alle velden in";
}
?>