<?php

echo getcwd(); //restituisce il path assoluto del file (C:\xampp\htdocs\uda5F)
echo DIRECTORY_SEPARATOR;
echo '<br>';

//creare un file prova.txt e controllare la sua esistenza
$path = getcwd();
echo is_file($path.DIRECTORY_SEPARATOR.'prova.txt') ? 'file trovato' : 'file non trovato'; //is_file() cerca il percorso di un file
echo '<br>';

//creare una directory mydir e controllare la sua esistenza
$path = getcwd();
echo is_dir($path.DIRECTORY_SEPARATOR.'mydir') ? 'directory trovata' : 'directory non trovata'; //is_dir() cerca il percorso di una directory
echo '<br>';

$items = scandir($path.DIRECTORY_SEPARATOR.'mydir'); //scandir() scannerizza la directory e prende il suo contenuto, ottiene un array di stringhe che contiene i nomi dei file nella directory
echo '<ul>';
foreach ($items as $item) //mostra il contenuto della directory
    if(str_starts_with($item, 'f')) //non stampa '..' e '.' ma solo i file
        echo '<li>'.$item.'</li>';
echo '</ul>';

//leggere file prova.txt e visualizza tutto in una riga
$text = file_get_contents($path.DIRECTORY_SEPARATOR.'prova.txt');
echo '<div>'.$text.'</div>';

//leggere file prova.txt rispettando le righe e gli andare a capo
$rows = file($path.DIRECTORY_SEPARATOR.'prova.txt');
foreach($rows as $row){
    echo '<div>'.$row.'</div>';
}

//scrivere dentro il file prova.txt
$message = 'Ciao ciao, questo è un messaggio';
file_put_contents($path.DIRECTORY_SEPARATOR.'prova.txt', $message, FILE_APPEND);

$subjects = ['informatica', 'sistemi e reti', 'tpsit'];
$names = implode("\n", $subjects); //implode() trasforma un array in una stringa
file_put_contents($path.DIRECTORY_SEPARATOR.'subjects.txt', $names);

/*
fopen() apertura
fclose() chiusura
fwrite() scrittura
fget() lettura
feof() trova fine del file
*/