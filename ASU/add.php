<html>

<head>
  <title></title>
</head>

<body style = "background-color:#B2DFEE">
<?php
	//Багавиев Б.И. ИУ4-83
	//Скрипт добавления данных
	//Последнее обновление 1 Мая 2018
    // если авторизация не выполнена - возврат на страницу авторизации
session_name("sess");
session_start();
if ( !isset ( $_SESSION['log'], $_SESSION['passwd'], $_SESSION['type']))
{
    Header( "Location: ../index.php" );
}
require_once( "../system/password.php" );
// форма добавления сотрудника
if ( isset ($_GET['table']) && ($_GET['table'] == "personal"))
{
	require_once ("../system/hello.php");	require_once( "../interface/main_adm.php" );
	echo "<b> <basefont size=4>&nbsp; Добавление сотрудника </b></basefont><br><br>
	      <b> <basefont size=2>&nbsp; Все поля обязательны для заполнения </b></basefont><br><br>
	      <form action=add.php method=post>
	      <table width=30%>
	        <tr>  <td width=50%></td>
		      <td>Имя:</td>
		      <td><input name=pername type=text></td>
	        </tr>
	        <tr>   <td width=50%></td>
		      <td>Фамилия:</td>
		      <td><input name=persurname type=text></td>
		    </tr>
	        <tr>   <td width=50%></td>
		      <td>Телефон:</td>
		      <td><input name=pertel type=text></td>
		    </tr>
	        <tr>   <td width=50%></td>
		      <td>Специальность:</td>
		      <td><input name=perspec type=text></td>
		    </tr>
	        <tr>  <td width=50%></td>
		      <td>Стаж:</td>
		      <td><input name=perst type=text></td>
		    </tr>
	        <tr>  <td></td>
		      <td>Уровень доступа:</td>
		      <td><select name=pertype>
		          <option>usr
		          <option>adm
                  </select> </td>
	        </tr>
	        </tr>
	        <tr>  <td width=50%></td>
		      <td>Логин:</td>
		      <td><input name=perlog type=text></td>
		    </tr>
	        <tr>  <td width=50%></td>
		      <td>Пароль:</td>
		      <td><input name=perpass type=text></td>
		    </tr>
	        <tr> <td width=50%></td>
		      <td></td>
		      <td><input type=submit value=Добавить></td>
		    </tr>
          </table> </form>";
}
// скритп добавления сотрудника
elseif ( !empty ($_POST['pername']) &&  !empty($_POST['persurname']) && !empty($_POST['pertel']) && !empty($_POST['perspec'])
	 && !empty($_POST['perst']) &&  !empty($_POST['pertype']) &&  !empty($_POST['perlog']) &&  !empty($_POST['perpass']))
{	$sql = "INSERT INTO personal (per_name, per_surname, per_stazh, per_tel, per_spec, per_type, per_log, per_pass)
			 VALUES ('". $_POST['pername']."',
			         '". $_POST['persurname']."',
			         to_number ('". $_POST['perst']."'),
			         to_number ('". $_POST['pertel']."'),
			         '". $_POST['perspec']."',
			         '". $_POST['pertype']."',
			         '". $_POST['perlog']."',
			         '". $_POST['perpass']."')";	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
	OCICommit($c);
	OCILogoff($c);
     Header( "Location: ../sotr.php" );
}
// форма добавления операции
elseif ( isset ($_GET['table']) && ($_GET['table'] == "operation"))
{	    require_once ("../system/hello.php");		require_once( "../interface/main_adm.php" );
	    echo "<b> <basefont size=4>&nbsp; Добавление операции </b></basefont><br><br>
	      <b> <basefont size=2>&nbsp; Все поля обязательны для заполнения </b></basefont><br><br>
	      <form action=add.php method=post>
	      <table width=40%>
	        <tr>  <td width=50%></td>
		      <td>Название:</td>
		      <td><input size=50 name=opname type=text></td>
	        </tr>
	        <tr>   <td width=50%></td>
		      <td>Описание:</td>
		      <td><input size=100 name=opnote type=text></td>
		    </tr>
	        <tr> <td width=50%></td>
		      <td></td>
		      <td><input type=submit value=Добавить></td>
		    </tr>
          </table> </form>";}
// скрипт добавления операций
elseif( isset ($_POST['opname']) &&  isset($_POST['opnote']))
{
	$sql = "INSERT INTO operation (op_name, op_note)
			 VALUES ('". $_POST['opname']."',
			         '". $_POST['opnote']."')";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
	OCICommit($c);
	OCILogoff($c);
     Header( "Location: ../oper.php" );
}
// форма добавления комплектующих и материаолов
elseif ( isset ($_GET['table']) && ($_GET['table'] == "komplekt"))
{	require_once ("../system/hello.php");
	require_once( "../interface/main_adm.php" );
	echo "<b> <basefont size=4>&nbsp; Добавление комплектующих и материалов </b></basefont><br><br>
	      <b> <basefont size=2>&nbsp; Все поля обязательны для заполнения </b></basefont><br><br>
	      <form action=add.php method=post>
	      <table border=0 width=60%>
	        <tr>  <td width=10%></td>
		      <td width=25%>Название:</td>
		      <td><input name=komname type=text></td>
	        </tr>
	        <tr>   <td ></td>
		      <td>Количество</td>
		      <td><input name=komkolvo type=text></td>
		    </tr>
	        <tr>   <td></td>
		      <td>Цена за штуку</td>
		      <td><input name=komcost type=text></td>
		    </tr>
	        <tr>  <td></td>
		      <td>Где применяется</td>
		      <td><select name=komopid>";
	 $sql1 = "SELECT DISTINCT op_name FROM operation";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt1 = OCIParse($c, $sql1);
     OCIExecute($stmt1);
     $dbrow1 = array();
	 while (OCIFetchInto($stmt1, $dbrow1, OCI_ASSOC+OCI_RETURN_NULLS))
	 {
	 	echo "     <option>".$dbrow1['OP_NAME'];
	 }
	 echo "    </select> </td>
	        </tr>
	        <tr>  <td></td>
		      <td>Примечание</td>
		      <td><input size=50 name=komnote type=text></td>
		    </tr>
	        <tr> <td></td>
		      <td></td>
		      <td><input type=submit value=Добавить></td>
		    </tr>
          </table> </form>";
	OCICommit($c);
	OCILogoff($c);
}
// скрипт добавления комплектующих и материалов
elseif( !empty ($_POST['komname']) && !empty($_POST['komkolvo']) && !empty($_POST['komcost']) && !empty($_POST['komopid']) &&
!empty ($_POST['komnote']))
{
	$c = OCILogon($dbuser, $dbpass, $sid);
	$sql1 = "SELECT op_id FROM operation WHERE op_name='".$_POST['komopid']."'";
	$stmt1 = OCIParse($c, $sql1);
	OCIExecute($stmt1);
	$dbrow = array();
	while (OCIFetchInto($stmt1, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
	{		$sql2 = "INSERT INTO komplekt (kom_name, kom_cost, kom_kolvo, kom_note, kom_op_id)
			 VALUES ('". $_POST['komname']."',
		   to_number('". $_POST['komcost']."'),
		   to_number('". $_POST['komkolvo']."'),
			         '". $_POST['komnote']."','".$dbrow['OP_ID']."')";
    }
     $stmt2 = OCIParse($c, $sql2);
     OCIExecute($stmt2);
	 OCICommit($c);
	 OCILogoff($c);
     Header( "Location: ../kompl.php" );
}
// форма добавления оснастки и оборудования
elseif ( isset ($_GET['table']) && ($_GET['table'] == "osnastka"))
{
	require_once("../system/hello.php");
	require_once("../interface/main_adm.php" );
	echo "<b> <basefont size=4>&nbsp; Добавление оснастки и оборудования </b></basefont><br><br>
	      <b> <basefont size=2>&nbsp; Все поля обязательны для заполнения </b></basefont><br><br>
	      <form action=add.php method=post>
	      <table border=0 width=60%>
	        <tr>  <td width=10%></td>
		      <td width=25%>Название:</td>
		      <td><input name=osname type=text></td>
	        </tr>
	        <tr>  <td></td>
		      <td>Где применяется</td>
		      <td><select name=osopid>";
	 $sql = "SELECT op_name FROM operation";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
     $dbrow = array();
	 while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
	 {
	 	echo "     <option>".$dbrow['OP_NAME'];
	 }																				///////отсюда
	 echo "    </select> </td>
	        </tr>
	        <tr>  <td></td>
		      <td>Примечание</td>
		      <td><input size=80 name=osnote type=text></td>
		    </tr>
	        <tr> <td></td>                                                
		      <td></td>
		      <td><input type=submit value=Добавить></td>
		    </tr>
          </table> </form>";
	OCICommit($c);
	OCILogoff($c);
}
// скрипт добавления оснастки и оборудования
elseif( isset ($_POST['osname']) && isset($_POST['osopid']) && isset($_POST['osnote']) )
{
	$c = OCILogon($dbuser, $dbpass, $sid);
	$sql1 = "SELECT op_id FROM operation WHERE op_name='".$_POST['osopid']."'";
	$stmt1 = OCIParse($c, $sql1);
	OCIExecute($stmt1);
	$dbrow = array();
	while (OCIFetchInto($stmt1, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
	{
		$sql2 = "INSERT INTO osnastka (os_name, os_note, os_op_id)
			 VALUES ('". $_POST['osname']."',
			         '". $_POST['osnote']."',
			         '". $dbrow['OP_ID']."')";
    }
     $stmt2 = OCIParse($c, $sql2);
     OCIExecute($stmt2);
	 OCICommit($c);
	 OCILogoff($c);
     Header( "Location: ../osn.php" );
}
// форма добавления информации о выполненных операциях
elseif ( isset ($_GET['table']) && ($_GET['table'] == "proizvodstvo"))
{
	require_once("../system/hello.php");
	require_once("../interface/main_usr.php" );
	echo "<b> <basefont size=4>&nbsp; Добавление информации о выполненных операциях </b></basefont><br><br>
	      <b> <basefont size=2>&nbsp; Поля, отмеченные * обязательны для заполнения </b></basefont><br><br>
	      <form action=add.php method=post>
	      <table border=0 width=60%>
	        <tr>  <td width=10%></td>
		      <td width=25%>Операция *</td>
		      <td><select name=propid>";
	 $sql = "SELECT op_name FROM operation";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
     $dbrow = array();
	 while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
		 {
		 	echo "     <option>".$dbrow['OP_NAME'];
		 }
	 echo "    </select> </td>
	        </tr>
	        <tr>  <td></td>
		      <td >Номер изделия *</td>
		      <td><select name=prizdid>";
	 $sql = "SELECT izd_no FROM izdelie";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
     $dbrow = array();
	 while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
	 	{
	 		echo "     <option>".$dbrow['IZD_NO'];
		 }
	 echo "    </select> </td>
	        </tr>
		    <tr>  <td></td>
		      <td>Обнаруженный или допущенный брак</td>
		      <td><input size=50 name=prbrname type=text></td>
		    </tr>
		    <tr>  <td></td>
		      <td>Причина брака</td>
		      <td><input size=50 name=prbrreason type=text></td>
		    </tr>
		    <tr>  <td></td>
		      <td></td>
		      <td><input size=10 name=prnote type=hidden value=выполнил></td>
		    </tr>
	        <tr> <td></td>
		      <td></td>
		      <td><input type=submit value=Добавить></td>
		    </tr>
          </table> </form>";
	OCICommit($c);
	OCILogoff($c);
}
// скрипт добавления информации о выполненных операциях
elseif( isset ($_POST['propid']) && isset($_POST['prizdid']))
{
	$c = OCILogon($dbuser, $dbpass, $sid);
	$sql = "SELECT per_id FROM personal
			 WHERE per_log = '" . $_SESSION['log'] . "' AND per_pass = '" . $_SESSION['passwd'] . "'";
	$stmt = OCIParse($c, $sql);
    OCIExecute($stmt);
    $dbrow = array();
	while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS)) $prperid = $dbrow['PER_ID'];
	$sql1 = "SELECT op_id FROM operation WHERE op_name='".$_POST['propid']."'";
	$stmt1 = OCIParse($c, $sql1);
	OCIExecute($stmt1);
	$dbrow1 = array();
	while (OCIFetchInto($stmt1, $dbrow1, OCI_ASSOC+OCI_RETURN_NULLS)) $propid = $dbrow1['OP_ID'];
	$sql2 = "SELECT izd_id FROM izdelie WHERE izd_no='".$_POST['prizdid']."'";
	$stmt2 = OCIParse($c, $sql2);
	OCIExecute($stmt2);
	$dbrow2 = array();
	while (OCIFetchInto($stmt2, $dbrow2, OCI_ASSOC+OCI_RETURN_NULLS)) $prizdid = $dbrow2['IZD_ID'];
	if ( empty( $_POST['prbrname'] )) $prbrname = " "; else $prbrname = $_POST['prbrname'];
    if ( empty($_POST['prbrreason'] )) $prbrreason = " "; else $prbrreason = $_POST['prbrreason'];
    $sql4="SELECT sysdate FROM dual";
	$stmt4 = OCIParse($c, $sql4);
	OCIExecute($stmt4);
	$dbrow4 = array();
	while (OCIFetchInto($stmt4, $dbrow4, OCI_ASSOC+OCI_RETURN_NULLS)) $prdate = $dbrow4['SYSDATE'];
	$sql3 = "INSERT INTO proizvodstvo (pr_op_id, pr_per_id, pr_izd_id, pr_note, pr_date, pr_brname, pr_brreason)
		     VALUES ('". $propid."',
			         '". $prperid."',
			         '". $prizdid."',
			         '". $_POST['prnote']."',
                     '". $prdate."',
			         '". $prbrname."',
			         '". $prbrreason."')";
     $stmt3 = OCIParse($c, $sql3);
     OCIExecute($stmt3);
	 OCICommit($c);
	 OCILogoff($c);
     Header( "Location: ../stat.php" );
}
// форма добавления изделий
elseif ( isset ($_GET['table']) && ($_GET['table'] == "izdelie"))
{
	require_once ("../system/hello.php");
	require_once( "../interface/main_adm.php" );
	
	echo " 
	<b> <basefont size=4>&nbsp; Добавление пунктов ТП изделия: </b></basefont><br><br>
	 <form action=add.php method=post>
	      <table width=60%>
	        <tr>  <td width=10%></td>
		      <td width=25%> Введите номер изделия:</td>
		      <td><input name=izd_idd type=text></td>
	        </tr>
	        <tr>   <td></td>
		      <td> Выберите добавляемую операцию:</td>
		      <td><select name=osopidd>";
	 $sql = "SELECT op_name FROM operation";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
     $dbrow = array();
	 while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
	 {
	 	echo "     <option>".$dbrow['OP_NAME'];
	 }
	 echo "    </select> </td>
		    </tr>
          </table>
		  "; 
																							///////////тут		  
	echo "<hr><b> <basefont size=4>&nbsp; Добавление изделия </b></basefont><br><br>
	      <b> <basefont size=2>&nbsp; Все поля обязательны для заполнения </b></basefont><br><br>
	      <table width=60%>
	        <tr>  <td width=10%></td>
		      <td width=25%>Номер изделия:</td>
		      <td><input name=izdno type=text></td>
	        </tr>
	        <tr>   <td></td>
		      <td> ТП:</td>
		      <td><input name=izdpartno type=text value='<a href=tpp1.php> Техпроцесс №4 </a>'</td>
		    </tr>
	        <tr>   <td></td>
		      <td>Примечание:</td>
		      <td><input name=izdnote type=text></td>
		    </tr>
		    <tr> <td ></td>
		      <td></td>
		      <td><input type=submit value=Добавить></td>
		    </tr>
          </table> </form>";
	OCICommit($c);
	OCILogoff($c);
}
// скритп добавления изделия
elseif ( !empty ($_POST['izdno']) &&  !empty($_POST['izdpartno']) && !empty($_POST['izdnote']))  
{
	$sql = "INSERT INTO izdelie (izd_no, izd_partno, izd_note)
			 VALUES ('". $_POST['izdno']."',
			         '". $_POST['izdpartno']."',
			         '". $_POST['izdnote']."')";																			//govno
	$sql5 = "INSERT INTO tpp (tpp_name, tpp_izd_id)
			 VALUES ('". $_POST['osopidd']."',
			         '". $_POST['izd_idd']."')";
	
	$c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
	 $stmt5 = OCIParse($c, $sql5);
	 
     OCIExecute($stmt);
	 OCIExecute($stmt5);
															////////
	 OCICommit($c);
	 OCILogoff($c);
     Header( "Location: ../script/add.php?table=izdelie" );   //Header( "Location: ../izd.php" );  
}
else Header( "Location: ../main.php" );

$sql6 = "SELECT * FROM tpp"; /////
$c = OCILogon($dbuser, $dbpass, $sid);
$stmt6 = OCIParse($c, $sql6);//////
 OCIExecute($stmt6);
   $dbrow = array();
        // создание шапки html отчета
	
        echo "<h3 align = center><b> <basefont size=4> Техпроцесс №4 </b></basefont></h3>";
        
		echo "<table width=98% align=center border=1 bordercolor=black cellspacing=1 cellpadding=1>
		         <tr>
		               <td width=10% align=center>Номер</td>
		               <td width=30% align=center>Название</td>";
		echo  "</tr>";
		// вывод данных из ответа Oracle на запрос
        $x=1;      // переменная для задания цвета гcnhjr
        while (OCIFetchInto($stmt6, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
        {
        	if (($x%2)==1)echo "<tr bgcolor=#D2C9AE>";
        	else echo "<tr>";
			echo "	    <td align=center>&nbsp;". $x ."</td>
				        <td>&nbsp;". $dbrow["TPP_NAME"] ."</td>";
		
			$x=$x+1;
  		}
  		echo "</table>";
?>
</body>
</html>