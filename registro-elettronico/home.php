<?php
include 'components/header.php';
include 'connection.php';
?>
<main class="flex-shrink-0">
    <div class="container mt-5 pt-5">
        <?php if ($_SESSION['user']['access'] === 'docente'): ?>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="card-title text-primary">
                                <i class="fas fa-chalkboard-teacher me-2"></i>
                                Buongiorno, Prof. <?= $_SESSION['user']['cognome'] ?>
                            </h2>
                            <p class="card-text text-muted">Ecco le tue classi e materie per l'anno scolastico in corso</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php
                $info = OttieniClassi();
                foreach ($info as $classe):
                ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    Classe <?= $classe['anno'] . $classe['sezione'] ?>
                                    <span class="badge bg-light text-dark float-end">
                                        A.S. <?= $classe['anno_scolastico'] ?>
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Indirizzo:</strong> <?= $classe['indirizzo'] ?></p>
                                <p><strong>Articolazione:</strong> <?= $classe['articolazione'] ?></p>

                                <div class="mb-3">
                                    <h6 class="text-muted mb-2">Materie insegnate:</h6>
                                    <?php foreach ($classe['materie'] as $materia): ?>
                                        <span class="badge bg-secondary me-1 mb-1"><?= $materia ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="pianostudi.php?classe=<?= $classe['id'] ?>" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-book me-1"></i> Piano di studi completo
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif ($_SESSION['user']['access'] === 'studente'): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="card-title text-success">
                        <i class="fas fa-user-graduate me-2"></i>
                        Buongiorno, <?= $_SESSION['user']['nome'] ?>
                    </h2>
                    <p class="card-text">Benvenuto nel tuo portale scolastico.</p>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Menu Rapido</h5>
                </div>
                <div class="card-body">
                    <ul class="student-menu">
                        <li class="student-menu-item">
                            <a href="#" class="student-menu-link">
                                <span class="student-menu-icon">
                                    <i class="fas fa-calendar-day"></i>
                                </span>
                                Oggi
                            </a>
                        </li>
                        <li class="student-menu-item">
                            <a href="#" class="student-menu-link">
                                <span class="student-menu-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                                Agenda
                            </a>
                        </li>
                        <li class="student-menu-item">
                            <a href="#" class="student-menu-link">
                                <span class="student-menu-icon">
                                    <i class="fas fa-chart-line"></i>
                                </span>
                                Voti
                            </a>
                        </li>
                        <li class="student-menu-item">
                            <a href="classe.php" class="student-menu-link">
                                <span class="student-menu-icon">
                                    <i class="fas fa-users"></i>
                                </span>
                                Classe
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        <?php elseif ($_SESSION['user']['access'] === 'genitore'): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="card-title text-info">
                        <i class="fas fa-users me-2"></i>
                        Benvenuto, <?= $_SESSION['user']['nome'] . ' ' . $_SESSION['user']['cognome'] ?>
                    </h2>
                    <p class="card-text">Qui puoi monitorare la situazione scolastica dei tuoi figli.</p>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">I tuoi figli</h5>
                </div>
                <div class="card-body">
                    <?php
                    $figli = OttieniFigli();
                    if ($figli && count($figli) > 0):
                    ?>
                        <div class="list-group">
                            <?php foreach ($figli as $figlio): ?>
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1"><?= $figlio['nome'] . ' ' . $figlio['cognome'] ?></h6>
                                        <small class="text-muted">Nato il: <?= date('d/m/Y', strtotime($figlio['data_nascita'])) ?></small>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-info-circle me-1"></i> Dettagli
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Non sono presenti informazioni sui tuoi figli o si è verificato un errore.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>
<?php include 'components/footer.php'; ?>