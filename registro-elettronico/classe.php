<?php
include 'components/header.php';
include 'connection.php';

// Verifica che l'utente sia autenticato
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$classe_dettagli = OttieniClasseStudente($_SESSION['user']['id']);
$classe_id = $classe_dettagli['id'];
//ottieniamo l'elenco di studenti

$elencoStudenti = OttieniStudentiClasse($classe_id);
//var_dump($elencoStudenti);
?>

<main class="flex-shrink-0">
    <div class="container mt-5 pt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Dettagli classe</li>
            </ol>
        </nav>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">
                    Classe <?= $classe_dettagli['anno'] . $classe_dettagli['sezione'] ?>
                </h2>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="text-muted">Dettagli Classe</h5>
                        <table class="table table-sm">
                            <tr>
                                <th style="width: 40%">Anno Scolastico:</th>
                                <td><?= $classe_dettagli['anno_scolastico'] ?></td>
                            </tr>
                            <tr>
                                <th>Indirizzo:</th>
                                <td><?= $classe_dettagli['indirizzo'] ?></td>
                            </tr>
                            <tr>
                                <th>Articolazione:</th>
                                <td><?= $classe_dettagli['articolazione'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <h5 class="text-muted mb-3">Alunni</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Nome</th>
                                <th>Cognome</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($elencoStudenti as $studente): ?>
                                <tr>
                                    <td>
                                        <?= $studente['nome'] ?>
                                    </td>
                                    <td>
                                        <?= $studente['cognome'] ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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