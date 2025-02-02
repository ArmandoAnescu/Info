<?php
include 'connection.php';
//var_dump($_POST);
$oldName=$_REQUEST['oldName'];
$oldAuthor=$_REQUEST['oldAuthor'];
$name=$_POST['nomelibro'];
$author=$_POST['nomeautore'];
$genre=$_POST['genere'];
$price=$_POST['prezzo'];
$date_of_release=$_POST['annopubblicazione'];
AggiornaLibro($oldName,$oldAuthor,$name,$author,$price,$date_of_release,$genre);
header("Location: conferma.php?msg=Libro aggiornato con successo!");
exit();