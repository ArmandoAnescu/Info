<?php
include 'header.php';
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
<div class="container mt-5 pt-5 login">
    <form action="action_page.php?action=login" method="post">
        <label for="name">Name</label>
        <br>
        <input type="text" required name="name" id="name">
        <br>
        <label for="address">Indirizzo</label>
        <br>
        <input type="text" required name="address" id="address">
        <br>
        <label for="email">Email</label>
        <br>
        <input type="email" required id=email name="email">
        <br>
        <label for="telephone">Num. di telefono</label>
        <br>
        <input type="number" required name="telephone" id="telephone">
        <br>

        <br>
        <input type="submit" name="invio" id="submit" placeholder="Inserisci">
    </form>
</div>

</body>
</html>
<?php
include 'footer.php';
?>
