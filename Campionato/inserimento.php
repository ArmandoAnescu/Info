<?php
require 'header.php';
?>

<body>
    <h1 class="mt-5 pt-5 form-title">Inserimento :</h1>
    <br>
    <div class="container pt-5">
        <select id="redirectSelect">
            <option value="">Seleziona un'opzione</option>
            <option value="inserimentoPilota.php">Pilota</option>
            <option value="inserimentoGara.php">Gara</option>
            <option value="inserimentoRisultato.php">Risultato</option>
            <option value="inserimentoCasa.php">Casa Automobilistica</option>
        </select>
    </div>

<?php
require 'footer.php';
?>