<?php
include "connect.php";
echo "<br>";
echo '<a href="select.php">Terug naar overzicht</a><br>';
echo '<a href="insert.php">Toevoegen</a><br>';
 
if(isset($_POST['search'])) {
    $search = $_POST['search'];
 
    $sql = "SELECT * FROM cijfers WHERE eerling LIKE :search";
 
    $stmt = $conn->prepare($sql);
 
    $searchTerm = '%' . $search . '%';
 
    $stmt->bindParam(':search', $searchTerm);
 
    $stmt->execute();
 
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
 
 
<?php
    if($result) {
        echo "<br>";
        echo "<table id='studentTabel' border=1px>";
        echo "<tr>
            <th onclick='sortTable(0)'>leerling</th>
            <th onclick='sortTable(1)'>cijfer</th>
            <th onclick='sortTable(2)'>vak</th>
            <th onclick='sortTable(3)'>docent</th>
        </tr><tbody>";
 
        foreach ($result as $data) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($data['leerling']) . "</td>";
            echo "<td>" . htmlspecialchars($data['cijfer']) . "</td>";
            echo "<td>" . htmlspecialchars($data['vak']) . "</td>";
            echo "<td>" . htmlspecialchars($data['docent']) . "</td>";
            echo "</tr>";
        }
 
        echo "</tbody></table>";
    } else {
        echo "Geen resultaten gevonden voor de zoekterm: " . htmlspecialchars($search);
    }
}
?>
 
<script>
function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("studentTabel");
    switching = true;
    dir = "asc";
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount ++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
</script>
<br>
<form action="zoeken.php" method="POST">
    <input type="text" name="search" placeholder="Zoek op naam">
    <input type="submit" value="Zoeken">
</form>
