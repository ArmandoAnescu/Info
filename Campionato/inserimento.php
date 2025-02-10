<?php
require 'header.php';
?>

<body>
    <h1 class="mt-5 pt-5 form-title">Inserimento :</h1>
    <br>
    <select id="redirectSelect">
    <option value="">Seleziona un'opzione</option>
    <option value="form/inserimentoPilota.php">Pilota</option>
    <option value="form/inserimentoGara.php">Gara</option>
    <option value="form/inserimentoRisultato.php">Risultato</option>
    <option value="form/inserimentoCasa.php">Casa Automobilistica</option>
</select>

<?php
require 'footer.php';
?>