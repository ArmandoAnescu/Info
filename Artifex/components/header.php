<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema di Prenotazione Eventi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Link a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link al tuo file CSS personalizzato -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Link a Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg" style="background-color: var(--primary-color); color: white;">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="color: white; font-weight: 700;">
            <i class="fas fa-calendar-check me-2"></i>Artifex
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"
                style="color: white; border-color: white;">
            <i class="fas fa-bars" style="color: white;"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php" style="color: white;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="visualizza.php" style="color: white;">Eventi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="prenotazioni.php" style="color: white;">Le mie prenotazioni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="carrello.php" style="color: white;">Check-out</a>
                </li>
                <?php
                if(PHP_SESSION_NONE===session_status()){
                    session_start();
                }
                if (isset($_SESSION['user'])): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" style="color: white;">
                    <?= $_SESSION['user']['username'] ?>
                    </a>
                    <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="account.php">Profilo</a></li>
                <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
            </ul>
                </li>

                <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="login.php" style="color: white;">
                    <i class="fas fa-user me-1"></i> Accedi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php" style="color: white;">Registrati</a>
            </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<main>
