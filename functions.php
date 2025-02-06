<?php

//declare() di default = 0, altrimenti 1
//declare(strict_types = 0);

//funzione calcolo media
function average($a, $b, $c){
    return ($a + $b + $c)/3;
}
echo average(10, 20, 30);
echo '<br>';

function average2(int $a, int $b, int $c) : int{ //variabili con il tipo, :int è riferito al ritorno
    return ($a + $b + $c)/3;
}
echo average2(10, 20, 30);
echo '<br>';

function average3(int|float $a, int|float $b, int|float $c) : int | float | string { //:int|string è riferito al ritorno, che può essere int o string
    if($a>0 && $b>0 && $c>0)
        return ($a + $b + $c)/3;
    else
        return 'media non calcolata';
}
echo average3(10, 20, 30); //20
echo '<br>';

function average4(int|float $a, int|float $b, int|float $c) : int | float | string { //:int|string è riferito al ritorno, che può essere int o string
    if($a>0 && $b>0 && $c>0)
        return ($a + $b + $c)/3;
    else
        return 'media non calcolata';
}
echo average4(-10, 20, 30); //media non calcolata
echo '<br>';

function average5(?float $a, float $b, float $c) : int | float | string { // ? permette di calcolare la media anche se si mette come valore null
    if($a>0 && $b>0 && $c>0)
        return ($a + $b + $c)/3;
    else
        return 'media non calcolata';
}
echo average5(null, 20, 30); //media non calcolata
echo '<br>';

function logError(Exception $e):void{
    error_log($e->getMessage()."---".date('Y-m-d H:i:s'."\n"),3,'dberror/error_logfile.log');
    echo "DB error.Try again";
}
















































