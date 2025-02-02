<?php
require 'header.php';
?>

<body>
    <h2 class="mt-5 pt-5 form-title">Inserimento libro:</h2>
    <br>
    <form method="post" action="inserimento.php">
    <label for="nomelibro">Inserisci il nome dei libri</label>
    <br>
    <input type="text" id="book" placeholder="name" name="nomelibro" required>
    <br>
    <label for="nomeautore">Inserisci l'autore</label>
    <br>
    <input type="text" id="author" placeholder="author" name="nomeautore" required>
    <br>
    <label for="genere">Inserisci il genere del libro</label>
    <br>
    <input type="text" id="genre" placeholder="es.Fantasy,romance" name="genere" required>
    <br>
    <label for="prezzo">Inserisci il prezzo</label>
    <br>
    <input type="number" id="price" name="prezzo" required>
    <br>
    <label for="annopubblicazione">Inserisci l'anno di pubblicazione</label>
    <br>
    <input type="date" name="annopubblicazione" id="year-of-publishment">
    <br> <br>
    <input type="submit" id="submit" value="Submit">
    </form>

<?php
require 'footer.php';
?>