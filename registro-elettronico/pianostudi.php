<?php
include 'components/header.php';
include 'connection.php';

// Verifica che l'utente sia autenticato
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

// Verifica che sia stato specificato l'ID della classe
if (!isset($_GET['classe'])) {
    header('Location: home.php');
    exit;
}

$classe_id = $_GET['classe'];
$docente_id = ($_SESSION['user']['access'] === 'docente') ? $_SESSION['user']['id'] : null;

// Ottieni il piano di studi
$piano_studi_info = OttieniPianoStudi($classe_id, $docente_id);
//var_dump($piano_studi_info);
if (!$piano_studi_info) {
    echo "<div class='alert alert-danger'>Impossibile recuperare il piano di studi.</div>";
    include 'components/footer.php';
    exit;
}

$classe_dettagli = OttieniClasse($classe_id);
var_dump($classe_dettagli);
?>

<main class="flex-shrink-0">
    <div class="container mt-5 pt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Piano di Studi</li>
            </ol>
        </nav>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">
                    Piano di Studi - Classe <?= $classe_dettagli['anno'] . $classe_dettagli['sezione'] ?>
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

                <h5 class="text-muted mb-3">Materie del Piano di Studi</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Materia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($piano_studi_info as $materia): ?>
                                <tr>
                                    <td>
                                        <?= $materia['materia'] ?>
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