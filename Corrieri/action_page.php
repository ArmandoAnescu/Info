<?php
require 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Avvia la sessione solo se non è già attiva
}
switch ($_REQUEST['action']) {
    case 'login':
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = Login($email, $password);
        var_dump($user);
        if ($user) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start(); // Avvia la sessione solo se non è già attiva
            }
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            header('Location: index.php'); // Reindirizza alla home page
            exit();
        } else {
            header('Location: login.php?msg=Password o Email errata');
            exit();
        }
        break;
    case 'register':
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = trim($_POST['password']);
        $hashedPw = password_hash(trim($password), PASSWORD_DEFAULT);
        $result = Register($username, $hashedPw, $email);
        if ($result) {
            header('Location: login.php?msg=Registrazione completata');
        } else {
            header('Location: register.php?msg=Username o Email già in uso');
        }
        break;
    case 'client':
        $nome = $_POST['name'];
        $cognome = $_POST['surname'];
        $indirizzo = $_POST['address'];
        $tel = $_POST['telephone'];
        $mail = $_POST['email'];
        if (!$_SESSION['email']) {
            header('Location: confirm.php?msg=Errore inserimento utente');
            echo $_SESSION['email'];
        }
        $result = InserisciCliente($cognome, $nome, $indirizzo, $tel, $mail);

        if ($result) {
            header('Location: confirm.php?msg=Registrazione utente completata');
        } else {
            header('Location: confirm.php?msg=Errore inserimento utente');
        }
        break;
    case 'plico':
        $id_plico = $_POST['id_plico'] ?? null;
        $cliente = $_POST['cliente'];
        $sede_partenza = $_POST['sede_partenza'];
        $sede_arrivo = $_POST['sede_arrivo'];
        $responsabile = $_POST['responsabile'];
        $consegna = $_POST['consegna'];
        $spedizione = $_POST['spedizione'] ?: null;
        $ritiro = $_POST['ritiro'] ?: null;
        $stato = $_POST['stato'];

        if ($id_plico) {
            // AGGIORNA PLICO ESISTENTE
            $result = AggiornaPlico($id_plico, $cliente, $sede_partenza, $sede_arrivo, $responsabile, $consegna, $spedizione, $ritiro, $stato);
            $msg = $result ? "Plico aggiornato con successo" : "Errore nell'aggiornamento del plico";
        } else {
            // INSERISCI NUOVO PLICO
            $result = InserisciPlico($cliente, $sede_partenza, $sede_arrivo, $responsabile, $consegna, $spedizione, $ritiro, $stato);
            $msg = $result ? "Plico inserito con successo" : "Errore nell'inserimento del plico";
        }

        //header("Location: confirm.php?msg=$msg");
        exit();
}
