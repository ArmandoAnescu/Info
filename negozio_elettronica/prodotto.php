<?php
require 'header.php';
require 'connection.php';
if ($_REQUEST['action']==='update'){
    $prodotto=OttieniProdotto($_REQUEST['id']);
    }
?>
<div class="container mt-5 mb-5">
    <h1 class="mt-3 pt-3">Inserisci il prodotto:</h1>
    <div class="container">
        <form action="action_page.php?<?=$_REQUEST['action']==='update'?'action=update&codice='.$_REQUEST['id']:'action=insert'?> method="POST">
        <label for="codice">Codice:</label>
        <br>
        <input type="number" id="codice" name="codice" value="<?= isset($prodotto['codice']) ? $prodotto['codice'] : '' ?>" required><br><br>

        <label for="descrizione">Descrizione:</label>
        <br>
        <input type="text" id="descrizione" name="descrizione" maxlength="255" value="<?= isset($prodotto['descrizione']) ? $prodotto['descrizione'] : '' ?>" required><br><br>

        <label for="costo">Costo:</label>
        <br>
        <input type="number" step="0.01" id="costo" name="costo" value="<?= isset($prodotto['costo']) ? $prodotto['costo'] : '' ?>" required><br><br>

        <label for="quantita">Quantità:</label>
        <br>
        <input type="number" id="quantita" name="quantita" value="<?= isset($prodotto['quantita']) ? $prodotto['quantita'] : '' ?>" required><br><br>

        <label for="data_produzione">Data Produzione:</label>
        <br>
        <input type="date" id="data_produzione" name="data_produzione" value="<?= isset($prodotto['data_produzione']) ? $prodotto['data_produzione'] : '' ?>" required>
        <br>
        <button type="submit" id="submit">Inserisci</button>
        </form>
    </div>
</div>
<?php
require 'footer.php';
?>
