<?php
include 'connection.php';
//var_dump($_POST);
$name=$_POST['nomelibro'];
$author=$_POST['nomeautore'];
$genre=$_POST['genere'];
$price=$_POST['prezzo'];
$date_of_release=$_POST['annopubblicazione'];
AggiungiLibro($name,$author,$price,$date_of_release,$genre);
header("Location: conferma.php?msg=Libro inserito con successo!");
exit();