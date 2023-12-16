<?php
require 'dbconnect.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$statement = $pdo->prepare("SELECT * FROM jongeren WHERE id = :id" );
$statement->execute([':id' => $id]);

$jongere = $statement->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/jongeren.css">
    <link rel="stylesheet" href="../../css/nav.css">
    <title>Jongeren</title>
</head>

<body>

    <nav>
        <div class="logo">
            <a href="#">Jongeren Kansrijker</a>
        </div>
        <div class="menu">
            <a href="../../medewerkers.php">Medewerkers</a>
            <a href="../../jongeren.php">Jongeren</a>
            <a href="../../activiteiten.php">Activiteiten</a>
            <a href="../../instituten.php">Instituten</a>
            <a id="log" href="#">Inloggen / Uitloggen</a>
        </div>
    </nav>

    <h2><?php echo "Gegevens van " . $jongere["firstName"] . " " . $jongere["lastName"] . " bewerken" ?></h2>

    <form action="process.php" method="post">
        <div class="input-group">
            
            <input type="hidden" name="id" value="<?php echo $id ?>">
            
            <div class="input-field">
                <label for="activityInput">Voornaam:</label>
                <input type="text" id="firstNameInput" name="firstName" value="<?php echo $jongere["firstName"] ?>" required>
            </div>

            <div class="input-field">
                <label for="lastNameInput">Achternaam:</label>
                <input type="text" id="lastNameInput" name="lastName" value="<?php echo $jongere["lastName"] ?>" required>
            </div>

            <div class="input-field">
                <label for="birthInput">Geboortedatum:</label>
                <input type="date" id="birthInput" name="birthDate" value="<?php echo $jongere["birthDate"] ?>" required>
            </div>

            <button name="submit">bewerken</button>
        </div>
    </form>

</body>

</html>