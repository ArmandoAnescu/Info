<?php
include 'components/header.php';
include 'connection.php';
$prenotazioni = OttieniStorico();
?>

    <!-- Header della pagina -->
    <div class="container mt-5 mb-5">
        <div class="page-header text-center">
            <h1>Le Tue Prenotazioni</h1>
            <p class="mt-3 mb-0">Gestisci i tuoi eventi prenotati</p>
        </div>

        <?php if($prenotazioni && count($prenotazioni) > 0) { ?>
            <!-- Tabella prenotazioni -->
            <div class="table-container">
                <table class="table custom-table table-hover">
                    <thead>
                    <tr>
                        <th>Titolo</th>
                        <th>Luogo</th>
                        <th>Dettagli</th>
                        <th>Data</th>
                        <th>Guida</th>
                        <th>Pagamento</th>
                        <th>Azione</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($prenotazioni as $prenotazione) { ?>
                        <tr>
                            <td class="fw-bold"><?= $prenotazione['titolo']; ?></td>
                            <td><?= $prenotazione['luogo']; ?></td>
                            <td>
                                <span class="badge-status badge-prezzo me-1"><?= $prenotazione['prezzo']; ?> €</span>
                                <span class="badge-status badge-durata me-1"><?= $prenotazione['durata']; ?></span>
                                <span class="badge-status badge-lingua"><?= $prenotazione['lingua']; ?></span>
                            </td>
                            <td><?= $prenotazione['data']; ?></td>
                            <td><?= $prenotazione['guida']; ?></td>
                            <td><?= $prenotazione['pagamento']; ?></td>
                            <td>
                                <a class="btn btn-action btn-rimborso" href="action_page.php?action=rimborso&id=<?= $prenotazione['id']; ?>">
                                    <i class="fas fa-undo"></i>
                                    <span class="tooltip-text">Richiedi Rimborso </span>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="ricevuta.php" class="btn btn-pagamento">
                    <i class="fas fa-receipt me-2"></i>Scarica la ricevuta
                </a>

                <?php
                // Genera l'URL completo per il QR code
                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
                $host = $protocol . "://" . $_SERVER['HTTP_HOST'];
                $currentUrl = $host . $_SERVER['REQUEST_URI'];
                ?>
                <div class="qr-container">
                    <div class="qr-title">Scansiona per accesso rapido</div>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo urlencode($currentUrl); ?>&format=svg"
                         class="qr-code" alt="QR Code per tracking">
                </div>
            </div>

        <?php } else { ?>
            <!-- Visualizzazione "nessun dato" -->
            <div class="no-data-container">
                <i class="fas fa-calendar-times no-data-icon"></i>
                <div class="no-data-message">Nessuna prenotazione disponibile. Prenota degli eventi o contatta l'assistenza se ci sono problemi.</div>
                <a href="visualizza.php" class="btn btn-action btn-prenota">
                    <i class="fas fa-search me-2"></i> Scopri eventi disponibili
                </a>
            </div>
        <?php } ?>
    </div>
    </main>

<?php
include 'components/footer.php';
?>