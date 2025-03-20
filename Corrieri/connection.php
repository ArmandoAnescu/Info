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


function Login($email, $password): ?array
{
    global $db;
    $query = "SELECT d.nome, d.email, d.password FROM dipendenti d WHERE email = :email";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':email', $email);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();

        echo "<br> Hash recuperato dal DB: " . $result['password'] . "<br>"; // Debug
        echo "<br> Password inserita: " . $password . "<br>"; // Debug

        if ($result && password_verify($password, trim($result['password']))) {
            return [
                'username' => $result['nome'],
                'email' => $result['email']
            ];
        } else {
            return null;
        }
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}


function Register($username, $password, $email): bool
{
    global $db;
    $query = "INSERT INTO dipendenti (nome, password, email) VALUES (:username, :password, :email)";
    $check = "SELECT * FROM dipendenti WHERE nome = :username OR email = :email";
    try {
        $stm = $db->prepare($check);
        $stm->bindValue(':email', $email);
        $stm->bindValue(':username', $username);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        if ($result) {
            return false;
        }
        $stm = $db->prepare($query);
        $stm->bindValue(':username', $username);
        $stm->bindValue(':password', $password);
        $stm->bindValue(':email', $email);
        $stm->execute();
        $stm->closeCursor();
        return true;
    } catch (Exception $e) {
        logError($e);
        return false;
    }
}

function InserisciCliente($cognome, $nome, $indirizzo, $tel, $mail): bool
{
    global $db;
    $query = "INSERT INTO clienti (cognome,nome,indirizzo, email,telefono) VALUES (:surname,:name,:address,:email,:telephone)";
    $check = "SELECT * FROM clienti WHERE cognome = :surname OR email = :email OR telefono=:telephone";
    try {
        $stm = $db->prepare($check);
        $stm->bindValue(':email', $mail);
        $stm->bindValue(':surname', $cognome);
        $stm->bindValue(':telephone', $tel);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        if ($result) {
            return false;
        }
        $stm = $db->prepare($query);
        $stm->bindValue(':name', $nome);
        $stm->bindValue(':surname', $cognome);
        $stm->bindValue(':email', $mail);
        $stm->bindValue(':address', $indirizzo);
        $stm->bindValue(':telephone', $tel);
        $stm->execute();
        $stm->closeCursor();
        return true;
    } catch (Exception $e) {
        logError($e);
        return false;
    }
}

function OttieniClienti(): ?array
{
    global $db;
    $check = "SELECT * FROM clienti";
    try {
        $stm = $db->prepare($check);
        $stm->execute();
        $clienti = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $clienti;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}

function OttieniDipendenti(): ?array
{
    global $db;
    $check = "SELECT * FROM dipendenti";
    try {
        $stm = $db->prepare($check);
        $stm->execute();
        $clienti = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $clienti;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}

function OttieniStati(): ?array
{
    global $db;
    $check = "SELECT * FROM stati";
    try {
        $stm = $db->prepare($check);
        $stm->execute();
        $clienti = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $clienti;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}
function OttieniSedi(): ?array
{
    global $db;
    $check = "SELECT * FROM sedi";
    try {
        $stm = $db->prepare($check);
        $stm->execute();
        $clienti = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $clienti;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}

function InserisciPlico($cliente, $sede_partenza, $sede_arrivo, $responsabile, $consegna, $spedizione, $ritiro, $stato)
{
    global $db;
    $query = "INSERT INTO fastroute.plichi (cliente,sede_partenza, sede_arrivo, responsabile, consegna, stato) 
              VALUES (:cliente,:sede_partenza, :sede_arrivo, :responsabile, :consegna, :stato)";
    try {
        var_dump($stato);
        $stm = $db->prepare($query);
        $stm->bindValue(':cliente', $cliente);
        $stm->bindValue(':sede_partenza', $sede_partenza);
        $stm->bindValue(':sede_arrivo', $sede_arrivo);
        $stm->bindValue(':responsabile', $responsabile);
        $stm->bindValue(':consegna', $consegna);
        $stm->bindValue(':stato', $stato);
        $stm->execute();
        $stm->closeCursor();
        return true;
    } catch (Exception $e) {
        logError($e);
        return false;
    }
}

function ClassificaPlichi()
{
    global $db;
    $query = "SELECT p.id, 
                     c1.nome AS mittente, 
                     s1.nome AS sede_partenza, 
                     s2.nome AS sede_arrivo, 
                     d.nome AS responsabile, 
                     p.spedizione,
                     p.consegna, 
                     p.ritiro, 
                     p.stato 
              FROM fastroute.plichi p
              JOIN fastroute.clienti c1 ON p.cliente = c1.email
              JOIN fastroute.sedi s1 ON p.sede_partenza = s1.id
              JOIN fastroute.sedi s2 ON p.sede_arrivo = s2.id
              JOIN fastroute.dipendenti d ON p.responsabile = d.email
              ORDER BY p.id DESC";

    try {
        $stm = $db->prepare($query);

        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $result;
    } catch (Exception $e) {
        logError($e);
        return [];
    }
}

function OttieniPlicoPerID($id_plico)
{
    global $db;
    $query = "SELECT * FROM plichi WHERE id = :id_plico";

    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':id_plico', $id_plico, PDO::PARAM_INT);
        $stm->execute();
        $plico = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $plico;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}

function AggiornaPlico($id_plico, $cliente, $sede_partenza, $sede_arrivo, $responsabile, $consegna, $spedizione, $ritiro, $stato)
{
    // Prima recuperiamo il plico per confrontare lo stato attuale con quello nuovo
    $plico_attuale = OttieniPlicoPerID($id_plico);

    // Se lo stato cambia da un altro stato a "consegnato", invia l'email
    if ($plico_attuale && $plico_attuale['stato'] !== 'Consegnato' && $stato === 'Consegnato') {
        require 'sendEmail.php';
        // Recupera i dati necessari per l'email
        $cliente_email = $cliente; // L'email del cliente
        $responsabile_email = $responsabile; // Nome del responsabile

        // Funzione per inviare l'email (vedi esempio precedente)
        $res = InvioEmailConferma($cliente, $responsabile_email, $consegna, $id_plico);
        if (!$res) {
            return false; // Se non riesce a inviare l'email
        }
    }
    global $db;
    $query = "UPDATE plichi SET cliente = :cliente, sede_partenza = :sede_partenza, sede_arrivo = :sede_arrivo, responsabile = :responsabile, 
              consegna = :consegna, spedizione = :spedizione, ritiro = :ritiro, stato = :stato WHERE id = :id_plico";

    try {
        $stm = $db->prepare($query);
        $stm->execute(compact('id_plico', 'cliente', 'sede_partenza', 'sede_arrivo', 'responsabile', 'consegna', 'spedizione', 'ritiro', 'stato'));
        return true;
    } catch (Exception $e) {
        logError($e);
        return false;
    }
}
