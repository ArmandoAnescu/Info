<?php
$url=$_SERVER['REQUEST_URI'];
$method=$_SERVER['REQUEST_METHOD']??'GET';

//echo $url;
//echo '<br>';

//echo $method;
$url=trim(str_replace('mvc5F','',$url),"/");
//echo '<br>';
//echo $url;
/*
 * RewriteEngine On
RewriteRule ^ index.php [L] ^ indica qualsiasi URL e la L è che è l'ultima regoal
 * */
#router:version 1
require 'router.php';
$routerClass= new router();
$routerClass->addController('GET','home/index','HomeController','presentation1');
$routerClass->addController('GET','home/products','ProductController','show1');
$routerClass->addController('GET','home/services','ServiceController','presentation1');

$routerClass->addController('POST','home/services','ServiceController','presentation11');
$routerClass->addController('POST','home/services','ServiceController','show11');
$routerClass->addController('POST','home/services','ServiceController','presentation12');
$reValue=$routerClass->Match($url,$method);
if (empty($reValue)){
    http_response_code(404);
    die('Pagina non trovata');
}
$controller=$reValue['controller'];
echo $controller;
echo'<br>';
$action=$reValue['action'];
echo $action;
echo '<br>';
require $controller.".php";
$controllerObj=new $controller();
$controllerObj->$action();
//controller=insieme di classi con dei metodi che fanno qualcosa 