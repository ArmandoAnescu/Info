<?php
require 'C:\xampp\htdocs\pdf-trail\vendor\tecnickcom\tcpdf\tcpdf.php';
require 'connection.php';
if(PHP_SESSION_NONE===session_status()){
    session_start();
}
$data=$_REQUEST['data_pagamento'];
$somma=0;
$prenotazioni=OttieniStoricoData($data);
//var_dump($prenotazioni);
$pdf=new TCPDF();
$pdf->AddPage();//aggiungo una pagina al pdf
$pdf->setFillColor(255,255,255);
$pdf->Rect(0,0,210,297,'F');
$pdf->setTextColor(3,86,252);
$pdf->setFont('Helvetica','',18);
$pdf->Cell(0,10,'Ricevuta pagamento prenotazione del '.$prenotazioni[0]['pagamento'],0,1,'C');//riga del pdf
$pdf->Ln(80);
$pdf->setTextColor(0,0,0);
$pdf->setFont('Helvetica','',14);
$pdf->Cell(0,10,"Name: {$_SESSION['user']['username']} ",0,1,'L');//riga del pdf
$pdf->Ln(10);
foreach ($prenotazioni as $evento){
    $pdf->Cell(0,10,"Nome evento ".$evento['titolo']." Luogo ".$evento['luogo']);
    $pdf->Ln(5);
    $pdf->Cell(0,10,"Data e ora evento: ".$evento['data']);//riga del pdf
    $pdf->Ln(5);
    $pdf->Cell(0,10,"Durata: ".$evento['durata']);
    $pdf->Ln(10);
    $somma+=$evento['prezzo'];
}
$pdf->Cell(0,10,'Data di emissione: ' . date('d/m/Y H:i:s'), 0, 1, 'L');
$pdf->Cell(0,10,'Numero Prenotazione: ' . $_SESSION['user']['email'], 0, 1, 'L');
$pdf->write2DBarcode("Ciao:{$_SESSION['user']['username']} - Uffizi di Firenze data:".date('d/m/y H:i'),'QRCODE,L',10,50,50,50,[],'N');
$pdf->Ln(10);
$pdf->setTextColor(0, 102, 0);
$pdf->Cell(0, 10, 'Pagamento: ' . $somma . ' EUR - Stato: Pagato', 0, 1, 'L');
$pdf->Line(10,10,$pdf->getPageWidth()-10,10);
$pdf->Image('images/image.jpg',$pdf->getPageWidth()-100,$pdf->getPageHeight()-120,90,90);
$pdf->Output('Ticket_'.str_replace('/','-',date('d/m/Y')).'_'.str_replace(' ','_',$_SESSION['user']['username']).'.pdf','D');//crea il pdf