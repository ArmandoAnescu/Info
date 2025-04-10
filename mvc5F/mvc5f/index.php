<?php
$appConfig = require 'appConfig.php';
$url=$_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
//echo $method;
//echo'<br>';
$url=strtolower($url);
$url=trim(str_replace($appConfig['prjName'],'',$url),"/");
//echo $url;
require 'Router\Router.php';
$routerClass = new \Router\Router();
$routerClass->addController('GET','home/index','HomeController','presentation1');
$routerClass->addController('GET','home/products','ProductController','show1');
$routerClass->addController('GET','home/services','ServiceController','presentation2');
$routerClass->addController('POST','home/index','HomeController','presentation11');
$routerClass->addController('POST','home/products','ProductController','show11');
$routerClass->addController('POST','home/services','ServiceController','presentation22');

$reValue=$routerClass->match($url,$method);


if(empty($reValue)) {
    http_response_code(404);
    die('Pagina non trovata');
}
$controller = 'App\Controller\\'.$reValue['controller'];
//echo $controller;
//echo'<br>';
$action = $reValue['action'];
//echo $action;
require $controller. ".php";
$controllerObj = new $controller();
$controllerObj->$action();