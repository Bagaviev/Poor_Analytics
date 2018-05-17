<?php
//require "config.php"; 
require_once ('password.php');//база данных
session_name("sess");//название сесси
session_start();// сессия стпртует

if ( !isset ( $_SESSION['log'], $_SESSION['passwd']))
 {
    Header ("Location: start.php");
 }

require('fpdf/fpdf.php');  // подлючаем бибилиотеку
$pdf=new FPDF();// новый док
$pdf->AddFont('ArialRus', '', 'Arial.php');//настройк ашрифта Arial
 $pdf->AddPage();//добавка стран
$pdf->SetFont('ArialRus', '', 12); //устновка Arial

$conn = OCILogon($dbuser, $dbpass, $sid);// коннектимся к базе
$query = "SELECT box_number,box_type FROM box";//запрос

$s = oci_parse($conn, $query);//  идентификатор запроса 
OCIExecute($s, OCI_DEFAULT); // берем идентификато и defualt и настройки
 $pdf->cell(20, 8, "Номер",1);
 $pdf->cell(30, 8, "Тип",1);
 $pdf->Ln();

while (OCIFetch($s)) { //
  $pdf->cell(20, 8, ociresult($s, "BOX_NUMBER"),1);
  $pdf->cell(30, 8, ociresult($s, "BOX_TYPE"),1);
  $pdf->Ln();
}

$pdf->Output('report.pdf');
echo 'Файл <a href=report.pdf><b>report.pdf</b></a> успешно сгенерирован';

?>