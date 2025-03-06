<?php
require_once 'connection.php';
switch ($_REQUEST['action']){
    case 'login':
        $password=isset($_POST['password'])??$_POST['password'];
        $email=isset($_POST['email'])??$_POST['email'];
        if (!$password || !$email){
            header("Location=login.php");
        }
        if(login($password,$email)){
            header('Location=index.php');
        }else{
            header('Location=login.php?msg=Email/Password errata');
        }
        break;
}