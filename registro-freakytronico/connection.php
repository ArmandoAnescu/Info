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
    
    $genitori = "SELECT p.nome, p.cognome, p.data_nascita, p.luogo_nascita FROM genitori g
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
        var_dump( $result);
        // Verifica se le credenziali sono corrette
        if ($result && hash('sha256', $password) === $result['password']) {
            echo 'son aqui';
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
                echo 'blabla';
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
        } else {
            // Se il login non è riuscito, ritorna null
            return null;
        }
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}


function prova(){
    global $db;
    $query = "SELECT * FROM persone";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':email', $email);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        var_dump($result);
    }catch (Exception $e) {
        logError($e);
        return null;
    }
}


