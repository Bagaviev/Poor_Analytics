<?php
	//�������� �.�. ��4-83
	//�������� ������ � ����������
	//��������� ���������� 1 ��� 2018
	ini_set('display_errors','On');
error_reporting('E_ALL' & ~'E_NOTICE');
session_name("sess");
session_start();
    // ���� ����������� �� ��������� - ������� �� �������� �����������
if ( !isset ( $_SESSION['log'], $_SESSION['passwd'], $_SESSION['type']))
 {
    Header ("Location: index.php");
 }
?>

<html>
<head>
  <title>������ �� ������� ��������</title>
</head>
<body style = "background-color:#B2DFEE">

<?php
	// ����� ����������� � ������ ������
require_once("system/hello.php");
	// ����� ����������� �������� "��������" ��� ��������������
if ($_SESSION['type']=="adm")
 {
 	$show_type = "oper_adm";
	require_once("interface/oper_adm.php");
 }
 	// ����� ����������� �������� "��������" ��� ��������
 else if ($_SESSION['type']=="usr")
 {
	require_once("interface/main_usr.php");
	$show_type = "oper";
 }
 	// ����� ����������� �������� "��������" ��� �����
  else if ($_SESSION['type']=="gst")
 {
	require_once("interface/main_gst.php");
	$show_type = "oper";
 }
 require_once('script/show.php');
?>
<br><br>
<table align="center" bgcolor="d1d4de" border="1" width="90%" height="10">
<tr>
	<td align="center"> ��� ����� ��������. ������ 2018. Bagaviev Bulat</td>
</tr>
</table>
</body>
</html>