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
        if($user) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start(); // Avvia la sessione solo se non è già attiva
            }
            $_SESSION['user'] = $user;
            header('Location: index.php'); // Reindirizza alla home page
            exit();
        } else {
            header('Location: login.php?msg=Password o Email errata');
            exit();
        }
        break;
    case 'register':
        $username = $_POST['nome'];
        $email = $_POST['email'];
        $password = trim($_POST['password']);
        $hashedPw = password_hash(trim($password), PASSWORD_DEFAULT);
        $lingua=$_POST['lingua_base'];
        $nazionalita=$_POST['nazionalita'];
        $telefono=$_POST['telefono'];
        var_dump($_POST);
        $result = Register($username, $hashedPw, $email,$lingua,$nazionalita,$telefono);
        if ($result) {
            header('Location: login.php?msg=Registrazione completata');
        } else {
           header('Location: register.php?msg=Username o Email già in uso');
        }
        break;
    case 'order':
        $evento=$_REQUEST['id'];
        $evento=intval($evento);
        var_dump($evento);
        $result=Prenotazione($evento);
        if ($result) {
            header('Location: visualizza.php?msg=Prenotazione completata con successo');
        } else {
            header('Location: visualizza.php?msg=Errore nella prenotazione');
        }
       break;
    case 'remove':
        $evento=$_REQUEST['id'];
        $evento=intval($evento);
        $result=RimuoviPrenotazione($evento);
        if ($result) {
            header('Location: visualizza.php?msg=Prenotazione rimossa con successo');
        } else {
            header('Location: visualizza.php?msg=Errore nella rimozione della prenotazione');
        }
        break;
    case 'payment':
        $result=Pagamento();
        if ($result) {
            header('Location: prenotazioni.php?msg=Pagamento riuscito con successo');
        } else {
            header('Location: carrello.php?msg=Errore nel pagamento');
        }
        break;
    case 'rimborso':
        $evento=$_REQUEST['id'];
        $evento=intval($evento);
        $result=RimuoviPrenotazioneStorico($evento);
        if ($result) {
            header('Location: prenotazioni.php?msg=Rimborso riuscito con successo');
        } else {
            header('Location: carrello.php?msg=Errore nel rimborso');
        }        break;
}