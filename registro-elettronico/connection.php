<?php
require 'config/dbconfig.php';
require_once 'config/dbcon.php';
$config = require 'config/dbconfig.php';
$db = dbcon::getDb($config);

function logError(Exception $e): void
{
    error_log($e->getMessage() . "---" . date('Y-m-d H:i:s' . "\n"), 3, 'dberror/error_logfile.log');
    echo "DB error.Try again";
}

function Login($username, $password)
{
    global $db;
    
    // Query di base per recuperare i dati dell'utente in base allo username
    $query = "SELECT * FROM credenziali WHERE username=:username";
    
    // Query per recuperare i dati specifici in base al tipo di utente
    $docenti = "SELECT p.nome, p.cognome, p.data_nascita, p.luogo_nascita FROM docenti d
                LEFT JOIN persone p ON d.persona = p.id WHERE credenziali = :id";
    
    $studenti = "SELECT p.nome, p.cognome, p.data_nascita, p.luogo_nascita FROM studenti s
                 LEFT JOIN persone p ON s.persona = p.id WHERE credenziali = :id";
    
    $genitori = "SELECT p.nome, p.cognome, p.data_nascita, p.luogo_nascita,g.id as id FROM genitori g
                 LEFT JOIN persone p ON g.persona = p.id WHERE credenziali = :id";
    
    $personale = "SELECT p.nome, p.cognome, p.data_nascita, p.luogo_nascita FROM personale pe
                  LEFT JOIN persone p ON pe.persona = p.id WHERE credenziali = :id";
    
    try {
        // Recupera le credenziali dell'utente
        $stm = $db->prepare($query);
        $stm->bindValue(':username', $username);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        //var_dump( $result);
        // Verifica se le credenziali sono corrette
        if ($result && hash('sha256', $password) === $result['password']) {
            // Recupera i dati specifici per il tipo di utente (docente, studente, genitore, personale)
            $userId = $result['id'];
            
            // Decidi quale query eseguire in base al tipo di utente (aggiungi logica per gestire gli altri tipi)
            $stm = $db->prepare($docenti); // Puoi cambiare questa query a seconda del tipo di utente
            $stm->bindValue(':id', $userId);
            $stm->execute();
            $res = $stm->fetch(PDO::FETCH_ASSOC);
            $stm->closeCursor();
            
            // Se i dati sono stati trovati, ritorna le informazioni
            if ($res) {
                return [
                    'id' => $userId,
                    'username' => $result['username'],
                    'nome' => $res['nome'],
                    'cognome' => $res['cognome'], // Corretto l'errore
                    'data' => $res['data_nascita'],
                    'luogo' => $res['luogo_nascita'],
                    'access' => 'docente' // Cambia questo valore in base al tipo di utente
                ];
            }
            // Decidi quale query eseguire in base al tipo di utente (aggiungi logica per gestire gli altri tipi)
            $stm = $db->prepare($studenti); // Puoi cambiare questa query a seconda del tipo di utente
            $stm->bindValue(':id', $userId);
            $stm->execute();
            $res = $stm->fetch(PDO::FETCH_ASSOC);
            $stm->closeCursor();
            
            // Se i dati sono stati trovati, ritorna le informazioni
            if ($res) {
                return [
                    'id' => $userId,
                    'username' => $result['username'],
                    'nome' => $res['nome'],
                    'cognome' => $res['cognome'], // Corretto l'errore
                    'data' => $res['data_nascita'],
                    'luogo' => $res['luogo_nascita'],
                    'access' => 'studente' // Cambia questo valore in base al tipo di utente
                ];
            }
            // Decidi quale query eseguire in base al tipo di utente (aggiungi logica per gestire gli altri tipi)
            $stm = $db->prepare($genitori); // Puoi cambiare questa query a seconda del tipo di utente
            $stm->bindValue(':id', $userId);
            $stm->execute();
            $res = $stm->fetch(PDO::FETCH_ASSOC);
            $stm->closeCursor();
            
            // Se i dati sono stati trovati, ritorna le informazioni
            if ($res) {
                return [
                    'id' => $userId,
                    'id_genitore'=>$result['id'],
                    'username' => $result['username'],
                    'nome' => $res['nome'],
                    'cognome' => $res['cognome'], // Corretto l'errore
                    'data' => $res['data_nascita'],
                    'luogo' => $res['luogo_nascita'],
                    'access' => 'genitore' 
                ];
            }
            $stm = $db->prepare($personale);
            $stm->bindValue(':id', $userId);
            $stm->execute();
            $res = $stm->fetch(PDO::FETCH_ASSOC);
            $stm->closeCursor();
            
            // Se i dati sono stati trovati, ritorna le informazioni
            if ($res) {
                return [
                    'id' => $userId,
                    'username' => $result['username'],
                    'nome' => $res['nome'],
                    'cognome' => $res['cognome'], // Corretto l'errore
                    'data' => $res['data_nascita'],
                    'luogo' => $res['luogo_nascita'],
                    'access' => 'personale' 
                ];
            }
        } else {
            // Se il login non è riuscito, ritorna null
            return null;
        }
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}

function OttieniFigli(){
    global $db;
    $query = "SELECT *
    FROM famiglie f
    LEFT JOIN studenti s
    ON s.id=f.studente
    LEFT JOIN persone p
    ON  p.id=s.persona
    WHERE f.genitore=:id";
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); // Avvia la sessione solo se non è già attiva
    }
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $_SESSION['user']['id_genitore']);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        var_dump($result);
        return $result;
    }catch (Exception $e) {
        logError($e);
        return null;
    }
}

function OttieniClassi(){
    global $db;
    $query = "SELECT c.sezione,c.id,c.anno,c.articolazione,c.anno_scolastico,m.nome  as materia,i.nome as indirizzo,a.nome as articolazione
     FROM docenticlassi d
    LEFT JOIN classi c 
    ON c.id =d.classe
    LEFT JOIN materie m
    ON m.id=d.materia
    LEFT JOIN articolazioni a
    ON c.articolazione=a.id
    LEFT JOIN indirizzi i
    ON i.id=a .indirizzo
    WHERE d.docente=:id";
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Avvia la sessione solo se non è già attiva
}    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $_SESSION['user']['id']);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        //var_dump($result);
        return $result;
    }catch (Exception $e) {
        logError($e);
        return null;
    }
}
function OttieniPianoStudi($classe){
    global $db;
    $art="SELECT*
    FROM classi
    where id=:id";

    $query = "SELECT m.nome as materia
    FROM pianistudio p
    LEFT JOIN materie m
    ON m.id=p.materia
    LEFT JOIN articolazioni a
    ON a.id=p.articolazione
    WHERE articolazione=:art";
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); // Avvia la sessione solo se non è già attiva
    }
    
    try {
        $stm = $db->prepare($art);
        $stm->bindValue(':id', $classe);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        $stm = $db->prepare($query);
        $stm->bindValue(':art', $result['articolazione']);
        $stm->execute();
        $piano=$stm->fetchAll(PDO::FETCH_ASSOC);
        return $piano;
    }catch (Exception $e) {
        logError($e);
        return null;
    }
}

