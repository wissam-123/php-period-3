
<?php
//- connect database
include "config.php";

// maak een query
$sql = " SELECT * FROM brichten";
 
//prepare query
$stmt = $conn-> prepare($sql);

//uitvoeren 
$stmt->execute();
//ophalen alle data 
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// print_r($result);

// print de data rij voor rij 

echo"<br>";
 echo"<table border=1px>";
 echo "<br>";
echo "<table border=1px>";
echo "<tr>";
echo "<th>naam</th>";
echo "<th> bricht</th>";
echo "<th>datumtijd</th>";
echo "<th>delet</th>";
echo "</tr>";
foreach($result as $row){
    echo"<tr>";
    echo "<td>". $row['naam'] . "</td>";
    echo "<td>".$row['bricht'] . "</td>";
    echo"<td>". $row['datumtijd'] . "</td>";
    echo"<td><a href='delet.php?id=" . $row['id'] . "'>" ."delete</a></td>";
    echo"<tr>";
}

echo"</table>";
 ?>
