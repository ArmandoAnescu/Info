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

function ClassificaPiloti(): ?array
{
    global $db;
    $query = "SELECT * FROM piloti";
    try {
        $stm = $db->prepare($query);
        $stm->execute();
        $piloti = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
        return null;
    }
    return $piloti;
}
function ClassificaSquadre(): ?array
{
    global $db;
    $query = "SELECT * FROM case_automobilistiche";
    try {
        $stm = $db->prepare($query);
        $stm->execute();
        $squadre = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
        return null;
    }
    return $squadre;
}

function RitornaSquadre(): ?array
{
    global $db;
    $query = "SELECT c.nome_casa FROM case_automobilistiche c";
    try {
        $stm = $db->prepare($query);
        $stm->execute();
        $squadre = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
        return null;
    }
    return $squadre;
}

function ClassificaRisultati(){
    global $db;
    $query = "SELECT r.id, r.posizione,r.piloti,g.luogo,g.data as data_gara
     FROM campionato5f.risultati r
     INNER JOIN campionato5f.gare g ON r.id_gara=g.id";
    try {
        $stm = $db->prepare($query);
        $stm->execute();
        $risultati = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
        return null;
    }
    return $risultati;
}

function ClassificaGare(){
    global $db;
    $query="SELECT * FROM gare";
    try {
        $stm = $db->prepare($query);
        $stm->execute();
        $gare = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
        return null;
    }
    return $gare;
}

function AggiungiPilota($nome,$cognome,$numero,$nazionalita,$casa): void
{
    global $db;
    $query = "INSERT INTO piloti (numero,nome,cognome,nazionalita,nome_casa) 
VALUES(:numero,:nome,:cognome,:nazionalita,:nome_casa)";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':numero', $numero);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':cognome', $cognome);
        $stm->bindValue(':nazionalita', $nazionalita);
        $stm->bindValue(':nome_casa', $casa);
        if ($stm->execute()) {
            $stm->closeCursor();
        } else {
            throw new PDOException('Errore utente non inserito correttamnete');
        }
    } catch (Exception $e) {
        logError($e);
    }
}
function AggiungiCasa($nome,$colore): void
{
    global $db;
    $query = "INSERT INTO case_automobilistiche (nome_casa,livrea) 
VALUES(:nome_casa,:livrea)";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':nome_casa', $nome);
        $stm->bindValue(':livrea', $colore);
        if ($stm->execute()) {
            echo 'inserimento avvenuto con successo';
            $stm->closeCursor();
        } else {
            throw new PDOException('Errore utente non inserito correttamnete');
        }
    } catch (Exception $e) {
        logError($e);
    }
}

function AggiungiRisultato($risultato,$pilota,$id_gara){
    global $db;
    $query = "INSERT INTO risultati (posizione,piloti,id_gara)
    VALUES(:risultato,:pilota,:id_gara)";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':risultato', $risultato);
        $stm->bindValue(':pilota',$pilota);
        $stm->bindValue(':id_gara', $id_gara);
        if($stm->execute()){
            $stm->closeCursor();
        }else{
            throw new PDOException('Errore risultato non inserito correttamnete');
        }
    } catch (Exception $e) {
        logError($e);
    }
}

function AggiungiGara($luogo,$data,$tempo_migliore) {
    global $db;
    $query = "INSERT INTO gare (luogo, data,tempo_migliore)
    VALUES(:luogo, :data, :tempo_migliore)";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':luogo', $luogo);
        $stm->bindValue(':data', $data);
        $stm->bindValue(':tempo_migliore',$tempo_migliore);
        if($stm->execute()){
            $stm->closeCursor();
        }else{
            throw new PDOException('Errore risultato non inserito correttamnete');
        }
    } catch (Exception $e) {
        logError($e);
    }   
}

