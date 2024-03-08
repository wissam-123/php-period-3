<?php
require 'config.php';

session_start();

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $query = $db->query("SELECT username FROM gebruikers");
    $gebruikers = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error!:" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wachtwoordwijzigen</title>
</head>
<body>
    <h1>wachtwoordwijzigen voor gebruiker <?php echo $_SESSION['user']['username']; ?>!</h1>
    <form action="verwerkingwachtwoord.php" method="post">
        <div>
            <label for="username">Selecteer gebruikersnaam:</label><br>
            <select id="username" name="username" required>
                <?php foreach ($gebruikers as $gebruiker) : ?>
                    <option value="<?= htmlspecialchars($gebruiker['username']) ?>"><?= htmlspecialchars($gebruiker['username']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="newPassword">Nieuw wachtwoord:</label><br>
            <input type="password" id="newPassword" name="newPassword" required>
        </div>
        <div>
            <input type="submit" value="Wachtwoord wijzigen">
        </div>
    </form>
</body>
</html>
