<?php
/*
 * $GET e POST sono dette supergloabl
 * sono variabili globali,ovvero visibili a tutti gli script
 * $_GET
 * $_POST
 * $_SERVER
 * $_COOKIE-gestione dei cookie
 * $_SESSION-gestione della sessione
 * $_FILES
 * $_ENV
 * $_REQUEST
 * */
echo $_SERVER['SERVER_NAME'];
echo '<br>';
echo $_SERVER['SERVER_PORT'];
echo '<br>';
echo $_SERVER['REQUEST_METHOD'];
echo '<br>';
echo $_SERVER['PHP_SELF'];
echo '<br>';
echo  $_SERVER['REQUEST_URI'];
echo '<br>';
$url=parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY);
echo $url;
var_dump($_SERVER);