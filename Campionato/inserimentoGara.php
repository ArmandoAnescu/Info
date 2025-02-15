<?php
require 'header.php';
require 'connection.php'
?>
<div class="container mt-5 pt-5">
    <button id="return"><i class="bi bi-arrow-left"></i></button>
    <form action="insert.php?action=gara" method="post">
        <label for="luogo">Luogo</label>
        <br>
        <input type="text" id="luogo" name="luogo" placeholder="Luogo" required>
        <br>
        <label for="data">Data</label>
        <br>
        <input type="date" id="data" name="data" required>
        <br>
        <label for="best_time">Tempo migliore</label>
        <br>
        <input type="text" id="best_time" name="best_time" placeholder="Tempo migliore" required>
        <br>
        <button id="submit" type="submit">Inserisci</button>
    </form>
</div>
<?php
require 'footer.php'
?>
