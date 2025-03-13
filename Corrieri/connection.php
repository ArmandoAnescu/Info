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

function Login($email, $password) :?array
{
    global $db;
    $query = "SELECT u.id,u.username,u.email,u.password FROM utenti u WHERE email=:email";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':email', $email);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        if ($result && password_verify($password, $result['password'])) {
            return [
                'id' => $result['id'],
                'username' => $result['username'],
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
    $query = "INSERT INTO utenti (username, password, email) VALUES (:username, :password, :email)";
    $check = "SELECT * FROM utenti WHERE username = :username OR email = :email";
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