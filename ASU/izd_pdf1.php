<?php 
	//�������� �.�. ��4-83
	//�������� ������ �� �����������
	//��������� ���������� 1 ��� 2018

session_name("sess");
session_start();
  require_once( "system/password.php" ); 
   // ���� ����������� �� ��������� - ������� �� �������� �����������
if (( !isset ( $_SESSION['log'], $_SESSION['passwd'])) && ($_SESSION['type']=="adm"))
 {
    Header ("Location: index.php");
 } 
 
require('PDF/fpdf/fpdf.php');  // ��������� �����������
$pdf=new FPDF();// ����� ���
$pdf->AddFont('ArialRus', '', 'Arial.php');//�������� ������� Arial
 $pdf->AddPage();//������� �����
$pdf->SetFont('ArialRus', '', 12); //�������� Arial
$pdf->Image('PDF/mmap.png', 0, 0, 210, 297);// ������ �� �����������
$conn = OCILogon($dbuser, $dbpass,  $sid);// ����������� � ����
$query = "SELECT * FROM tp1";//������

$s = OCIParse($conn, $query);//  ������������� ������� 
OCIExecute($s, OCI_DEFAULT); // ����� ������������ � defualt � ���������
 $pdf->cell(80, 8, "����� ��������",2);
 $pdf->cell(22, 8, "��������",2);
 $pdf->Ln();
 $i = 0;
while (OCIFetch($s)) {
  $pdf->Text(80, 67+$i*7.5, ociresult($s, "OP_NOTE"));
  $pdf->Text(22, 67+$i*7.5, ociresult($s, "OP_NAME"));
  $i = $i + 1;
}


$pdf->Output('report.pdf');
echo '���� <a href=report.pdf><b>report.pdf</b></a> ������� ������������';

?>