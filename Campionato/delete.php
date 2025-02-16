<?php
require 'connection.php';
switch ($_REQUEST['action']){
    case 'pilota':
        $number=$_REQUEST['num'];
        RimuoviPilota($number);
        header("Location: confirm.php?msg=Pilota eliminato con successo!");
        exit();
        break;
    case 'casa':
        $name=$_REQUEST['nome_liv'];
        RimuoviCasa($name);
        header("Location: confirm.php?msg=Casa eliminata con successo!");
        exit();
        break;
    case 'risultato':
        $id=$_REQUEST['id'];
        RimuoviRisultato($id);
        header("Location: confirm.php?msg=Risultato eliminato con successo!");
        exit();
        break;
    case 'gara':
        $id=$_REQUEST['id'];
        RimuoviGara($id);
        header("Location: confirm.php?msg=Gara inserita con successo!");
        exit();
        break;
}