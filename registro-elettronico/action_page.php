<?php
require 'connection.php';
switch ($_REQUEST['action']) {
    case 'login':
        session_start(); // Assicurati che la sessione sia attiva
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = Login($username, $password);
        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: home.php'); // Reindirizza alla home page
            exit();
        } else {
            header('Location: index.php?msg=Password o Email errata');
            exit();
        }
        break;
}
