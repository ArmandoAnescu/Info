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
    try {
        // Prima recupera le credenziali dell'utente
        $stm = $db->prepare("SELECT * FROM credenziali WHERE username = :username");
        $stm->bindValue(':username', $username);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);

        // Verifica se le credenziali sono corrette
        if (!$result || hash('sha256', $password) !== $result['password']) {
            return null;
        }
        $userId = $result['id'];
        // Utilizziamo un array di query per i diversi tipi di utente
        $userQueries = [
            'docente' => "SELECT p.nome, p.cognome, p.data_nascita, p.luogo_nascita, d.id as tipo_id 
                          FROM docenti d
                          LEFT JOIN persone p ON d.persona = p.id 
                          WHERE d.credenziali = :id",

            'studente' => "SELECT p.nome, p.cognome, p.data_nascita, p.luogo_nascita, s.id as tipo_id 
                           FROM studenti s
                           LEFT JOIN persone p ON s.persona = p.id 
                           WHERE s.credenziali = :id",

            'genitore' => "SELECT p.nome, p.cognome, p.data_nascita, p.luogo_nascita, g.id as tipo_id 
                           FROM genitori g
                           LEFT JOIN persone p ON g.persona = p.id 
                           WHERE g.credenziali = :id",

            'personale' => "SELECT p.nome, p.cognome, p.data_nascita, p.luogo_nascita, pe.id as tipo_id 
                            FROM personale pe
                            LEFT JOIN persone p ON pe.persona = p.id 
                            WHERE pe.credenziali = :id"
        ];

        // Prova a trovare l'utente nei vari tipi
        foreach ($userQueries as $userType => $query) {
            $stm = $db->prepare($query);
            $stm->bindValue(':id', $userId);
            $stm->execute();
            $res = $stm->fetch(PDO::FETCH_ASSOC);

            if ($res) {
                $userData = [
                    'id' => $res['tipo_id'],  // ID della tabella specifica (docente/studente/genitore/personale)
                    'id_credenziali' => $userId,  // ID delle credenziali
                    'username' => $result['username'],
                    'nome' => $res['nome'],
                    'cognome' => $res['cognome'],
                    'data' => $res['data_nascita'],
                    'luogo' => $res['luogo_nascita'],
                    'access' => $userType
                ];

                return $userData;
            }
        }

        // Se arriviamo qui, l'utente ha credenziali valide ma non è associato a nessun ruolo
        return null;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}
function OttieniFigli()
{
    global $db;

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Verifica che l'utente sia autenticato e sia un genitore
    if (!isset($_SESSION['user']) || $_SESSION['user']['access'] !== 'genitore') {
        return null;
    }

    try {
        $query = "SELECT s.id AS studente_id, p.id AS persona_id, p.nome, p.cognome, p.data_nascita, p.luogo_nascita
                  FROM famiglie f
                  JOIN studenti s ON s.id = f.studente
                  JOIN persone p ON p.id = s.persona
                  WHERE f.genitore = :id";

        $stm = $db->prepare($query);
        $stm->bindValue(':id', $_SESSION['user']['id']); // Ora usando l'ID corretto del genitore
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();

        return $result;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}

function OttieniClassi()
{
    global $db;

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    try {
        // Prima otteniamo le classi del docente senza duplicati
        $query = "SELECT DISTINCT c.id, c.anno, c.sezione, c.anno_scolastico, a.nome as articolazione, i.nome as indirizzo
                 FROM docenticlassi d
                 LEFT JOIN classi c ON c.id = d.classe
                 LEFT JOIN articolazioni a ON c.articolazione = a.id
                 LEFT JOIN indirizzi i ON i.id = a.indirizzo
                 WHERE d.docente = :id
                 ORDER BY c.anno, c.sezione";

        $stm = $db->prepare($query);
        $stm->bindValue(':id', $_SESSION['user']['id']);
        $stm->execute();
        $classi = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();

        // Per ogni classe, otteniamo le materie insegnate dal docente
        $result = [];
        foreach ($classi as $classe) {
            $queryMaterie = "SELECT m.nome as materia
                           FROM docenticlassi d
                           LEFT JOIN materie m ON m.id = d.materia
                           WHERE d.docente = :id AND d.classe = :classe_id
                           ORDER BY m.nome";

            $stm = $db->prepare($queryMaterie);
            $stm->bindValue(':id', $_SESSION['user']['id']);
            $stm->bindValue(':classe_id', $classe['id']);
            $stm->execute();
            $materie = $stm->fetchAll(PDO::FETCH_COLUMN);
            $stm->closeCursor();

            // Aggiungi le materie all'array della classe
            $classe['materie'] = $materie;
            $result[] = $classe;
        }

        return $result;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}

function OttieniClasse($classe_id)
{
    global $db;
    $query = "SELECT c.anno, c.sezione, c.anno_scolastico, a.nome as articolazione, i.nome as indirizzo
    FROM classi c
    LEFT JOIN articolazioni a ON c.articolazione = a.id
    LEFT JOIN indirizzi i ON i.id = a.indirizzo
    WHERE c.id = :id";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $classe_id);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $result;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}

function OttieniPianoStudi($classe)
{
    global $db;
    $art = "SELECT*
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
        $piano = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $piano;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}

function OttieniClasseStudente($id_alunno)
{
    global $db;

    $query = "SELECT
                c.id, 
                c.anno, 
                c.sezione, 
                c.anno_scolastico, 
                a.nome as articolazione, 
                i.nome as indirizzo
              FROM 
                partecipare p
              INNER JOIN 
                classi c ON p.classe = c.id
              LEFT JOIN 
                articolazioni a ON c.articolazione = a.id
              LEFT JOIN 
                indirizzi i ON i.id = a.indirizzo
              WHERE 
                p.alunno = :id_alunno
             ORDER BY c.anno_scolastico DESC LIMIT 1";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':id_alunno', $id_alunno, PDO::PARAM_INT);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $result;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}

function OttieniStudentiClasse($id_classe)
{
    global $db;
    $query = "SELECT pe.nome,pe.cognome
    FROM partecipare p
    LEFT JOIN studenti s
    ON s.id=p.alunno
    LEFT JOIN persone pe
    ON s.persona=pe.id
    WHERE p.classe=:id
    ORDER BY pe.nome,pe.cognome ASC;";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $id_classe, PDO::PARAM_INT);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $result;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}
