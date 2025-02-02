<?php
include 'connection.php';
//var_dump($_POST);
$titolo=$_POST['titolo'];
$autore=$_POST['autore'];
RimuoviLibro($titolo,$autore);
header("Location: conferma.php?msg=Libro eliminato con successo!");
exit();