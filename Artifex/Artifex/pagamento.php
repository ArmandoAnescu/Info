<?php
include 'components/header.php';
include 'connection.php';
$prenotazioni = OttieniPrenotazioni();
$somma = 0;
?>

<!-- Header della pagina -->
<div class="page-header text-center">
    <div class="container">
        <h1>Checkout</h1>
        <p>Rivedi le informazioni e completa il pagamento</p>
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="table-container mb-4">
                <table class="custom-table">
                    <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Luogo</th>
                        <th>Data</th>
                        <th>Guida</th>
                        <th>Dettagli</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($prenotazioni){
                        foreach($prenotazioni as $prenotazione){
                            $somma = $somma + $prenotazione['prezzo'];
                            ?>
                            <tr>
                                <td class="fw-bold"><?=$prenotazione['titolo']?></td>
                                <td><?=$prenotazione['luogo']?></td>
                                <td><?=$prenotazione['data']?></td>
                                <td><?=$prenotazione['guida']?></td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="badge-status badge-durata mb-1"><?=$prenotazione['durata']?></span>
                                        <span class="badge-status badge-lingua mb-1"><?=$prenotazione['lingua']?></span>
                                        <span class="badge-status badge-prezzo">€<?=$prenotazione['prezzo']?></span>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    } else { ?>
                        <tr>
                            <td colspan="5" class="text-center">Nessun evento nel carrello</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="table-container p-4">
                <h3 class="mb-3">Riepilogo ordine</h3>
                <div class="d-flex justify-content-between mb-2">
                    <span>Totale eventi:</span>
                    <span><?=count($prenotazioni)?></span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotale:</span>
                    <span>€<?=$somma?></span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span>IVA (inclusa):</span>
                    <span>€<?=number_format($somma * 0.22, 2)?></span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4 fw-bold fs-large">
                    <span>Totale:</span>
                    <span>€<?=$somma?></span>
                </div>

                <button class="btn btn-pagamento w-100" onclick="window.location=href='action_page.php?action=payment'">
                    <i class="fas fa-lock me-2"></i> Completa pagamento
                </button>

                <div class="text-center mt-4">
                    <?php
                    // Genera l'URL completo per il QR code
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
                    $host = $protocol . "://" . $_SERVER['HTTP_HOST'];
                    $currentUrl = $host . $_SERVER['REQUEST_URI'];
                    ?>
                    <div class="qr-container">
                        <div class="qr-title">Scansiona per pagare con app</div>
                        <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo urlencode($currentUrl); ?>&format=svg"
                             class="qr-code" alt="QR Code per tracking">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="carrello.php" class="btn btn-action">
            <i class="fas fa-arrow-left me-1"></i> Torna al carrello
        </a>
    </div>
</div>
</main>
<?php
include 'components/footer.php';
?>