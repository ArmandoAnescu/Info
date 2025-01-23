<?php
$db=new PDO('mysql:host=localhost;dbname=dbapplicazione','root','',
        [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ]
);
function logError(Exception $e):void{
    error_log($e->getMessage()."---".date('Y-m-d H:i:s'."\n"),3,'dberror/error_logfile.log');
    echo "DB error.Try again";
}
function LeggiLibri($db):void{
    $query="SELECT * FROM libreria";
    try {
        $stm = $db->prepare($query);
        $stm->execute();
        while ($libro=$stm->fetc()){
            echo "Titolo: $libro->titolo Autore:$libro->autore Genere:$libro->genere";
        }
    }catch (Exception $e){
        logError($e);
    }
}
function AggiungiLibro($db,$titolo,$autore,$prezzo,$anno_pubblicazione,$genere):void{
    $query="INSERT INTO libreria (titolo,autore,genere,prezzo,anno_pubblicazione) 
VALUES(:titolo,:autore,:genere,:prezzo,NOW())";
    try {
        $stm=$db->prepare($query);
        $stm->bindValue(':titolo',$titolo);
        $stm->bindValue(':autore',$autore);
        $stm->bindValue(':genere',$genere);
        $stm->bindValue(':prezzo',$prezzo);
        if($stm->execute()){
            $stm->closeCursor();
        }else{
            throw new PDOException('Errore utente non inserito correttamnete');
        }
    }catch (Exception $e){
        logError($e);
    }
}
function RimuoviLibro($db,$titolo,$autore){
    $query="DELETE FROM libreria WHERE titolo=:titolo AND autore=:autore";
    try {
        $stm=$db->prepare($query);
        $stm->bindValue(':titolo',$titolo);
        $stm->bindValue(':autore',$autore);
        if($stm->execute()){
            $stm->closeCursor();
        }
    }catch (Exception $e){
        logError($e);
    }
}