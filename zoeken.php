<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Search</title>
</head>
<body>
    <h2>Search for a Name</h2>
    <form action="zoeken.php" method="post">
        <label for="name">Enter Name:</label>
        <input type="text" name="name" required>
        <button type="submit">Search</button>
    </form>
</body>
</html>


<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_name = $_POST["name"];

    $sql = "SELECT * FROM cijfers WHERE leerling LIKE '%$search_name%'";
    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error: " . $conn->error;
    } else {
        $row_count = $result->rowCount();

        if ($row_count > 0) {
            echo "<h2>Search Results:</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Name</th></tr>";

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . $row["leerling"] . "</td></tr>";
                // You can display other information from the database as needed
            }

            echo "</table>";
         } else {
             echo "No results found for '$search_name'";
        }
    }
}


// Omitting $conn->close() for now, depending on your setup
?>
