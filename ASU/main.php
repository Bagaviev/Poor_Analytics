<?php
 // �������� �.�. ��4-83
 // ������� �������� �������������
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
  <title>�������</title>
</head>

<body style = "background-color:#B2DFEE">


<?php
	// ����� ����������� � ������ ������
require_once ("system/hello.php");
	// ����� ����������� ������� �������� ��������������
if ($_SESSION['type']=="adm")
 {	require_once ("izd.php");    
 }
 	// ����� ����������� ������� �������� ��������
 else if ($_SESSION['type']=="usr")
 {
	require_once("oper.php");     
 }
 	// ����� ����������� ������� �������� ����� ��� ��������� ������� ������
 else if ($_SESSION['type']=="gst")
 {
    require_once("interface/main_gst.php");
 }
?>

</body>
</html>