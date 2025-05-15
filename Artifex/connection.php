<?php
require 'config/dbconfig.php';
require_once 'config/dbcon.php';
$config= require 'config/dbconfig.php';
$db=dbcon::getDb($config);

if(session_status()===PHP_SESSION_NONE){
    session_start();
}
function logError(Exception $e): void
{
    error_log($e->getMessage() . "---" . date('Y-m-d H:i:s' . "\n"), 3, 'dberror/error_logfile.log');
    echo "DB error.Try again";
}


function Login($email, $password) :?array {
    global $db;
    $query = "SELECT * FROM utenti u WHERE email = :email";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':email', $email);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        if ($result && password_verify($password, trim( $result['password']))) {
            return [
                'username' => $result['nome'],
                'email' => $result['email'],
                'telefono'=>$result['telefono'],
                'lingua'=>$result['lingua'],
                'nazionalita'=>$result['nazionalita']
            ];
        } else {
            return null;
        }
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}


function Register($username, $password, $email,$lingua,$nazionalita,$telefono) :bool
{
    global $db;
    $query = "INSERT INTO utenti (nome, password, email,lingua,nazionalita,telefono) VALUES (:username, :password, :email,:lingua,:nazionalita,:telefono)";
    $check = "SELECT * FROM utenti WHERE nome = :username OR email = :email";
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
        $stm->bindValue(':lingua',$lingua );
        $stm->bindValue(':telefono',$telefono );
        $stm->bindValue(':nazionalita',$nazionalita);
        $stm->execute();
        $stm->closeCursor();
        return true;
    } catch (Exception $e) {
        logError($e);
        return false;
    }
}

function OttieniLingue():?array{
    global $db;
    $query = "SELECT * FROM lingue";
    try {
        $stm = $db->prepare($query);
        $stm->execute();
        $lingue = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
        return null;
    }
    return $lingue;
}

function OttieniEventi():?array{
    global $db;
    $query="SELECT e.titolo,e.luogo,e.prezzo,g.nome as guida,l.nome as lingua,e.id,TIMEDIFF(e.ora_fine, e.ora_inizio) AS durata,DATE(e.ora_inizio) AS data 
        FROM eventi e 
    LEFT JOIN guide g
    ON g.id=e.guida
    LEFT JOIN lingue l
    ON l.id=e.lingua";
    try {
        $stm = $db->prepare($query);
        $stm->execute();
        $eventi = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $eventi;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}

function Prenotazione($evento):bool{
    global $db;
    $query="INSERT INTO carrello (utente,evento) VALUES (:user,:evento)";
    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':evento',$evento);
        $stm->bindValue(':user',$_SESSION['user']['email']);
        $stm->execute();
        $stm->closeCursor();
        return true;
    } catch (Exception $e) {
        logError($e);
        return false;
    }
}

function RimuoviPrenotazione($evento):bool{
    global $db;
    $query="DELETE FROM carrello WHERE evento=:evento AND utente=:user";
    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':evento',$evento);
        $stm->bindValue(':user',$_SESSION['user']['email']);
        $stm->execute();
        $stm->closeCursor();
        return true;
    } catch (Exception $e) {
        logError($e);
        return false;
    }
}

function RimuoviTuttePrenotazioni():bool{
    global $db;
    $query="DELETE FROM carrello WHERE utente=:user";
    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':user',$_SESSION['user']['email']);
        $stm->execute();
        $stm->closeCursor();
        return true;
    } catch (Exception $e) {
        logError($e);
        return false;
    }
}

function OttieniPrenotazioni(){
    global $db;
    $query="SELECT e.id,e.titolo,e.luogo,e.prezzo,g.nome as guida,l.nome as lingua,e.id,TIMEDIFF(e.ora_fine, e.ora_inizio) AS durata,DATE(e.ora_inizio) AS data 
        FROM carrello c
    LEFT JOIN eventi e
    ON e.id=c.evento
    LEFT JOIN guide g
    ON g.id=e.guida
    LEFT JOIN lingue l
    ON l.id=e.lingua
    WHERE utente=:user";
    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':user',$_SESSION['user']['email']);
        $stm->execute();
        $eventi=$stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $eventi;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}
