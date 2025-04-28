<?php
return [
    'dns' => 'mysql:host=localhost;dbname=dbscuolaAnescu',
    'username' => 'root',
    'password' => '',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]
];
/* 'dns' => 'mysql:host=serverrdbms;dbname=dbscuolaAnescu',
    'username' => 'root',
    'password' => 'cisco',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]
 */