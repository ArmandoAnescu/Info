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

function login($password,$email){
    global $db;
    $query="SELECT *
    dipendenti
    WHERE email=:email AND password=:password";
    try {
        $stm = $db->prepare($query);
        $stm->bindValue(":password",$password);
        $stm->bindValue(":email",$email);
        $stm->execute();
        $check=$stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        if ($check['email']===$email&&$check['password']===$password){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        logError($e);
        return null;
    }

}