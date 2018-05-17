<?php 
	//Багавиев Б.И. ИУ4-83
	//Страница работы со статистикой
	//Последнее обновление 1 Мая 2018

session_name("sess");
session_start();
  require_once( "system/password.php" ); 
   // если авторизация не выполнена - возврат на страницу авторизации
if (( !isset ( $_SESSION['log'], $_SESSION['passwd'])) && ($_SESSION['type']=="adm"))
 {
    Header ("Location: index.php");
 } 
 
require('PDF/fpdf/fpdf.php');  // подлючаем бибилиотеку
$pdf=new FPDF();// новый док
$pdf->AddFont('ArialRus', '', 'Arial.php');//настройк ашрифта Arial
 $pdf->AddPage();//добавка стран
$pdf->SetFont('ArialRus', '', 12); //устновка Arial
$pdf->Image('PDF/mmap.png', 0, 0, 210, 297);// ссылка на изображение
$conn = OCILogon($dbuser, $dbpass,  $sid);// коннектимся к базе
$query = "SELECT * FROM tp1";//запрос

$s = OCIParse($conn, $query);//  идентификатор запроса 
OCIExecute($s, OCI_DEFAULT); // берем идентификато и defualt и настройки
 $pdf->cell(80, 8, "Номер операции",2);
 $pdf->cell(22, 8, "Название",2);
 $pdf->Ln();
 $i = 0;
while (OCIFetch($s)) {
  $pdf->Text(80, 67+$i*7.5, ociresult($s, "OP_NOTE"));
  $pdf->Text(22, 67+$i*7.5, ociresult($s, "OP_NAME"));
  $i = $i + 1;
}


$pdf->Output('report.pdf');
echo 'Файл <a href=report.pdf><b>report.pdf</b></a> успешно сгенерирован';

?>