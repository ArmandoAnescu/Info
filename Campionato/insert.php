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
    case 'casa':
        $name=$_POST['name'];
        $color=$_POST['color'];
        AggiungiCasa($name,$color);
        header("Location: confirm.php?msg=Casa inserita con successo!");
        exit();
        break;
    case 'risultato':
        $result=$_POST['posizione'];
        $pilota=$_POST['numero'];
        $id_race=$_POST['id_gara'];
        AggiungiRisultato($result,$pilota,$id_race);
        header("Location: confirm.php?msg=Risultato inserito con successo!");
        exit();
        break;
    case 'gara':
        $luogo=$_POST['luogo'];
        $data=$_POST['data'];
        $tempo_migliore['best_time'];
        AggiungiGara($luogo,$data,$tempo_migliore);
        header("Location: confirm.php?msg=Gara inserita con successo!");
        exit();
        break;
}