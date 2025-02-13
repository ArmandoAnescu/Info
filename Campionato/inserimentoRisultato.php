<?php
require 'header.php';
require 'connection.php'
?>
<div class="container mt-5 pt-5">
    <button id="return"><i class="bi bi-arrow-left"></i></button>
    <form action="insert.php?action=pilota" method="post">

        <br>
        <button id="submit" type="submit">Inserisci</button>
    </form>
</div>
<?php
require 'footer.php'
?>
