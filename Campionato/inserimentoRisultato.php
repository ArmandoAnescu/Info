<?php
require 'header.php';
require 'connection.php'
?>
<div class="container mt-5 pt-5">
    <button id="return"><i class="bi bi-arrow-left"></i></button>
    <form action="insert.php?action=risultato" method="post">
        <label for="posizione">Inserisci la posizione</label>
        <br>
        <input type="number" name="posizione">
        <br>
        <label for="numero">Inserisci il numero del pilota</label>
        <br>
        <input type="number" name="numero">
        <br>
        <label for="id_gara">Inserisci l'id della gara</label>
        <br>
        <input type="number" name="id_gara">
        <br>
        <button id="submit" type="submit">Inserisci</button>
    </form>
</div>
<?php
require 'footer.php'
?>
