<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';//load phpmailer

$mail=new PHPMailer(true);
try {
    $mail->SMTPDebug=2;//for debugging
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth=true;
    $mail->Username='luis.anescu@iisviolamarchesini.edu.it';//lo username del mittente
    $mail->Password='jhxc enkc yjum hgjd';
    $mail->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port=587;
    $mail->setFrom('luis.anescu@iisviolamarchesini.edu.it',name: 'Armando');//il mittente
    $mail->addAddress('angelo.formaggio@iisviolamarchesini.edu.it');
    $mail->Subject='Dichiarazione di indipendenza';
    $mail->Body='Non t’amo come se fossi rosa di sale, topazio
o freccia di garofani che propagano il fuoco:
t’amo come si amano certe cose oscure,
segretamente, tra l’ombra e l’anima.

T’amo come la pianta che non fiorisce e reca
dentro di sé, nascosta, la luce di quei fiori;
grazie al tuo amore vive oscuro nel mio corpo
il concentrato aroma che ascese dalla terra.

T’amo senza sapere come, né quando, né da dove,
t’amo direttamente senza problemi né orgoglio:
così ti amo perché non so amare altrimenti

che così, in questo modo in cui non sono e non sei,
così vicino che la tua mano sul mio petto è mia,
così vicino che si chiudono i tuoi occhi col mio sonno.';
    $mail->CharSet='UTF-8';
    $mail->Encoding='base64';
    $mail->send();
    echo 'email inviata con successo';
}catch (\Exception $e){
    echo "Errore:{$mail->ErrorInfo}";
}