<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gebruikers toevogen</title>
</head>
<body>
    <h2>gebruikers registretren</h2>
    <form action="#" method="post">
        <div>
  <label for="username"> gebruikersnaam:</label><br>
  <input type="text" id="username" name="username" required><br>
  </div>
<div>
  <label for="password">wachtwoord:</label><br>
  <input type="password" id="password" name="password" required><br><br>
  </div>
  <div>
  <input type="submit"  name= "registreer" value="Registreer">
  </div>
</form> 
<?php

if(isset($_POST['registreer'])) {
    // Include the database configuration
    include 'config.php';

    try {
        // make een nieuwe database  verbinding
        $db = new PDO("mysql:host=$host;dbname=$dbname;", $user, $pass);

        // bereid een SQL query om nieuw gebruikers toe toevogen
       $query = $db->prepare("INSERT INTO gebruikers(username,password) VALUES(:username,:password)");
        // sanitize de gebruikersnaam en hash het wachtwoord
     
      $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_SPECIAL_CHARS);
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


        // BIND de waarden aan query parameters
       $query->bindParam(':username',$username);
       $query->bindParam(':password',$password);
        // voer de query uit en controleer op succes 
       
        if ($query->execute()) {
            echo "de nieuwe gwbruiker is succesvol toegevoegd!";
            // Optionally, you can redirect the user to a success page or log them in immediately
        } else {
            echo "Er is een fout opgetreden bij het toevegen";
        }
    } catch (PDOException $e) {
        //  vang en toon databaseverbinding
       die("Error: " . $e->getMessage());
    }
}

?>
<br><br><br>
<!-- link terug naar de inlogpagina- -->
 <a href="inloggen.php"> terug naar inlog pagina</a>

</body>
</html>
