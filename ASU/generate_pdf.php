<?php
//require "config.php"; 
require_once ('password.php');//���� ������
session_name("sess");//�������� �����
session_start();// ������ ��������

if ( !isset ( $_SESSION['log'], $_SESSION['passwd']))
 {
    Header ("Location: start.php");
 }

require('fpdf/fpdf.php');  // ��������� �����������
$pdf=new FPDF();// ����� ���
$pdf->AddFont('ArialRus', '', 'Arial.php');//�������� ������� Arial
 $pdf->AddPage();//������� �����
$pdf->SetFont('ArialRus', '', 12); //�������� Arial

$conn = OCILogon($dbuser, $dbpass, $sid);// ����������� � ����
$query = "SELECT box_number,box_type FROM box";//������

$s = oci_parse($conn, $query);//  ������������� ������� 
OCIExecute($s, OCI_DEFAULT); // ����� ������������ � defualt � ���������
 $pdf->cell(20, 8, "�����",1);
 $pdf->cell(30, 8, "���",1);
 $pdf->Ln();

while (OCIFetch($s)) { //
  $pdf->cell(20, 8, ociresult($s, "BOX_NUMBER"),1);
  $pdf->cell(30, 8, ociresult($s, "BOX_TYPE"),1);
  $pdf->Ln();
}

$pdf->Output('report.pdf');
echo '���� <a href=report.pdf><b>report.pdf</b></a> ������� ������������';

?>