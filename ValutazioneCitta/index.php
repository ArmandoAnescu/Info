<?php
require 'citta.php';
$citta=require 'citta.php';
session_set_cookie_params(60,"/");
session_start();
// Check if session is expired
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60)) {
    // Session expired - destroy it and redirect
    session_unset();
    session_destroy();
    header("Location: message.php");
    exit();
}
// Update last activity time
$_SESSION['LAST_ACTIVITY'] = time();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<p id="timer"></p>
 <form action="visualizza.php" method="post">
    <?php
    foreach ($citta as $city){
    ?>
        <label for="<?=$city?>"><?=$city?></label>
        <br>
        <input type="number" MIN="1" MAX="5" NAME="<?=$city?>" id="<?=$city?>" value="1" >
        <br>
    <?php }
    ?>
     <input type="submit" placeholder="Invio">
 </form>
</body>
</html>
<script src="script.js"></script>
