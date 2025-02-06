<?php
require 'functions.php';
class dbcon
{
    private static PDO $db;
    public static function getDb(array $config){
        if(!isset(self::$db)) {
            try {
                self::$db =new PDO ($config['dns'],$config['username'],$config['password'],$config['options']);
            }catch (PDOException $e){
                logError($e);
            }
        }
        return self::$db;
    }
}