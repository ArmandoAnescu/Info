<?php
$content='data from DB - this is the home page';
$db=new PDO('mysql:host=localhost;dbname=dbitis','root','',
    [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ]
);
$query='SELECT * FROM studenti';
try {
    $stm = $db->prepare($query);//prepara la query
    $stm->execute();//esegue la query
    ob_start();
    while ($student = $stm->fetch()) {//restituisce un valore
        echo "matricola studente: " . $student->matricola_studente . "<br>";
        echo "nome: " . $student->nome . "<br>";
        echo "cognome: " . $student->cognome . "<br>";
        echo "media: " . $student->media . "<br>";
        echo "data iscrizione: " . $student->data_iscrizione . "<br> <hr>";
    }
    $stm->closeCursor();
    $content=ob_get_contents();
    ob_end_clean();
}catch (Exception $e){
    echo $e->getMessage();
}
require 'header.php';//se fai echo ti sposto la navbar
?>
<div>
    <p><?= $content?></p>

</div>
<?php
require 'footer.php';
?>