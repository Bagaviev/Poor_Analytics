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
  <title>������ �� ������� ���������� � �������������</title>
</head>
<body style = "background-color:#B2DFEE">

<?php
echo '<table align="center" bgcolor="d1d4de" border="1" width="90%" height="15">
<tr>
	<td align="center"> ������������������ �������������� ������� "�LTERRA CORP."</td>
</tr>
<tr>
	<td align="center"> <b> ��� "������"</b></td>
</tr>
</table>';
echo '<br>';
	// ����� ����������� � ������ ������
require_once("system/hello.php");
	// ����� ����������� �������� "��������" ��� ��������������
if ($_SESSION['type']=="adm")
 {
 	$del_type = "kompl";
 	$add_type = "kompl";
 	$show_type = "kompl_adm";
	require_once("interface/kompl_adm.php");
 }
 	// ����� ����������� �������� "��������" ��� ��������
 else if ($_SESSION['type']=="usr")
 {
	require_once("interface/main_usr.php");
	$show_type = "kompl";
 }
 	// ����� ����������� �������� "��������" ��� �����
  else if ($_SESSION['type']=="gst")
 {
	require_once("interface/main_gst.php");
	$show_type = "kompl";
 }
 require_once('script/show.php');
?>
<br><br><br><br>
<table align="center" bgcolor="d1d4de" border="1" width="90%" height="10">
<tr>
	<td align="center"> ��� ����� ��������. ������ 2018. Bagaviev Bulat</td>
</tr>
</table>

</body>
</html>