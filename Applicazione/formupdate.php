<?php
$oldName = isset($_REQUEST['titolo']) ? $_REQUEST['titolo'] : '';
$oldAuthor = isset($_REQUEST['autore']) ? $_REQUEST['autore'] : '';
$oldGenre = isset($_REQUEST['genere']) ? $_REQUEST['genere'] : '';
$oldDate = isset($_REQUEST['anno_pubblicazione']) ? $_REQUEST['anno_pubblicazione'] : '';
$oldPrice = isset($_REQUEST['prezzo']) ? $_REQUEST['prezzo'] : '';
require 'header.php';

?>

<body>
    <h2 class="mt-5 pt-5 form-title">Aggiornamento libro:</h2>
    <br>
    <form method="post" action="aggiornamento.php?oldName=<?=$oldName?>$oldAuthor=<?=$oldAuthor?>">
        <label for="nomelibro">Inserisci il nome dei libri</label>
        <br>
        <input type="text" id="book" placeholder="name" name="nomelibro" value="<?=$oldName?>" required>
        <br>
        <label for="nomeautore">Inserisci l'autore</label>
        <br>
        <input type="text" id="author" placeholder="author" name="nomeautore" value="<?=$oldAuthor?>" required>
        <br>
        <label for="genere">Inserisci il genere del libro</label>
        <br>
        <input type="text" id="genre" placeholder="es.Fantasy,romance" name="genere" value="<?=$oldGenre ?>" required>
        <br>
        <label for="prezzo">Inserisci il prezzo</label>
        <br>
        <input type="number" id="price" name="prezzo" value="<?=$oldPrice ?>" required>
        <br>
        <label for="annopubblicazione">Inserisci l'anno di pubblicazione</label>
        <br>
        <input type="date" name="annopubblicazione" id="year-of-publishment" value="<?= $oldDate?>">
        <br> <br>
        <input type="submit" id="submit" value="Submit">
    </form>

<?php
//var_dump($_REQUEST);

require 'footer.php';
?>
