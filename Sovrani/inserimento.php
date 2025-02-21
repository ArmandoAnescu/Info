<?php
require 'header.php';
?>
<div class="container mt-5 pt-5">
    <form action="action_page.php" method="POST">
        <label for="nome" required>Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <label for="data_i" required>Inizio regno</label>
        <input type="date" name="data_i" id="data_i">
        <br>
        <label for="data_f">Fine regno</label>
        <input type="date" name="data_f" id="data_f">
        <br>
        <label for="img" required>Immagine:</label>
        <input type="image" src="" alt="" name="img">
        <br>
        <label for="prede" required>Predecessore:</label>
        <input type="text" id="prede" name="prede" required>
        <br>
        <br>
        <input type="submit" value="Inserisci">
    </form>
</div>
<?php
require 'footer.php';