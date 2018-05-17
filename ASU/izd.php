<?php 
	//Багавиев Б.И. ИУ4-83
	//Страница работы со статистикой
	//Последнее обновление 1 Мая 2018
ini_set('display_errors','On');
error_reporting('E_ALL' & ~'E_NOTICE');
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
  <title>Работа с изделиями</title>
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
require_once("system/hello.php");
 $show_type = "izd";

require_once("interface/izd_adm.php");
require_once('script/show.php');
?>
<br><br><br><br>
<table align="center" bgcolor="d1d4de" border="1" width="90%" height="10">
<tr>
	<td align="center"> Все права защищены. Москва 2018. Bagaviev Bulat</td>
</tr>
</table>

</body>
</html>