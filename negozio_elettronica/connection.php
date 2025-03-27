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


function Login($email, $password) :?array {
    global $db;
    $query = "SELECT u.nome, u.email, u.pwd,u.amministratore FROM utenti u WHERE email = :email";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':email', $email);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();

        echo "<br> Hash recuperato dal DB: " . $result['pwd'] . "<br>"; // Debug
        echo "<br> Password inserita: " . $password . "<br>"; // Debug

        if ($result && password_verify($password, trim( $result['pwd']))) {
            return [
                'username' => $result['nome'],
                'email' => $result['email'],
                'admin'=>$result['amministratore']
            ];
        } else {
            return null;
        }
    } catch (Exception $e) {
        logError($e);
        return null;
    }
}


function Register($username, $password, $email) :bool
{
    global $db;
    $query = "INSERT INTO utenti (nome, pwd, email,amministratore) VALUES (:username, :password, :email,:admin)";
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
        $stm->bindValue(':admin', false);
        $stm->execute();
        $stm->closeCursor();
        return true;
    } catch (Exception $e) {
        logError($e);
        return false;
    }
}

function OttieniProdotti():?array{
    global $db;
    $query = "SELECT * FROM prodotti";
    try {
        $stm = $db->prepare($query);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $result;
    }catch (Exception $e){
        logError($e);
        return null;
    }
}

function InserisciProdotto($codice,$desc,$costo,$quantita,$data_produzione){
    global $db;
    $query="INSERT INTO negozioelettronica.prodotti (codice, descrizione, costo, quantita, data_produzione)
VALUES (:codice,:desc,:costo,:qt,:data)";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':codice',$codice);
        $stm->bindValue(':desc',$desc);
        $stm->bindValue(':costo',$costo);
        $stm->bindValue(':qt',$quantita);
        $stm->bindValue(':data',$data_produzione);
        $stm->execute();
        $stm->closeCursor();
    }catch (Exception $e){
        logError($e);
        return null;
    }
}

function OttieniProdotto($codice){
    global $db;
    $query = "SELECT * FROM prodotti WHERE codice=:cod";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':cod',$codice);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        var_dump($result);
        $stm->closeCursor();
        return $result;
    }catch (Exception $e){
        logError($e);
        return null;
    }
}

function RimuoviProdotto($codice){
    global $db;
    $query="DELETE FROM prodotti WHERE codice =:cod";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':cod',$codice);
        $stm->execute();
        $stm->closeCursor();
    }catch (Exception $e){
        logError($e);
        return null;
    }
}

function AggiornaProdotto($codice,$desc,$costo,$quantita,$data_produzione){
    global $db;
    $query="UPDATE prodotti
     SET descrizione=:desc, costo=:costo ,quantita=:qt,data_produzione=:data
     WHERE codice=:codice";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':codice',$codice);
        $stm->bindValue(':desc',$desc);
        $stm->bindValue(':costo',$costo);
        $stm->bindValue(':qt',$quantita);
        $stm->bindValue(':data',$data_produzione);
        $stm->execute();
        $stm->closeCursor();
    }catch (Exception $e){
        logError($e);
        return null;
    }
}
