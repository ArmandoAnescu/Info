<?php
require 'connection.php';
switch ($_REQUEST['action']){
    case 'pilota':
        $oldNumber=$_REQUEST['oldNum'];
        $name=$_POST['name'];
        $lname=$_POST['lname'];
        $number=$_POST['number'];
        $nationality=$_POST['nationality'];
        $casa=$_POST['casa'];
        AggiornaPilota($oldNumber,$number,$name,$lname,$nationality,$casa);
        header("Location: confirm.php?msg=Pilota aggiornato con successo!");
        exit();
        break;
    case 'casa':
        $oldName=$_REQUEST['oldName'];
        $name=$_POST['name'];
        $color=$_POST['color'];
        AggiornaCasa($oldName,$name,$color);
        header("Location: confirm.php?msg=Casa aggiornata con successo!");
        exit();
        break;
    case 'risultato':
        $id=$_REQUEST['id'];
        $result=$_POST['posizione'];
        $pilota=$_POST['numero'];
        $id_race=$_POST['id_gara'];
        AggiornaRisultato($id,$result,$pilota,$id_race);
        header("Location: confirm.php?msg=Risultato aggiornato con successo!");
        exit();
        break;
    case 'gara':
        $id=$_REQUEST['id'];
        $luogo=$_POST['luogo'];
        $data=$_POST['data'];
        $tempo_migliore=$_POST['best_time'];
        AggiornaGara($id,$luogo,$data,$tempo_migliore);
        header("Location: confirm.php?msg=Gara aggiornata con successo!");
        exit();
        break;
}