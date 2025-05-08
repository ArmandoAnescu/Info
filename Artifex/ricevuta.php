<?php
require 'C:\xampp\htdocs\pdf-trail\vendor\tecnickcom\tcpdf\tcpdf.php';
require 'connection.php';
if(PHP_SESSION_NONE===session_status()){
    session_start();
}
$prenotazioni=OttieniStorico();
$pdf=new TCPDF();
$pdf->AddPage();//aggiungo una pagina al pdf
$pdf->setFillColor(255,255,255);
$pdf->Rect(0,0,210,297,'F');
$pdf->setTextColor(3,86,252);
$pdf->setFont('Helvetica','',18);
$pdf->Cell(0,10,'Ricevuta pagamento prenotazione del ',0,1,'C');//riga del pdf
$pdf->Ln(80);
$pdf->setTextColor(252,3,61);
$pdf->setFont('Helvetica','',14);
$pdf->Cell(0,10,"Name: {$_SESSION['user']['username']} ",0,1,'L');//riga del pdf
foreach ($eventi as $evento){
    $pdf->Cell(0,10,"Nome evento".$evento['titolo']." Luogo ".$evento['luogo']."Data e ora evento: ".$evento['data']);//riga del pdf

}
$pdf->Cell(0,10,"Data e ora evento: ".date('d/m/y H:i'),0,1,'L');//riga del pdf
$pdf->write2DBarcode("Ciao:{$_SESSION['user']['username']} - Uffizi di Firenze data:".date('d/m/y H:i'),'QRCODE,L',10,50,50,50,[],'N');
$pdf->Line(10,10,$pdf->getPageWidth()-10,10);
$pdf->Image('logo.jpg',$pdf->getPageWidth()-70,$pdf->getPageHeight()-250,50,50);
$pdf->Output('Ticket.pdf','I');//crea il pdf