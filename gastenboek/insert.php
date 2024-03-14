

<?php
 
 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  echo "Er is gepost<br>";
  print_r($_POST);
 

 

  //- connect database
include "config.php";

// maak een query
$sql = " INSERT into brichten ( naam, bricht , datumtijd)
      VALUES( :naam, :bricht, :datumtijd);";
 
//prepare query
$query = $conn-> prepare($sql);

//uitvoeren 
$status = $query -> execute(
  [
  ':naam'=> $_POST['naam'],
  ':bricht'=> $_POST['bricht'],
  ':datumtijd'=> $_POST['datumtijd'],

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
  <link rel="stylesheet" href="style.css">
  
</head>
<body class="img">
 
<h1>Voeg een bricht </h1>
 
<form action="" method="post" enctype="multipart/form-data">
  <label for="naam">Naam:</label>
  <input type="text" id="naam" name="naam" required><br>
 
  <label for="bricht">bricht:</label>
  <input type="text" id="bricht" name="bricht" required><br>

  <label for="datumtijd">datumtijd:</label>
  <input  id="datumtijd" name="datumtijd" required><br>

  <input type="submit" value="Voeg Toe">
</form>
    
</body>
</html>
 
