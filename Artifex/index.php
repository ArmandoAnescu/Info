<?php
include 'components/header.php';
?>
<div class="container mt-5 mb-5">
    <h1 class="mt-5 pt-5">Artifex Turismo</h1>
    <br>
    <?php
    if(!isset($_SESSION['email']) ){?>
        <h2>Per prenotare un evento bisogna <a href="register.php">Registarsi</a> o Eseguire il  <a href="login.php">Login</a></h2>
    <?php
    }else{
        ?>
        <p>Ciao <?=$_SESSION['username'] ?>, siamo felici di rivederti, ritorna alle tue <a href="prenotazioni.php">prenotazioni</a>
            o dai un'occhiata ai nostri <a href="visualizza.php">eventi</a> 👀</p>
        <?php
    }
    ?>
</div>
</main>
<?php
include 'components/footer.php'
?>
