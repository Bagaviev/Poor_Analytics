<?php
 // Ѕагавиев Ѕ.». »”4-83
 // √лавна€ страница пользователей
session_name("sess");
session_start();
    // если авторизаци€ не выполнена - возврат на страницу авторизации
if ( !isset ( $_SESSION['log'], $_SESSION['passwd'], $_SESSION['type']))
 {
    Header ("Location: index.php");
 }
?>
<html>

<head>
  <title>√лавна€</title>
</head>

<body style = "background-color:#B2DFEE">


<?php
	// вывод приветстви€ и ссылки выхода
require_once ("system/hello.php");
	// вывод содержимого главной страницы администратора
if ($_SESSION['type']=="adm")
 {	require_once ("izd.php");    
 }
 	// вывод содержимого главной страницы рабочего
 else if ($_SESSION['type']=="usr")
 {
	require_once("oper.php");     
 }
 	// вывод содержимого главной страницы гост€ или работника другого отдела
 else if ($_SESSION['type']=="gst")
 {
    require_once("interface/main_gst.php");
 }
?>

</body>
</html>