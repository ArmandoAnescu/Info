<?php
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>myForm</title>
</head>
<body>
<h2>PHP form validation with main controllers</h2>
<form method="get" action="action_page.php">
    <label for="name">Inserisci il tuo nome</label>
    <br>
    <input type="text" id="name" placeholder="name" name="name"required>
    <br>
    <label for="surname">Inserisci il tuo cognome</label>
    <br>
    <input type="text" id="surname" placeholder="Surname" name="surname" required>
    <br><br>
    <input type="submit" value="Submit">
</form>
<script src="../myScript.js"></script>
</body>
</html>
