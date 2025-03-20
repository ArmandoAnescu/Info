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
    $query = "SELECT d.nome, d.email, d.password FROM dipendenti d WHERE email = :email";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':email', $email);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();

        echo "<br> Hash recuperato dal DB: " . $result['password'] . "<br>"; // Debug
        echo "<br> Password inserita: " . $password . "<br>"; // Debug

        if ($result && password_verify($password, trim( $result['password']))) {
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


function Register($username, $password, $email) :bool
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


function InserisciCliente($cognome,$nome,$indirizzo,$tel,$mail) : bool
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
