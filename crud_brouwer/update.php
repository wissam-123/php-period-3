<?php
    // functie: update Brouwer
    // auteur: Wigmans

    require_once('functions.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST['btn_wzg'])){

        // test of update gelukt is
        if(updateBrouwer($_POST) == true){
            echo "<script>alert('Brouwer is gewijzigd')</script>";
        } else {
            echo '<script>alert("Brouwer is NIET gewijzigd")</script>';
        }
    }

    // Test of brouwcode is meegegeven in de URL
    if(isset($_GET['brouwcode'])){  
        // Haal alle info van de betreffende brouwcode $_GET['brouwcode']
        $brouwcode = $_GET['brouwcode'];
        $row = getBrouwer($brouwcode);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="wbrouwcodeth=device-wbrouwcodeth, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig Brouwer</title>
</head>
<body>
  <h2>Wijzig Brouwer</h2>
  <form method="post">
    
    <input type="hbrouwcodeden" brouwcode="brouwcode" name="brouwcode" required value="<?php echo $row['brouwcode']; ?>"><br>
    <label for="brouwcode">brouwcode:</label>
    <input type="text" brouwcode="brouwcode" name="brouwcode" required value="<?php echo $row['brouwcode']; ?>"><br>

    <label for="naam">naam:</label>
    <input type="text" brouwcode="naam" name="naam" required value="<?php echo $row['naam']; ?>"><br>

    <label for="land">land:</label>
    <input type="text" brouwcode="land" name="land" required value="<?php echo $row['land']; ?>"><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='main.php'>Home</a>
</body>
</html>

<?php
    } else {
        "Geen brouwcode opgegeven<br>";
    }
?>