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
    $query = "SELECT * FROM utenti u WHERE email = :email";
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
    $query="SELECT e.titolo,e.luogo,g.nome as guida,l.nome as lingua,e.id,TIMEDIFF(e.ora_fine, e.ora_inizio) AS durata,DATE(e.ora_inizio) AS data 
FROM eventi e 
    LEFT JOIN guide g
    ON g.id=e.guida
    LEFT JOIN lingue l
    ON l.id=e.lingua
";
    try {
        $stm = $db->prepare($query);
        $stm->execute();
        $eventi = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
        return null;
    }
    return $eventi;
}