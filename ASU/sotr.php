<?php
	//�������� �.�. ��4-83
	//�������� ������ � ������� �����������
	//��������� ���������� 1 ��� 2018
session_name("sess");
session_start();
    // ���� ����������� �� ��������� - ������� �� �������� �����������
if (( !isset ( $_SESSION['log'], $_SESSION['passwd'])) OR (!$_SESSION['type']=="adm"))
 {
    Header ("Location: index.php");
 }
?>

<html>
<head>
  <title>������ � ������� �����������</title>
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
 	$show_type = "sotr";
	require_once("interface/sotr_adm.php");
 }
 	// ����� ����������� �������� "�������� � ������������" ��� ��������
 else if ($_SESSION['type']=="usr")
 {

 }
 require_once('script/show.php');
?>
<br><br><br>
<table align="center" bgcolor="d1d4de" border="1" width="90%" height="10">
<tr>
	<td align="center"> ��� ����� ��������. ������ 2018. Bagaviev Bulat</td>
</tr>
</table>
</body>
</html>