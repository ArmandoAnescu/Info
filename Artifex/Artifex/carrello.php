<?php
// carrello.php
include 'components/header.php';
include 'connection.php';
$prenotazioni = OttieniPrenotazioni();
$somma = 0;
?>

<!-- Header della pagina -->
<div class="page-header text-center">
    <div class="container">
        <h1>Il tuo carrello</h1>
        <p>Rivedi i tuoi eventi selezionati e procedi al checkout</p>
    </div>
</div>

<div class="container mt-5 mb-5">
    <?php if($prenotazioni): ?>
        <div class="table-container">
            <table class="custom-table">
                <thead>
                <tr>
                    <th>Evento</th>
                    <th>Durata</th>
                    <th>Lingua</th>
                    <th>Prezzo</th>
                    <th>Azioni</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($prenotazioni as $prenotazione) {
                    $somma = $somma + $prenotazione['prezzo'];
                    ?>
                    <tr>
                        <td class="fw-bold"><?=$prenotazione['titolo']?></td>
                        <td>
                            <span class="badge-status badge-durata">
                                <?=$prenotazione['durata']?>
                            </span>
                        </td>
                        <td>
                            <span class="badge-status badge-lingua">
                                <?=$prenotazione['lingua']?>
                            </span>
                        </td>
                        <td>
                            <span class="badge-status badge-prezzo">
                                €<?=$prenotazione['prezzo']?>
                            </span>
                        </td>
                        <td>
                            <a class="btn btn-action btn-rimborso" href="action_page.php?action=remove&id=<?=$prenotazione['id']?>">
                                <i class="fa fa-times me-1"></i> Rimuovi
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Totale:</td>
                    <td class="fw-bold fs-large">€<?=$somma?></td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="eventi.php" class="btn btn-action">
                <i class="fas fa-arrow-left me-1"></i> Continua lo shopping
            </a>
            <button class="btn btn-pagamento" onclick="window.location.href='action_page.php?action=payment'">
                <i class="fas fa-credit-card me-2"></i> Procedi al pagamento
            </button>
        </div>
    <?php else: ?>
        <div class="no-data-container">
            <div class="no-data-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="no-data-message">
                Il tuo carrello è vuoto. Scopri i nostri eventi e aggiungi quelli che ti interessano!
            </div>
            <a href="eventi.php" class="btn btn-action btn-prenota">
                <i class="fas fa-calendar-alt me-1"></i> Scopri eventi
            </a>
        </div>
    <?php endif; ?>
</div>
</main>
<?php
include 'components/footer.php';
?>
