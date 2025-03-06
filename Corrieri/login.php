<?php
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="action_page.php?action=login" method="post">
        <label for="email">Email</label>
        <br>
        <input type="email" required id=email name="email">
        <br>
        <label for="password">Password</label>
        <br>
        <input type="password" required name="password" id="passwors">
        <br>
        <br>
        <input type="submit" name="invio" id="invio" placeholder="Invio">
    </form>
</body>
</html>
