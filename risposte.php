<?php

//var_dump($_POST);
$empty=false;
foreach ($_POST as $key=>$value){
    if(empty($value)){
        $empty=true;
    }
}
echo $empty;
if (!$empty) {


    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $domandaaperta = $_POST['domandaaperta'];
    $avoid = $_POST['avoid'];
    $acid = $_POST['acid'];
    $admin = $_POST['admin'];
    $option = $_POST['option'];

    $checkmark = '<b id="checkmark">&#10003</b>';
    $crossmark = '<b id="crossmark">&#10007</b>';
    include 'pagineRisposte.php';
}else{
    include 'paginaErrore.php';
}
?>

