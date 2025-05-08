<?php
require 'components/header.php';
require 'connection.php';
$eventi = OttieniEventi();
?>

    <!-- Header della pagina -->
    <div class="container mt-5 mb-5">
        <div class="page-header text-center">
            <h1>Eventi Disponibili</h1>
            <p class="mt-3 mb-0">Scopri e prenota i nostri tour guidati</p>
        </div>

        <?php if($eventi && count($eventi) > 0) { ?>
            <!-- Tabella eventi -->
            <div class="table-container">
                <table class="table custom-table table-hover">
                    <thead>
                    <tr>
                        <th>Titolo</th>
                        <th>Luogo</th>
                        <th>Dettagli</th>
                        <th>Data</th>
                        <th>Guida</th>
                        <th>Azione</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($eventi as $evento) { ?>
                        <tr>
                            <td class="fw-bold"><?= $evento['titolo']; ?></td>
                            <td><?= $evento['luogo']; ?></td>
                            <td>
                                <span class="badge-status badge-prezzo me-1"><?= $evento['prezzo']; ?> €</span>
                                <span class="badge-status badge-durata me-1"><?= $evento['durata']; ?></span>
                                <span class="badge-status badge-lingua"><?= $evento['lingua']; ?></span>
                            </td>
                            <td><?= $evento['data']; ?></td>
                            <td><?= $evento['guida']; ?></td>
                            <td>
                                <a class="btn btn-action btn-prenota" href="action_page.php?action=order&id=<?= $evento['id']; ?>">
                                    <i class="fas fa-calendar-check"></i> Prenota
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

        <?php } else { ?>
            <!-- Visualizzazione "nessun dato" -->
            <div class="no-data-container">
                <i class="fas fa-calendar-times no-data-icon"></i>
                <div class="no-data-message">Nessun evento disponibile al momento. Controlla più tardi o contatta l'assistenza.</div>
                <a href="contatti.php" class="btn btn-action btn-prenota">
                    <i class="fas fa-envelope me-2"></i> Contatta l'assistenza
                </a>
            </div>
        <?php } ?>
    </div>
    </main>

<?php
require 'components/footer.php';
?>