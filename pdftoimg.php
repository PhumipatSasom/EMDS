<?php
include("pdfpack/mpdf.php");
$mpdf=new mPDF('utf-8', array(216,280));
$html = '<h1>My HTML</h1>';
$filename = 'filename';
$mpdf->WriteHTML($html);

$pdf_file = 'temp/'.$filename.'.pdf';
$savepath = 'temp/'.$filename.'.jpg';
$img = new imagick($pdf_file);
$img->setImageFormat('jpg');
$img->writeImage($savepath);

exit;
?>