function OttieniDatePagamento(){
    global $db;
    $query="SELECT DISTINCT p.data_pagamento 
        FROM prenotare p
        WHERE utente=:user";
    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':user',$_SESSION['user']['email']);
        $stm->execute();
        $eventi=$stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $eventi;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}
function OttieniStorico(){
    global $db;
    $date=OttieniDatePagamento();
    $query="SELECT e.titolo,e.luogo,e.prezzo,g.nome as guida,l.nome as lingua,e.id,TIMEDIFF(e.ora_fine, e.ora_inizio) AS durata,DATE(e.ora_inizio) AS data,p.data_pagamento as pagamento 
        FROM prenotare p
    LEFT JOIN eventi e
    ON e.id=p.evento
    LEFT JOIN guide g
    ON g.id=e.guida
    LEFT JOIN lingue l
    ON l.id=e.lingua
    WHERE utente=:user AND data_pagamento=:data";
    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }
    try {
        $stm = $db->prepare($query);
        foreach ($date as $d){
            $data=$d['data_pagamento'];
            $data=date('Y-m-d', strtotime($data));
            $stm->bindValue(':data',$data);
            $stm->bindValue(':user',$_SESSION['user']['email']);
            $stm->execute();
            $eventi[$data]=$stm->fetchAll(PDO::FETCH_ASSOC);
        }
        $stm->closeCursor();
        return $eventi;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}
function OttieniStoricoData($data){
    global $db;
    $query="SELECT e.titolo,e.luogo,e.prezzo,g.nome as guida,l.nome as lingua,e.id,TIMEDIFF(e.ora_fine, e.ora_inizio) AS durata,DATE(e.ora_inizio) AS data,p.data_pagamento as pagamento 
        FROM prenotare p
    LEFT JOIN eventi e
    ON e.id=p.evento
    LEFT JOIN guide g
    ON g.id=e.guida
    LEFT JOIN lingue l
    ON l.id=e.lingua
    WHERE utente=:user AND data_pagamento=:data";
    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }
    try {
        $stm = $db->prepare($query);
            $data=date('Y-m-d', strtotime($data));
            $stm->bindValue(':data',$data);
            $stm->bindValue(':user',$_SESSION['user']['email']);
            $stm->execute();
            $eventi=$stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $eventi;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}
function Pagamento():bool{
    global $db;
    $eventi=OttieniPrenotazioni();
    if (!$eventi){
        return false;
    }
    $query="INSERT INTO prenotare (utente,evento,data_pagamento)
    VALUES (:utente,:evento,CURRENT_DATE())";


    try {
        $stm = $db->prepare($query);
        foreach ($eventi as $evento){
            $stm->bindValue(':utente',$_SESSION['user']['email']);
            $stm->bindValue(':evento',$evento['id']);
            $stm->execute();
        }
        $stm->closeCursor();
        RimuoviTuttePrenotazioni();
        return true;
    } catch (Exception $e) {
        logError($e);
        return false;
    }
}

function RimuoviPrenotazioneStorico($evento){
    global $db;
    $query="DELETE FROM prenotare WHERE evento=:evento AND utente=:user";

    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':evento',$evento);
        $stm->bindValue(':user',$_SESSION['user']['email']);
        $stm->execute();
        $stm->closeCursor();
        return true;
    } catch (Exception $e) {
        logError($e);
        return false;
    }

}

function OttieniInfoPersonali(){
    global $db;
    $query="SELECT u.telefono,u.nazionalita,l.nome as lingua  
            FROM utenti u
         JOIN lingue l ON l.id=u.lingua
         WHERE u.email=:user";
    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':user',$_SESSION['user']['email']);
        $stm->execute();
        $info=$stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $info;
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}

function ModificaDati(){
    global $db;
    $query="UPDATE utenti SET nome=:nome,email=:email,telefono=:telefono,nazionalita=:nazionalita,lingua=:lingua WHERE email=:user";
    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':nome',$_POST['nome']);
        $stm->bindValue(':email',$_POST['email']);
        $stm->bindValue(':telefono',$_POST['telefono']);
        $stm->bindValue(':nazionalita',$_POST['nazionalita']);
        $stm->bindValue(':lingua',$_POST['lingua_base']);
        $stm->bindValue(':user',$_SESSION['user']['email']);
        $stm->execute();
        $stm->closeCursor();
        return true;
    } catch (Exception $e) {
        logError($e);
        return false;
    }
}