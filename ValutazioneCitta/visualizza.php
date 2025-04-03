<?php
require 'citta.php';
$citta=require 'citta.php';
//var_dump($_POST);
$voti=[];
foreach ($_POST as $key=>$value){
    $voti[$key]=intval($value);
}
asort($voti);
//var_dump($voti);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
        <tr>
            <th>
                Città
            </th>
            <th>
                Voto
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($voti as $city=>$voto){
        ?>
            <tr>
                <td> <?=$city?></td>
                <td> <?=$voto?></td>
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
</body>
</html>
