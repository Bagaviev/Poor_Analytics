<?php
	//Багавиев Б.И. ИУ4-83
	//Страница работы с данными сотрудников
	//Последнее обновление 1 Мая 2018
session_name("sess");
session_start();
    // если авторизация не выполнена - возврат на страницу авторизации
if (( !isset ( $_SESSION['log'], $_SESSION['passwd'])) OR (!$_SESSION['type']=="adm"))
 {
    Header ("Location: index.php");
 }
?>

<html>
<head>
  <title>Работа с данными сотрудников</title>
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
 	$show_type = "sotr";
	require_once("interface/sotr_adm.php");
 }
 	// вывод содержимого страницы "оснастка и оборудование" для рабочего
 else if ($_SESSION['type']=="usr")
 {

 }
 require_once('script/show.php');
?>
<br><br><br>
<table align="center" bgcolor="d1d4de" border="1" width="90%" height="10">
<tr>
	<td align="center"> Все права защищены. Москва 2018. Bagaviev Bulat</td>
</tr>
</table>
</body>
</html>