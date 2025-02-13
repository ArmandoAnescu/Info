<?php
require 'header.php';
require 'connection.php'
?>
<div class="container mt-5 pt-5">
    <button id="return"><i class="bi bi-arrow-left"></i></button>
    <form action="insert.php?action=casa" method="post">
        <label for="name">Inserisci il nome della livrea:</label>
        <br>
        <input type="text" name="name" id="name">
        <br>
        <label for="lname">Inserisci il colore della livrea:</label>
        <br>
        <input type="text" name="color" id="color">
        <br>
        <button id="submit" type="submit">Inserisci</button>
    </form>
</div>
<?php
require 'footer.php'
?>
