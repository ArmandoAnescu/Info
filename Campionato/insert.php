<?php
require 'connection.php';
switch ($_REQUEST['action']){
    case 'pilota':
        $name=$_POST['name'];
        $lname=$_POST['lname'];
        $number=$_POST['number'];
        $nationality=$_POST['nationality'];
        $casa=$_POST['casa'];
        AggiungiPilota($name,$lname,$number,$nationality,$casa);
        header("Location: confirm.php?msg=Pilota inserito con successo!");
        exit();
        break;
    case 'case':
        break;
    case 'risultato':
        break;
    case 'gara':
        break;
}