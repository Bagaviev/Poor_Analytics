<?php
	//Багавиев Б.И. ИУ4-83
	//‘траница работы со статистикой
	//Последнее обновление 1 Мая 2018
ini_set('display_errors','On');
error_reporting('E_ALL' & ~'E_NOTICE');
session_name("sess");
session_start();
    // если авторизациЯ не выполнена - возврат на страницу авторизации
if ( !isset ( $_SESSION['log'], $_SESSION['passwd'], $_SESSION['type']))
 {
    Header ("Location: index.php");
 }
?>

<html>
<head>
  <title>Работа со статистикой</title>
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
	// вывод содержимого страницы "оснастка и оборудование" для администратора
if ($_SESSION['type']=="adm")
 {
 	$show_type = "stat_adm";
	require_once("interface/stat_adm.php");
 }
 	// вывод содержимого страницы "оснастка и оборудование" для рабочего
 else if ($_SESSION['type']=="usr")
 {
	require_once("interface/stat_usr.php");
	$show_type = "stat";
 }
 	// вывод содержимого страницы "оснастка и оборудование" для гостя
 require_once('script/show.php');
?>
<br>
<table align="center" bgcolor="d1d4de" border="1" width="90%" height="10">
<tr>
	<td align="center"> Все права защищены. Москва 2018. Bagaviev Bulat</td>
</tr>
</table>
</body>
</html>