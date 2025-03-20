<?php
include 'header.php';
require 'connection.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$sedi = OttieniSedi();
$clienti = OttieniClienti();
$stati = OttieniStati();
$dipendenti = OttieniDipendenti();

$id_plico = $_REQUEST['id'] ?? null;
$plico = null;

if ($id_plico) {
    $plico = OttieniPlicoPerID($id_plico); // Funzione che recupera il plico dal database
}
?>
<!DOCTYPE html>
<html>

<head>
    <title><?= $plico ? "Modifica Plico" : "Inserimento Plico" ?></title>
</head>

<body>
    <div class="container mt-5 pt-5">
        <h2><?= $plico ? "Modifica Plico" : "Inserisci un nuovo Plico" ?></h2>
        <form action="action_page.php?action=plico" method="POST">
            <input type="hidden" name="id_plico" value="<?= $plico['id'] ?? '' ?>">

            <label>Mittente:</label>
            <br>
            <select name="cliente">
                <?php foreach ($clienti as $cliente) { ?>
                    <option value="<?= $cliente['email']; ?>" <?= ($plico && $plico['cliente'] == $cliente['email']) ? 'selected' : '' ?>>
                        <?= $cliente['nome'] . ' ' . $cliente['cognome']; ?>
                    </option>
                <?php } ?>
            </select>
            <br>

            <label>Sede di Partenza:</label>
            <br>
            <select name="sede_partenza">
                <?php foreach ($sedi as $sede) { ?>
                    <option value="<?= $sede['id']; ?>" <?= ($plico && $plico['sede_partenza'] == $sede['id']) ? 'selected' : '' ?>>
                        <?= $sede['nome']; ?>
                    </option>
                <?php } ?>
            </select>
            <br>

            <label>Sede di Arrivo:</label>
            <br>
            <select name="sede_arrivo">
                <?php foreach ($sedi as $sede) { ?>
                    <option value="<?= $sede['id']; ?>" <?= ($plico && $plico['sede_arrivo'] == $sede['id']) ? 'selected' : '' ?>>
                        <?= $sede['nome']; ?>
                    </option>
                <?php } ?>
            </select>
            <br>

            <label>Responsabile:</label>
            <br>
            <select name="responsabile">
                <?php foreach ($dipendenti as $dipendente) { ?>
                    <option value="<?= $dipendente['email']; ?>" <?= ($plico && $plico['responsabile'] == $dipendente['email']) ? 'selected' : '' ?>>
                        <?= $dipendente['nome']; ?>
                    </option>
                <?php } ?>
            </select>
            <br>

            <label>Data e Ora di Consegna:</label>
            <br>
            <input type="datetime-local" name="consegna" value="<?= $plico['consegna'] ?? '' ?>" required>
            <br>

            <label>Ora di Spedizione:</label>
            <br>
            <input type="datetime-local" name="spedizione" value="<?= $plico['spedizione'] ?? '' ?>">
            <br>

            <label>Data e Ora di Arrivo:</label>
            <br>
            <input type="datetime-local" name="ritiro" value="<?= $plico['ritiro'] ?? '' ?>">
            <br>

            <label>Stato:</label>
            <br>
            <select name="stato">
                <?php foreach ($stati as $stato) { ?>
                    <option value="<?= $stato['nome']; ?>" <?= ($plico && $plico['stato'] == $stato['nome']) ? 'selected' : '' ?>>
                        <?= $stato['nome']; ?>
                    </option>
                <?php } ?>
            </select>
            <br><br>

            <button type="submit">
                <?= $plico ? "Aggiorna Plico" : "Inserisci Plico" ?>
            </button>
        </form>
    </div>
</body>

</html>
<?php
include 'footer.php';
?>