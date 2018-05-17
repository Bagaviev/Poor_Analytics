<?php 
	//Багавиев Б.И. ИУ4-83
	//Страница работы со статистикой
	//Последнее обновление 1 Мая 2018
/* ini_set('display_errors','On');
error_reporting('E_ALL' & ~'E_NOTICE'); */
session_name("sess");
session_start();
    // если авторизация не выполнена - возврат на страницу авторизации
if (( !isset ( $_SESSION['log'], $_SESSION['passwd'])) && ($_SESSION['type']=="adm"))
 {
    Header ("Location: index.php");
 } 
?> 
<html>
<head>
  <title>Техпроцессы</title>
</head>
<body style = "background-color:#B2DFEE">
<?php
	echo '<table align="center" bgcolor="d1d4de" border="1" width="90%" height="15">
<tr>
	<td align="center"> Автоматизированные информационные системы "АLTERRA CORP."</td>
</tr>
<tr>
	<td align="center"> <b> ОАО "Аврора"</b></td>
</tr>
</table>';
echo '<br>';
/* require_once("system/hello.php"); */
	// вывод содержимого страницы "изделие" для администратора
$show_type = "oper_adm";
/* require_once("interface/izd_adm.php");
require_once('script/show.php'); */
require_once( "system/password.php" );
// вывод данных об операциях
if(( $show_type == "oper" ) OR ( $show_type == "oper_adm" ))
{
 		// запрос к БД на вывод сведенийй об операциях
 		$sql = "SELECT * FROM tp3";
 		$c = OCILogon($dbuser, $dbpass, $sid);
        $stmt = OCIParse($c, $sql);
        OCIExecute($stmt);
        $dbrow = array();
        // создание шапки html отчета
	
        echo "<h3 align = center><b> <basefont size=4> Техпроцесс №3 </b></basefont></h3><br>";
        
		echo "<table width=98% align=center border=1 bordercolor=black cellspacing=1 cellpadding=1>
		         <tr>
		               <td width=10% align=center>Номер</td>
		               <td width=30% align=center>Название</td>";
		echo  "</tr>";
		// вывод данных из ответа Oracle на запрос
        $x=1;      // переменная для задания цвета гcnhjr
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
    <td><center><input type="submit" name="Enter" value="Отчет в PDF" ></center></td>
  </tr>
</table>
</form>
<br><br>
<table align="center" bgcolor="d1d4de" border="1" width="90%" height="10">
<tr>
	<td align="center"> Все права защищены. Москва 2018. Bagaviev Bulat</td>
</tr>
</table>

</body>
</html>