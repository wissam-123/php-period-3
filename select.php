<?php
//- connect database
include "connect.php";

// maak een query
$sql = " SELECT * FROM cijfers";
 
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
echo "<th>leerling</th>";
echo "<th>cijfer</th>";
echo "<th>vak</th>";
echo "<th>docent</th>";
echo "<th>Id</th>";
echo "<th>Edit</th>";
echo "</tr>";
foreach($result as $row){
    echo"<tr>";
    echo "<td>". $row['leerling'] . "</td>";
    echo "<td>".$row['cijfer'] . "</td>";
    echo"<td>". $row['vak'] . "</td>";
    echo"<td>". $row['docent'] . "</td>";
    echo"<td>" . $row['id'] . "</td>";
    echo"<td><a href='delet.php?id=" . $row['id'] . "'>" ."delete</a></td>";
    echo"<tr>";
}

echo"</table>";
 ?>
