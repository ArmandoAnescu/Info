<?php
require 'header.php';
require 'connection.php';
// Verifica se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupero i dati inviati dal form
    $nome = $_POST['nome'];
    $data_inizio = $_POST['data_i'];
    $data_fine = $_POST['data_f'];
    $immagine = isset($_POST['img'])?$_POST['img']:'';
    $predecessore = $_POST['prede'];
    InserisciSovrano($nome,$data_inizio,$data_fine,$immagine,null,$predecessore);
    header("Location: confirm.php?msg=Sovrano inserito con successo!");
    exit();
}
