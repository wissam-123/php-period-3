<?php
 
 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  echo "Er is gepost<br>";
  print_r($_POST);
 
 /* include "connect.php";
 
  $sql = "INSERT INTO cijfers (leerling, cijfer, vak, docent);"*/

  //- connect database
include "connect.php";

// maak een query
$sql = " INSERT into cijfers ( leerling, cijfer, vak, docent)
      VALUES( :leerling, :cijfer, :vak, :docent);";
 
//prepare query
$query = $conn-> prepare($sql);


//uitvoeren 
$status = $query -> execute(
  [
  ':leerling'=> $_POST['leerling'],
  ':cijfer'=> $_POST['cijfer'],
  ':vak'=> $_POST['vak'],
  ':docent'=> $_POST['docent'],

  ]
);

//test of insert gelukt is 
if($status== true){
  echo" toevoegen is gelukt";
} else{
  echo"toevoegen is niet gelukt";
}
}
 
?>
 
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>studenten Formulier</title>
</head>
<body>
 
<h1>Voeg een student Toe</h1>
 
<form action="" method="post" enctype="multipart/form-data">
  <label for="leerling">Leerling</label>
  <input type="text" id="leerling" name="leerling" required><br>
 
  <label for="cijfer">Cijfer:</label>
  <input type="number" id="cijfer" max="10" min="0" name="cijfer"  required><br>
 
  <label for="vak">Vak:</label>
  <input type="text" id="vak" name="vak" required><br>

  <label for="docent">Docent</label>
  <input type="text" id="docent" name="docent" required><br>
  <input type="submit" value="Voeg Toe">
</form>
 
</body>
</html>
 
