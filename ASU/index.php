<?php
//�������� �.�. ��4-83
//������ ����������� ��� ���
//��������� ���������� 1 ��� 2018
session_name("sess");
session_start();
?>
<html>
<head>
  <title>�����������</title>
</head>
<body style = "background-color:#B2DFEE">
<table align="center" bgcolor="d1d4de" border="1" width="90%" height="15">
<tr>
	<td align="center"> ������������������ �������������� ������� "�LTERRA CORP."</td>
</tr>
<tr>
	<td align="center"> <b> ��� "������"</b></td>
</tr>
</table>
<br>
 <h2 align="center"> ���� � ������� </h2>
 <hr color=green style="margin-left:50pt; margin-right:50pt">
 <table width="100%" height="5%">
  <tr>
    <td></td>
  </tr>
</table>

<form action="index.php" method="post">
<table align="center" width="217" height="20"  border="0">
  <tr>
    <td><b>�����:&nbsp;&nbsp;&nbsp;</b><input name="ulogin" type="text"><br><br><br></td>
  </tr>
  <tr>
    <td><b>������:</b> <input name="upasswd" type="text"><br><br><br></td>
  </tr>
  <tr>
    <td><center><input type="submit" name="Enter" value="�����������" ></center></td>
  </tr>
</table>
</form>

<?php
	//���� ���������� ����� � ������ �������� � ����� ��������� ��
if ( isset ( $_POST['ulogin'],$_POST['upasswd'] ) )
{
	//������� ���������� ������
	$_SESSION['log']=$_POST['ulogin'];
	$_SESSION['passwd']=$_POST['upasswd'];
	//�������� ������ � ������ ����� ��������� �������� �� ��������� �������
	$sql = "SELECT per_type, per_log, per_pass FROM personal
			WHERE per_log = '" . $_POST['ulogin'] . "' AND per_pass = '" . $_POST['upasswd'] . "'";
	require_once ('system/password.php');
	$c=OCILogon($dbuser, $dbpass, $sid);
    $stmt = OCIParse($c, $sql);
	OCIExecute ($stmt, OCI_DEFAULT);
	$dbrow = array();
	//���� ��������� ������� ����������, ��
	if ( OCIFetchInto ( $stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS ) )
	{
		$_SESSION['type']=$dbrow['PER_TYPE'];
		Header ("Location: main.php");
    }
	//�����
	else if (($_SESSION['log']=="guest") AND ($_SESSION['passwd']=="guest"))
	{		$_SESSION['type']='gst';
		Header ("Location: main.php");
	}
	else
	{
		echo "<h4 align=center >����� ��� ������ �������.<br>���������� ��� ���.</h4>";
	}
	OCICommit($c);
	OCILogoff($c);
}
else
{
}
?>
 <table width="100%" height="5%">
  <tr>
    <td></td>
  </tr>
</table>
 <hr color=green style="margin-left:50pt; margin-right:50pt">
<br><br><br><br>
 <table align="center" bgcolor="d1d4de" border="1" width="90%" height="10">
<tr>
	<td align="center"> ��� ����� ��������. ������ 2018. Bagaviev Bulat</td>
</tr>
</table>

 </body>
</html>