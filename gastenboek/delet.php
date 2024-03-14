<?php
// Test of er data gepost is
if
    (isset($_GET['id']))
 {
//connect database  
include
"config.php"; 
// Maak een query 
$sql =
"
 DELETE FROM brichten
  WHERE id = :id";
// Prepare query 
$stmt =
$conn->prepare($sql);
// Uitvoeren
   
$stmt->execute([
        
':id'=>$_GET['id']
    ]);


   
if ($stmt->rowCount()
 == 1) {
       
echo
'<script>alert("bricht is deleted")</script>';
       
echo
"<script> location.replace('index.php'); </script>";
       
//header("Location: home2.php");
    }
else {
       
echo
"Delete is fout gegaan<br>";
    }
}


?>

