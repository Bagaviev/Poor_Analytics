<?php 
	//�������� �.�. ��4-83
	//�������� ������ �� �����������
	//��������� ���������� 1 ��� 2018
/* ini_set('display_errors','On');
error_reporting('E_ALL' & ~'E_NOTICE'); */
session_name("sess");
session_start();
    // ���� ����������� �� ��������� - ������� �� �������� �����������
if (( !isset ( $_SESSION['log'], $_SESSION['passwd'])) && ($_SESSION['type']=="adm"))
 {
    Header ("Location: index.php");
 } 
?> 
<html>
<head>
  <title>�����������</title>
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
/* require_once("system/hello.php"); */
	// ����� ����������� �������� "�������" ��� ��������������
$show_type = "oper_adm";
/* require_once("interface/izd_adm.php");
require_once('script/show.php'); */
require_once( "system/password.php" );
// ����� ������ �� ���������
if(( $show_type == "oper" ) OR ( $show_type == "oper_adm" ))
{
 		// ������ � �� �� ����� ��������� �� ���������
 		$sql = "SELECT * FROM tp3";
 		$c = OCILogon($dbuser, $dbpass, $sid);
        $stmt = OCIParse($c, $sql);
        OCIExecute($stmt);
        $dbrow = array();
        // �������� ����� html ������
	
        echo "<h3 align = center><b> <basefont size=4> ���������� �3 </b></basefont></h3><br>";
        
		echo "<table width=98% align=center border=1 bordercolor=black cellspacing=1 cellpadding=1>
		         <tr>
		               <td width=10% align=center>�����</td>
		               <td width=30% align=center>��������</td>";
		echo  "</tr>";
		// ����� ������ �� ������ Oracle �� ������
        $x=1;      // ���������� ��� ������� ����� �cnhjr
        while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
        {
        	if (($x%2)==1)echo "<tr bgcolor=#D2C9AE>";
        	else echo "<tr>";
			echo "	    <td align=center>&nbsp;". $x ."</td>
				        <td>&nbsp;". $dbrow["OP_NAME"] ."</td>";
		
			$x=$x+1;
  		}
  		echo "</table>";
}
?>
<br>
<form action="izd_pdf3.php" method="post">
<table align="center" width="217" height="30"  border="1">
  <tr> <br>
    <td><center><input type="submit" name="Enter" value="����� � PDF" ></center></td>
  </tr>
</table>
</form>
<br><br>
<table align="center" bgcolor="d1d4de" border="1" width="90%" height="10">
<tr>
	<td align="center"> ��� ����� ��������. ������ 2018. Bagaviev Bulat</td>
</tr>
</table>

</body>
</html>