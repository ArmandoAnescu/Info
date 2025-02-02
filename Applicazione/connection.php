<?php
$db=new PDO('mysql:host=localhost;dbname=dbapplicazione','root','',
        [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ]
);
function logError(Exception $e):void{
    error_log($e->getMessage()."---".date('Y-m-d H:i:s'."\n"),3,'dberror/error_logfile.log');
    echo "DB error.Try again";
}
function LeggiLibri():?array{
    global $db;
    $query="SELECT * FROM libreria";
    try {
        $stm = $db->prepare($query);
        $stm->execute();
        $libri=$stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    }catch (Exception $e){
        logError($e);
        return null;
    }
    return $libri;
}
function AggiungiLibro($titolo,$autore,$prezzo,$anno_pubblicazione,$genere):void{
    global $db;
    $query="INSERT INTO libreria (titolo,autore,genere,prezzo,anno_pubblicazione) 
VALUES(:titolo,:autore,:genere,:prezzo,:anno)";
    try {
        $stm=$db->prepare($query);
        $stm->bindValue(':titolo',$titolo);
        $stm->bindValue(':autore',$autore);
        $stm->bindValue(':genere',$genere);
        $stm->bindValue(':prezzo',$prezzo);
        $stm->bindValue(':anno',$anno_pubblicazione);
        if($stm->execute()){
            echo 'inserimento avvenuto con successo';
            $stm->closeCursor();
        }else{
            throw new PDOException('Errore utente non inserito correttamnete');
        }
    }catch (Exception $e){
        logError($e);
    }
}
function RimuoviLibro($titolo,$autore){
    global $db;
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
function AggiornaLibro($oldName,$oldAuthor,$titolo,$autore,$prezzo,$anno_pubblicazione,$genere){
    global $db;
    $query="UPDATE libreria SET titolo=:titolo,autore=:autore,prezzo=:prezzo,'anno_pubblicazione:anno_pubblicazione,genere=:genere
    WHERE titolo=:vecchioTitolo AND autore=:vecchioAutore";
    try {
        $stm=$db->prepare($query);
        $stm->bindValue(':titolo',$titolo);
        $stm->bindValue(':autore',$autore);
        $stm->bindValue(':prezzo',$prezzo);
        $stm->bindValue(':anno_pubblicazione',$anno_pubblicazione);
        $stm->bindValue(':genere',$genere);
        $stm->bindValue(':veccchioTitolo',$oldName);
        $stm->bindValue(':veccchioAutore',$oldAuthor);
        if($stm->execute()){
            $stm->closeCursor();
        }
    }catch (Exception $e){
        logError($e);
    }
}