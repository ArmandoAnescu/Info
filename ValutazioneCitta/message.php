<?php
session_start();
session_unset();
session_destroy();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Session Expired</title>
</head>
<body>
<h1>Oops</h1>
<p>Sessione finita per inattività.</p>
<p><a href="index.php">Clicca qui per tornare a votare.</a></p>
</body>
</html>