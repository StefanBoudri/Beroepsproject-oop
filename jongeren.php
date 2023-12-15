<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/jongeren.css">
  <link rel="stylesheet" href="css/nav.css">
  <title>Jongeren</title>
</head>

<body>

  <nav>
    <div class="logo">
      <a href="#">Jongeren Kansrijker</a>
    </div>
    <div class="menu">
      <a href="medewerkers.php">Medewerkers</a>
      <a href="jongeren.php">Jongeren</a>
      <a href="activiteiten.php">Activiteiten</a>
      <a href="instituten.php">Instituten</a>
      <a id="log" href="#">Inloggen / Uitloggen</a>
    </div>
  </nav>

  <h2>Jongeren</h2>

  <form action="databases/jongeren/set.php" method="post">
    <div class="input-group">
      <div class="input-field">
        <label for="activityInput">Voornaam:</label>
        <input type="text" id="firstNameInput" name="firstName" required>
      </div>

      <div class="input-field">
        <label for="lastNameInput">Achternaam:</label>
        <input type="text" id="lastNameInput" name="lastName" required>
      </div>

      <div class="input-field">
        <label for="birthInput">Geboortedatum:</label>
        <input type="date" id="birthInput" name="birthDate" required>
      </div>

      <button name="submit">Toevoegen</button>
    </div>
  </form>

  <table id="jongerenTable">
    <thead>
      <tr>
        <th>id</th>
        <th>Achternaam</th>
        <th>Voornaam</th>
        <th>Geboortedatum</th>
        <th>Actie</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        require_once 'databases/jongeren/jongeren.php';
        echo Jongere::DisplayJongere($pdo) 
      ?>
    
    </tbody>
  </table>

</body>

</html>