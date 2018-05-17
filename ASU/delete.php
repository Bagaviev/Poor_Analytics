<html>

<head>
  <title></title>
</head>

<body style = "background-color:#B2DFEE">
<?php
	//Багавиев Б.И. ИУ4-83
	//Скрипт удаления данных
	//Последнее обновление 1 Мая 2018
    // если авторизация не выполнена - возврат на страницу авторизации
session_name("sess");
session_start();
if ( !isset ( $_SESSION['log'], $_SESSION['passwd'], $_SESSION['type']))
{
    Header( "Location: index.php" );
}
require_once( "../system/password.php" );
// удаление сотрудника
if ( $_GET['table'] == "personal")
{	 $sql = "DELETE FROM personal WHERE per_id = " . $_GET['per_id']."";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
     Header( "Location: ../sotr.php" );
}
// удаление операции
elseif ( $_GET['table'] == "operation")
{
	 $sql = "DELETE FROM operation WHERE op_id = " . $_GET['op_id']."";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
     Header( "Location: ../oper.php" );
}
// удаление материалов и комплектующих
elseif ( $_GET['table'] == "komplekt")
{
	 $sql = "DELETE FROM komplekt WHERE kom_id = " . $_GET['kom_id']."";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
     Header( "Location: ../kompl.php" );
}
// удаление оснастки и оборудования
elseif ( $_GET['table'] == "osnastka")
{
	 $sql = "DELETE FROM osnastka WHERE os_id = " . $_GET['os_id']."";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
     Header( "Location: ../osn.php" );
}
// очистка списка выполненных операций
elseif ( $_GET['table'] == "proizvodstvo")
{
	 $sql = "DELETE FROM proizvodstvo";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
     Header( "Location:../stat.php" );
}
elseif ( $_GET['table'] == "izdelie")
{
	 $sql = "DELETE FROM izdelie WHERE izd_id = " . $_GET['izd_id']."";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
     Header( "Location:../izd.php" );
}
OCICommit($c);
OCILogoff($c);
?>
</body>
</html>