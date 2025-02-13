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
function AggiungiCasa(): void
{
    global $db;
    $query = "INSERT INTO libreria (titolo,autore,genere,prezzo,anno_pubblicazione) 
VALUES(:titolo,:autore,:genere,:prezzo,:anno)";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':titolo', $titolo);
        $stm->bindValue(':autore', $autore);
        $stm->bindValue(':genere', $genere);
        $stm->bindValue(':prezzo', $prezzo);
        $stm->bindValue(':anno', $anno_pubblicazione);
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

function RimuoviPilota($id)
{
    global $db;
    $query = "DELETE FROM libreria WHERE id=:id";
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

function AggiornaPilota($numero, $nome, $cognome, $nazionalita, $casa)
{
    global $db;
    $query = "UPDATE piloti 
    SET nome=:nome, cognome=:cognome, nazionalita=:nazionalita, casa=:casa
    WHERE numero=:numero";
    
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':cognome', $cognome);
        $stm->bindValue(':nazionalita', $nazionalita);
        $stm->bindValue(':casa', $casa);
        $stm->bindValue(':numero', $numero);
        if ($stm->execute()) {
            $stm->closeCursor();
        }
    } catch (Exception $e) {
        logError($e);
    }
}
function AggiornaRisultato($id, $titolo, $autore, $prezzo, $anno_pubblicazione, $genere){

}
