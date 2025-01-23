<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" >
    <title>display</title>
</head>
<body>
<h1>Your data</h1>
<p>Utente :<?php echo $name." ".$surname." ".$email." ".$password?></p>
<p>Il dbms evita: <?php echo $avoid;
    echo $avoid=="ridondanza"?$checkmark:$crossmark?></p>
<p>acid sta per:</p>
<?php
foreach ($acid as $acronym){
    echo "<p> ".$acronym;
    echo $acronym=="atomicità"||$acronym=="isolazione"?$checkmark:$crossmark."</p>";
}
?>
<p>Si occupa del dbms il: <?php echo $admin;
    echo $admin=="dba"?$checkmark:$crossmark
    ?></p>
<p>Il dbms permette: <?php echo $option;
    echo $option=="concorrenza"?$checkmark:$crossmark
    ?></p>
<br>
<p>domanda aperta: <?php echo $domandaaperta?></p>
<p>
    <?php
    $nVocali=0;
    $nConsonanti=0;
    $charNumerici=0;
    for ($i=0;$i<strlen($domandaaperta);$i++){
        if (is_numeric($domandaaperta[$i])){
            $charNumerici++;
        }elseif (in_array(strtoupper($domandaaperta[$i]),["A","E","I","O","U"])){
            $nVocali++;
        }else{
            $nConsonanti++;
        }
    }
    $parole=explode(" ",$domandaaperta);
    echo "Numero parole: ".count($parole)." Numero vocali: $nVocali numero consonanti: $nConsonanti numeero caratteri numerici: $charNumerici";

    ?>
</p>

</body>
</html>
