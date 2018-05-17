<?php
	//Багавиев Б.И. ИУ4-83
	//Страница работы с операциями
	//Последнее обновление 1 Мая 2018
	ini_set('display_errors','On');
error_reporting('E_ALL' & ~'E_NOTICE');
session_name("sess");
session_start();
    // если авторизация не выполнена - возврат на страницу авторизации
if ( !isset ( $_SESSION['log'], $_SESSION['passwd'], $_SESSION['type']))
 {
    Header ("Location: index.php");
 }
?>

<html>
<head>
  <title>Работа со списком материалов и комплектующих</title>
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
	// вывод приветствия и ссылки выхода
require_once("system/hello.php");
	// вывод содержимого страницы "операции" для администратора
if ($_SESSION['type']=="adm")
 {
 	$del_type = "kompl";
 	$add_type = "kompl";
 	$show_type = "kompl_adm";
	require_once("interface/kompl_adm.php");
 }
 	// вывод содержимого страницы "операции" для рабочего
 else if ($_SESSION['type']=="usr")
 {
	require_once("interface/main_usr.php");
	$show_type = "kompl";
 }
 	// вывод содержимого страницы "операции" для гостя
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
	<td align="center"> Все права защищены. Москва 2018. Bagaviev Bulat</td>
</tr>
</table>

</body>
</html>