function RimuoviPilota($numero)
{
    global $db;
    $query = "DELETE FROM risultati WHERE piloti = :piloti";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':piloti', $numero);
        if ($stm->execute()) {
            $stm->closeCursor();
        }
    } catch (Exception $e) {
        logError($e);
    }
    $query = "DELETE FROM piloti WHERE numero=:numero";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':numero', $numero);
        if ($stm->execute()) {
            $stm->closeCursor();
        }
    } catch (Exception $e) {
        logError($e);
    }

}
function RimuoviCasa($nome)
{
    global $db;
    $query="DELETE FROM case_automobilistiche WHERE nome_casa=:nome_casa";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':nome_casa', $nome);
        if ($stm->execute()) {
            $stm->closeCursor();
        }
    } catch (Exception $e) {
        logError($e);
    }
    
}

function RimuoviRisultato($id){
    global $db;
    $query = "DELETE FROM risultati WHERE id = :id";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $id);
        if ($stm->execute()) {
            $stm->closeCursor();
        }
    } catch (Exception $e) {
        logError($e);
    }
}

function RimuoviGara($id){
    global $db;
    $query = "DELETE FROM gare WHERE id = :id";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $id);
        if ($stm->execute()) {
            $stm->closeCursor();
        }
    } catch (Exception $e) {
        logError($e);
    }

}

function AggiornaPilota($oldNum,$numero, $nome, $cognome, $nazionalita, $casa)
{
    global $db;
    $query = "UPDATE piloti 
    SET nome=:nome, cognome=:cognome, nazionalita=:nazionalita, nome_casa=:casa,numero=:numero
    WHERE numero=:oldNum";
    
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':cognome', $cognome);
        $stm->bindValue(':nazionalita', $nazionalita);
        $stm->bindValue(':casa', $casa);
        $stm->bindValue(':numero', $numero);
        $stm->bindValue(':oldNum', $oldNum);
        if ($stm->execute()) {
            $stm->closeCursor();
        }
    } catch (Exception $e) {
        logError($e);
    }
}

function AggiornaGara($id, $luogo, $data, $tempo_migliore){
    global $db;
    $query = "UPDATE gare
    SET luogo=:luogo, data=:data, tempo_migliore=:tempo_migliore
    WHERE id=:id";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':luogo', $luogo);
        $stm->bindValue(':data',$data);
        $stm->bindValue(':tempo_migliore',$tempo_migliore);
        $stm->bindValue(':id',$id);
        if ($stm->execute()) {
            $stm->closeCursor();
        }
    } catch (Exception $e) {
        logError($e);
    }
}

function AggiornaCasa($nome,$newName,$color){
    global $db;
    $query = "UPDATE case_automobilistiche 
    SET nome_casa=:nome_casa, livrea=:colore
    WHERE nome_casa=:nome";
    
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':nome_casa', $newName);
        $stm->bindValue(':colore', $color);
        if ($stm->execute()) {
            $stm->closeCursor();
        }
    } catch (Exception $e) {
        logError($e);
    }  
}
function AggiornaRisultato($id, $posizione,$numero,$id_gara){
    global $db;
    $query = "UPDATE risultati
    SET posizione=:posizione, piloti=:numero,id_gara=:id_gara
    WHERE id=:id";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $id);
        $stm->bindValue(':posizione', $posizione);
        $stm->bindValue(':numero', $numero);
        $stm->bindValue(':id_gara', $id_gara);
        if ($stm->execute()) {
            $stm->closeCursor();
        }
    } catch (Exception $e) {
        logError($e);
    }  
}

function OttieniPilota($num){
    global $db;
    $query = "SELECT * FROM piloti WHERE numero=:numero";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':numero', $num);
        $stm->execute(); 
        $pilota = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
        return null;
    }
    return $pilota;
}

function OttieniCasa($nome){
    global $db;
    $query = "SELECT * FROM case_automobilistiche WHERE nome_casa=:nome";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':nome', $nome);
        $stm->execute(); 
        $casa = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
        return null;
    }
    return $casa;
}
function OttieniRisultato($id){
    global $db;
    $query = "SELECT * FROM risultati WHERE id=:id";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $id);
        $stm->execute(); 
        $risultato = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
        return null;
    }
    return $risultato;
}
function OttieniGara($id){
    global $db;
    $query = "SELECT * FROM gare WHERE id=:id";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $id);
        $stm->execute(); 
        $gara = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
        return null;
    }
    return $gara;
}