<?php
	//�������� �.�. ��4-83
	//�������� ������ �� �����������
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
  <title>������ �� �����������</title>
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
	// ����� ����������� �������� "�������� � ������������" ��� ��������������
if ($_SESSION['type']=="adm")
 {
 	$show_type = "stat_adm";
	require_once("interface/stat_adm.php");
 }
 	// ����� ����������� �������� "�������� � ������������" ��� ��������
 else if ($_SESSION['type']=="usr")
 {
	require_once("interface/stat_usr.php");
	$show_type = "stat";
 }
 	// ����� ����������� �������� "�������� � ������������" ��� �����
 require_once('script/show.php');
?>
<br>
<table align="center" bgcolor="d1d4de" border="1" width="90%" height="10">
<tr>
	<td align="center"> ��� ����� ��������. ������ 2018. Bagaviev Bulat</td>
</tr>
</table>
</body>
</html>