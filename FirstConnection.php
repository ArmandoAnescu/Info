<?php
$db=new PDO('mysql:host=localhost;dbname=dbitis','root','',
        [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ]
);//ti configuri in modo da gestire gli errori con le opzioni e ogni tupla diventa un oggetto
var_dump($db);
echo $db->getAttribute(PDO::ATTR_DRIVER_NAME);
echo '<br>';
echo $db->getAttribute(PDO::ATTR_ERRMODE);
echo $db->getAttribute(PDO::ATTR_SERVER_INFO);
/**READ**/
/*
$query='SELECT * FROM studenti';
try {
    $stm = $db->prepare($query);//prepara la query
    $stm->execute();//esegue la query
    while ($student = $stm->fetch()) {//restituisce un valore
        echo "matricola studente: " . $student->matricola_studente . "<br>";
        echo "nome: " . $student->nome . "<br>";
        echo "cognome: " . $student->cognome . "<br>";
        echo "media: " . $student->media . "<br>";
        echo "data iscrizione: " . $student->data_iscrizione . "<br> <hr>";
    }
    $stm->closeCursor();
}catch (Exception $e){
    echo $e->getMessage();
}
echo 'parte 2 <br> <br>';
*/
echo '<br>';
/*
//read
try {


    $query = 'SELECT media,cognome FROM student WHERE nome=:name';
    $stm = $db->prepare($query);
    $stm->bindValue(':name', 'Antonella');
    $stm->execute();
    while ($student = $stm->fetch()) {//restituisce un valore
        echo "cognome: " . $student->cognome . "<br>";
        echo "media: " . $student->media . "<br>";
        echo '<hr>';
    }
}catch (Exception$e){
    //echo $e->getMessage();
    error_log($e->getMessage()."---".date('Y-m-d H:i:s'."\n"),3,'dberror/error_logfile.log');
    echo "DB error.Try again";
}
*/
/*
 *

//Create
$query="INSERT INTO studenti (matricola_studente,nome,cognome,media,data_iscrizione) 
VALUES(:matricola,:nome,:cognome,:media,NOW())";
try {
    $stm=$db->prepare($query);
    $stm->bindValue(':matricola','00012');
    $stm->bindValue(':nome','Marco');
    $stm->bindValue(':cognome','Marculli');
    $stm->bindValue(':media',9);
        if($stm->execute()){
        $stm->closeCursor();
    }else{
        throw new PDOException('Errore utente non inserito correttamnete');
    }
}catch (Exception $e){
    logError($e);
}
*/
/*
//UPDATE
$query="UPDATE studenti SET media=:media WHERE nome=:nome";
try {
    $stm=$db->prepare($query);
    $stm->bindValue(':nome','Marco');
    $stm->bindValue(':media',10);
    if($stm->execute()){
        $stm->closeCursor();
    }else{
        throw new PDOException('Errore aggiornamento non riuscito');
    }
}catch (Exception $e){
    logError($e);
}
function logError(Exception $e):void{
    error_log($e->getMessage()."---".date('Y-m-d H:i:s'."\n"),3,'dberror/error_logfile.log');
    echo "DB error.Try again";
}
*/
//delete
/*
$query="DELETE FROM studenti WHERE nome=:nome";
try {
    $stm=$db->prepare($query);
    $stm->bindValue(':nome','Marco');
    if($stm->execute()){
        $stm->closeCursor();
    }else{
        throw new PDOException('Errore aggiornamento non riuscito');
    }
}catch (Exception $e){
    logError($e);
}
function logError(Exception $e):void{
    error_log($e->getMessage()."---".date('Y-m-d H:i:s'."\n"),3,'dberror/error_logfile.log');
    echo "DB error.Try again";
}
*/