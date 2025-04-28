<?php
include 'components/header.php';
include 'connection.php';

// Verifica che l'utente sia autenticato
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
?>

<main class="flex-shrink-0">
    <div class="container mt-5 pt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Account </li>
            </ol>
        </nav>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">
                    <?= $_SESSION['user']['nome'] ?> <?= $_SESSION['user']['cognome'] ?>
                </h2>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <?php
                        if ($_SESSION['user']['access'] === 'studente') {
                            $classe = OttieniClasseStudente($_SESSION['user']['id']);
                        ?>
                            <h5 class="text-muted">Dettagli Studente</h5>
                            <div class="info-utente">
                                <table class="table table-sm dati">
                                    <tr>
                                        <th style="width: 40%">Classe:</th>
                                        <td><?= $classe['anno'] . '' . $classe['sezione'] . ' anno scolastico ' . $classe['anno_scolastico'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Indirizzo:</th>
                                        <td><?= $classe['indirizzo'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Articolazione:</th>
                                        <td><?= $classe['articolazione'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Data e luogo di nascita:</th>
                                        <td><?= $_SESSION['user']['data'] . ' ' . $_SESSION['user']['luogo'] ?></td>
                                    </tr>
                                </table>
                            <?php
                        } else if ($_SESSION['user']['access'] === 'docente') { ?>
                                <h5 class="text-muted">Dettagli Docente</h5>
                                <div class="info-utente">
                                    <table class="table table-sm dati">
                                        <tr>
                                            <th style="width: 40%">Username:</th>
                                            <td><?= $_SESSION['user']['username'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Data e luogo di nascita:</th>
                                            <td><?= $_SESSION['user']['data'] . ' ' . $_SESSION['user']['luogo'] ?></td>
                                        </tr>
                                    </table>
                                <?php
                            }
                                ?>

                                <img class="pfp-account" src="images/default.jpg" width="50%" height="50%">
                                </div>


                            </div>
                    </div>
                    <div class="card-footer">
                        <a href="home.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Torna alla Home
                        </a>
                    </div>
                </div>
            </div>
</main>

<?php include 'components/footer.php'; ?>