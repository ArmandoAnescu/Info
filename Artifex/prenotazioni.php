<?php
include 'components/header.php';
include 'connection.php';
if(!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

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
                            <?php
                            // Itera su ogni data di pagamento
                            foreach($prenotazioni as $dataPagamento => $eventi) {
                                ?>
                                <div class="table-container">
                                    <!-- Mini tabella per la data di pagamento -->
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
                                            <?php
                                            // Itera su ogni evento per quella data di pagamento
                                            foreach($eventi as $prenotazione) { ?>
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
                                                            <span class="tooltip-text">Richiedi rimborso</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <!-- Sezione per ogni data di pagamento -->
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <!-- Pulsante per scaricare la ricevuta -->
                                    <a href="ricevuta.php?data_pagamento=<?= $dataPagamento; ?>" class="btn btn-pagamento">
                                        <i class="fas fa-receipt me-2"></i> Scarica la ricevuta
                                    </a>
                                </div>
                            <?php } ?>
                    <?php }
                    ?>
    </div>
    </div>
    </main>

<?php
include 'components/footer.php';
/*
 *  } else { ?>
            <!-- Visualizzazione "nessun dato" -->
            <div class="no-data-container">
                <i class="fas fa-calendar-times no-data-icon"></i>
                <div class="no-data-message">Nessuna prenotazione disponibile. Prenota degli eventi o contatta l'assistenza se ci sono problemi.</div>
                <a href="visualizza.php" class="btn btn-action btn-prenota">
                    <i class="fas fa-search me-2"></i> Scopri eventi disponibili
                </a>
            </div>
        <?php } ?>
 * */
?>