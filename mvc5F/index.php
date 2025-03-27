<?php
$url=$_SERVER['REQUEST_URI'];
$method=$_SERVER['REQUEST_METHOD']??'GET';

echo $url;
echo '<br>';

echo $method;
$url=trim(str_replace('mvc5F','',$url),"/");
echo '<br>';
echo $url;
/*
 * RewriteEngine On
RewriteRule ^ index.php [L] ^ indica qualsiasi URL e la L è che è l'ultima regoal
 * */
echo '<br>';
#router:version 1
$routes=[
    'GET'=>[//quando mi arriva come url questo chiamo un file php chiamato home controller e chiamerò il metodo di home controller
        'home/index'=>["controller"=>"HomeController","action"=>"presentation1"],
        'home/products'=>["controller"=>"ProductController","action"=>"show1"],
        'home/services'=>["controller"=>"ServiceController","action"=>"presentation1"],
        'home/contacts'=>["controller"=>"ServiceController","action"=>"presentation2"]
    ],
    'POST'=>[

    ]
];
if (!isset($routes[$method])){
    http_response_code(405);
    die('Metodo non supportato');
}
if (!array_key_exists($url,$routes[$method])){
    http_response_code(404);
    die('Pagina non trovata');
}
$controller=$routes[$method][$url]['controller'];
echo $controller;
echo'<br>';
$action=$routes[$method][$url]['action'];
echo $action;
echo '<br>';
require $controller.".php";
$controllerObj=new $controller();
$controllerObj->$action();
