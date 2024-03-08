<?php
session_start(); //start of hervat de sessie
session_unset();//verwijder alle sessie veraiabelen
session_destroy(); // verwijder alle sessievaraibelen
header("Location: inloggen.php"); // omleiden naar de inlogpagina
exit();
?>
