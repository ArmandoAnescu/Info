<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; //load phpmailer

function InvioEmailConferma($cliente, $responsabile, $dataConsegna, $numeroPlico)
{

    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 2; //for debugging
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'luis.anescu@iisviolamarchesini.edu.it'; //lo username del mittente
        $mail->Password = 'pubi oqza yepj ypvf';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('luis.anescu@iisviolamarchesini.edu.it', name: 'Armando'); //il mittente
        $mail->addAddress($cliente);
        $mail->Subject = 'Consegna di FASTROUTE';
        $mail->isHTML(true);
        $mail->Body = "
        <h3>Caro/a ,</h3>
        <p>Il tuo plico con numero di riferimento <strong>$numeroPlico</strong> è stato consegnato con successo.</p>
        <p>Responsabile della consegna: $responsabile</p>
        <p>Data di consegna: $dataConsegna</p>
        <p>Grazie per aver utilizzato il nostro servizio!(Negro)</p>
    ";
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->send();
        echo 'email inviata con successo';
        return true;
    } catch (\Exception $e) {
        echo "Errore:{$mail->ErrorInfo}";
        return false;
    }
}
