<?php
require 'components/header.php';
require 'connection.php';
$lingue=OttieniLingue();

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
        <form action="action_page.php?action=register" method="post">
            <h1>Registrazione Utente</h1>
                <label for="nome">Nome:</label>
            <br>
                <input type="text" id="nome" name="nome" required><br><br>
            <br>
                <label for="email">Email:</label>
            <br>
                <input type="email" id="email" name="email" required><br><br>
            <br>
                <label for="password">Password:</label>
            <br>
                <input type="password" id="password" name="password" required><br><br>
            <br>
                <label for="nazionalita">Nazionalità:</label>
            <br>
                <input type="text" id="nazionalita" name="nazionalita" required><br><br>
            <br>
                <label for="telefono">Telefono:</label>
            <br>
                <input type="tel" id="telefono" name="telefono" required><br><br>
            <br>
                <lable for="lingua_base">Lingua</lable>
            <br>
                <select name="lingua_base">
                    <?php
                    foreach ($lingue as $lingua){
                    ?>
                            <option value="<?=$lingua['id']?>"> <?=$lingua['nome']?></option>
                        <?php }
                    ?>
                </select>
            <br>
            <br>
                <button class="submit" type="submit">Registrati</button>
        </form>
    </div>

    </body>
    </html>
<?php
require 'components/footer.php';
?>