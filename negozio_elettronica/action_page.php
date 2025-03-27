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
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['admin']=$user['admin'];
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
    case 'insert':
        $codice=$_POST['codice'];
        $data_produzione=$_POST['data_produzione'];
        $desc=$_POST['descrizione'];
        $costo=$_POST['costo'];
        $quantita=$_POST['quantita'];
        InserisciProdotto($codice,$desc,$costo,$quantita,$data_produzione);
        header('Location: index.php');
        break;
    case 'delete':
        $codice=$_REQUEST['codice'];
        RimuoviProdotto($codice);
        header('Location: visualizza.php');
        break;
    case 'update':
        $codice=$_POST['codice'];
        $data_produzione=$_POST['data_produzione'];
        $desc=$_POST['descrizione'];
        $costo=$_POST['costo'];
        $quantita=$_POST['quantita'];
        AggiornaProdotto($codice,$desc,$costo,$quantita,$data_produzione);
        header('Location: index.php');
        break;
}