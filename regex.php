<?php
$pattern1='#^abc#';
$pattern4='#abc#';//guarda se ce dentro o no
$pattern2='#abc$#';
$pattern3='#^abc$#';//^ inizio - $ fine
$subject1='ciaof5';
$pattern5='#a[123]b#';// in mezzo ci deve essere o 1 o 2 o 3
$pattern6='#a[0-6]b#';
$pattern7='#a[0-6]*b#';
$pattern8='#a[0-9]*b#';//con * opzionale
$pattern9='#ciao[a-z0-9]+#';//con + almeno uno obbligatorio
$pattern10='#home/index/[a-z]+.php#';
$subject='home/index/products.php';
$pattern11='#localhost/[a-z]+#';//con questo lui trova solo fino a localhost/home/
$pattern11='#localhost(/[a-z]+){2,5}.php#';//lui cerca sto pattern da min 2 fino a 5
$subject='localhost/home/index/products/banana.php';
//$subject='a12d';
//$subject='bcd';
//$subject='1234abc';
$pattern12='#^info#';
$pattern13='#atica$#';
$pattern14='#[aeiou0-5]#';
$pattern15='#http://www.iisviolamarchesini.edu.it/[a-z0-9]#';
$pattern16='#home/index(/[a-z0-9]+){2,4}.php#';
$pattern17='#localhost(/[a-z]+){2,4}.php#';

$pattern18='#localhost(/[A-Za-z]+){2,4}.php#';


if(preg_match($pattern11,$subject,$matches)) {
    echo 'trovato'.'<br>';
    var_dump($matches);
}
    else{
        echo 'non trovato';
    }
