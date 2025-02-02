<?php
include 'connection.php';
$id=$_REQUEST['id'];
RimuoviLibro($id);
header("Location: conferma.php?msg=Libro eliminato con successo!");
exit();