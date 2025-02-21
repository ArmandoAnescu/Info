<?php
require 'config/dbconfig.php';
require_once 'config/dbcon.php';
$config= require 'config/dbconfig.php';
$db=dbcon::getDb($config);

function logError(Exception $e): void
{
    error_log($e->getMessage() . "---" . date('Y-m-d H:i:s' . "\n"), 3, 'dberror/error_logfile.log');
    echo "DB error.Try again";
}

function OttieniSovrani(){
    global $db;
    $query = "SELECT *
    FROM regnoutopia.sovrani s 
    ORDER BY data_inizio";
     try {
        $stm = $db->prepare($query);
        $stm->execute();
        $sovrani = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
        return null;
    }
    return $sovrani;
}
function InserisciSovrano($nome,$data_i,$data_f,$img,$succ,$prede){

    global $db;
   try{
    $query = "INSERT INTO sovrani (nome, data_inizio, data_fine, immagine) 
    VALUES (:nome,:data_i ,:data_f ,:img )";
    $stm=$db->prepare($query);
    $stm->bindValue(":nome", $nome);
    $stm->bindValue(":data_i", $data_i);
    $stm->bindValue(":data_f", $data_f);
    $stm->bindValue(":img", $img);
    if ($stm->execute()) {
    
    // Ora aggiorniamo il predecessore
    $query= "UPDATE sovrani SET successore = :succ WHERE nome = :pred";
    $stm=$db->prepare($query);
    $stm->bindValue(":succ", $nome);
    $stm->bindValue(":pred", $prede);
    $stm->execute();

    // Ora aggiorniamo il nuovo sovrano per assegnargli il predecessore
    $query= "UPDATE sovrani SET predecessore = :pred WHERE nome = :nome";
    $stm=$db->prepare($query);
    $stm->bindValue(":pred", $prede);
    $stm->bindValue(":nome", $nome);
    $stm->execute();
    $stm->closeCursor();
    }
   } catch (Exception $e) {
    logError($e);
    return null;
}
}