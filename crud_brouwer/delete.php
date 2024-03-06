<?php
// auteur: Wigmans
// functie: verwijder een bier op basis van de brouwcode
include 'functions.php';

// Haal bier uit de database
if(isset($_GET['brouwcode'])){

    // test of insert gelukt is
    if(deleteBrouwer($_GET['brouwcode']) == true){
        echo '<script>alert("Brouwercode: ' . $_GET['brouwcode'] . ' is verwijderd")</script>';
        echo "<script> location.replace('main.php'); </script>";
    } else {
        echo '<script>alert("Brouwer is NIET verwijderd")</script>';
    }
}
?>

