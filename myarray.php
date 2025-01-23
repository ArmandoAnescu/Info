<?php

//echo phpinfo();

//array dinamico (senza dimensione)
$names = [
    'Bob',
    'Lucy',
    'Mary',
    'Anthony',
];

$names[] = 'Kamala'; //elemento aggiunto

//ciclo for
for($i = 0; $i < count($names); $i++)
    echo $names[$i].'<br>';

//restituisce il tipo e la posizione di dati
var_dump($names);

//ciclo foreach
foreach ($names as $name)
    echo $name.'<br>';

//elemento eliminato
unset($names[2]);

//visualizzazione dopo l'eliminazione, senza l'if da errore
for($i = 0; $i < count($names); $i++)
    if(isset($names[$i]))
        echo $names[$i].'<br>';
var_dump($names);

echo '<br>';

//foreach controlla in automatico, non serve l'if
foreach ($names as $name)
    echo $name.'<br>';

$newNames = array_values($names);
echo '<br>';
for($i = 0; $i < count($newNames); $i++)
    echo $newNames[$i].'<br>';
var_dump($newNames);


//array associativi
$students = [
    'Alice' => 7,
    'Bob' => 6,
    'Mary' => 8,
];

echo $students['Bob'];
echo '<br>';

foreach ($students as $key => $value) {
    echo $key.' '.$value.'<br>';
}

//provare le funzioni array su classroom: cosa fa la funzione?, parametri della funzione?, la funzione modifica l'array?

















