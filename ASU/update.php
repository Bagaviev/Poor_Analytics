<html>

<head>
  <title></title>
</head>

<body style = "background-color:#B2DFEE">
<?php
	//Багавиев Б.И. ИУ4-83
	//Скрипт обновления данных данных
	//Последнее обновление 1 Мая 2018
    // если авторизация не выполнена - возврат на страницу авторизации
session_name("sess");
session_start();
if ( !isset ( $_SESSION['log'], $_SESSION['passwd'], $_SESSION['type']))
{
    Header( "Location: index.php" );
}
require_once( "../system/password.php" );
// форма редактирования данных сотрудника
if ( isset ($_GET['table']) && ($_GET['table'] == "personal"))
{	 require_once("../system/hello.php");
	 require_once( "../interface/main_adm.php" );
	 $sql = "SELECT * FROM personal WHERE per_id = ".$_GET['per_id']."";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
     $dbrow = array();
     while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
     {
	 echo "<b> <basefont size=4>&nbsp; Редактирование данных сотрудника </b></basefont><br><br>
	      <b> <basefont size=2>&nbsp; Все поля обязательны для заполнения </b></basefont><br><br>
	      <form action=update.php method=post>
	      <table width=60%>
	        <tr>  <td width=10%></td>
		      <td width=25%>Имя:</td>
		      <td><input name=pername type=text value='".$dbrow['PER_NAME']."'></td>
	        </tr>
	        <tr>   <td></td>
		      <td>Фамилия:</td>
		      <td><input name=persurname type=text value='".$dbrow['PER_SURNAME']."'></td>
		    </tr>
	        <tr>   <td></td>
		      <td>Телефон:</td>
		      <td><input name=pertel type=text value=".$dbrow['PER_TEL']."></td>
		    </tr>
	        <tr>   <td></td>
		      <td>Специальность:</td>
		      <td><input name=perspec type=text value='".$dbrow['PER_SPEC']."'></td>
		    </tr>
	        <tr>  <td></td>
		      <td>Стаж:</td>
		      <td><input name=perst type=text value=".$dbrow['PER_STAZH']."></td>
		    </tr>
	        <tr>  <td></td>
		      <td>Уровень доступа:</td>
		      <td><select name=pertype>
		          <option>adm
		          <option>usr
                  </select> </td>
	        </tr>
	        <tr>  <td></td>
		      <td>Логин:</td>
		      <td><input name=perlog type=text value=".$dbrow['PER_LOG']."></td>
		    </tr>
	        <tr>  <td></td>
		      <td>Пароль:</td>
		      <td><input name=perpass type=text value=".$dbrow['PER_PASS']."></td>
		    </tr>
	        <tr> <td></td>
		      <td></td>
		      <td><input type=submit value=Обновить></td>
		    </tr>
          </table>
          <input type=hidden name=perid value=".$dbrow['PER_ID']."></form>";
     }
}
// скритп обновления данных сотрудника
if ( !empty ($_POST['pername']) &&  !empty($_POST['persurname']) && !empty($_POST['pertel']) && !empty($_POST['perspec'])
	 && !empty($_POST['perst']) &&  !empty($_POST['pertype']) &&  !empty($_POST['perlog']) &&  !empty($_POST['perpass']))
{
	$sql = "UPDATE personal SET
	                 per_name = '". $_POST['pername']."',
			         per_surname = '". $_POST['persurname']."',
			         per_stazh = to_number ('". $_POST['perst']."'),
			         per_tel = to_number ('". $_POST['pertel']."'),
			         per_spec = '". $_POST['perspec']."',
			         per_type = '". $_POST['pertype']."',
			         per_log = '". $_POST['perlog']."',
			         per_pass = '". $_POST['perpass']."'
			 WHERE per_id = '" . $_POST['perid']."'";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
     Header( "Location: ../sotr.php" );
}
// форма обновления данных об операции
elseif ( isset ($_GET['table']) && ($_GET['table'] == "operation"))
{	 require_once("../system/hello.php");
	 require_once( "../interface/main_adm.php" );
	 $sql = "SELECT * FROM operation WHERE op_id = ".$_GET['op_id']."";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
     $dbrow = array();
     while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
     {
	    echo "<b> <basefont size=4>&nbsp; Добавление операции </b></basefont><br><br>
	      <b> <basefont size=2>&nbsp; Все поля обязательны для заполнения </b></basefont><br><br>
	      <form action=update.php method=post>
	      <table width=60%>
	        <tr>  <td width=10%></td>
		      <td width=25%>Название:</td>
		      <td><input size=50 name=opname type=text value='".$dbrow['OP_NAME']."'></td>
	        </tr>
	        <tr>   <td></td>
		      <td>Описание:</td>
		      <td><input size=100 name=opnote type=text value='".$dbrow['OP_NOTE']."'></td>
		    </tr>
	        <tr> <td></td>
		      <td></td>
		      <td><input type=submit value=Добавить></td>
		    </tr>
          </table>
          <input type=hidden name=opid value=".$dbrow['OP_ID']."></form>";
     }
}
// скрипт обновления данных об операции
elseif( !empty ($_POST['opname']) &&  !empty($_POST['opnote']))
{
	$sql = "UPDATE operation
			SET op_name = '". $_POST['opname']."',
			    op_note = '". $_POST['opnote']."'
			WHERE op_id = '". $_POST['opid']."'";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
     Header( "Location: ../oper.php" );
}
// форма обновления данных о комплектующих и материалах
elseif ( isset ($_GET['table']) && ($_GET['table'] == "komplekt"))
{	 require_once("../system/hello.php");
	 require_once( "../interface/main_adm.php" );
	 $sql = "SELECT * FROM komplekt WHERE kom_id = ".$_GET['kom_id']."";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
     $dbrow = array();
     while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
     {
	 echo "<b> <basefont size=4>&nbsp; Редактирование комплектующих и материалов </b></basefont><br><br>
	      <b> <basefont size=2>&nbsp; Все поля обязательны для заполнения </b></basefont><br><br>
	      <form action=update.php method=post>
	      <table border=0 width=60%>
	        <tr>  <td width=10%></td>
		      <td width=25%>Название:</td>
		      <td><input name=komname type=text value='".$dbrow['KOM_NAME']."'></td>
	        </tr>
	        <tr>   <td ></td>
		      <td>Количество</td>
		      <td><input name=komkolvo type=text value=".$dbrow['KOM_KOLVO']."></td>
		    </tr>
	        <tr>   <td></td>
		      <td>Цена за штуку</td>
		      <td><input name=komcost type=text value=".$dbrow['KOM_COST']."></td>
		    </tr>
	        <tr>  <td></td>
		      <td>Где применяется</td>
		      <td><select name=komopid>";
	 $sql1 = "SELECT op_name FROM operation";
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
		      <td><input size=50 name=komnote type=text value='".$dbrow['KOM_NOTE']."'></td>
		    </tr>
	        <tr> <td></td>
		      <td></td>
		      <td><input type=submit value=Обновить></td>
		    </tr>
          </table><input type=hidden name=komid value=".$dbrow['KOM_ID']."> </form>";
    }
}
// скрипт обновления данных о материалах и комплектующих
elseif( !empty ($_POST['komname']) && !empty($_POST['komkolvo']) && !empty($_POST['komcost']) && !empty($_POST['komopid']))
{
	$c = OCILogon($dbuser, $dbpass, $sid);
	$sql1 = "SELECT op_id FROM operation WHERE op_name='".$_POST['komopid']."'";
	$stmt1 = OCIParse($c, $sql1);
	OCIExecute($stmt1);
	$dbrow = array();
	while (OCIFetchInto($stmt1, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
	{
		$sql2 = "UPDATE komplekt
			     SET kom_name = '". $_POST['komname']."',
		             kom_cost = to_number('". $_POST['komcost']."'),
		             kom_kolvo = to_number('". $_POST['komkolvo']."'),
			         kom_note = '". $_POST['komnote']."',
                     kom_op_id = '".$dbrow['OP_ID']."'
                WHERE kom_id = '".$_POST['komid']."'";
    }
     $stmt2 = OCIParse($c, $sql2);
     OCIExecute($stmt2);
     Header( "Location: ../kompl.php" );
}
// форма обновления оснастки и оборудования
elseif ( isset ($_GET['table']) && ($_GET['table'] == "osnastka"))
{
	require_once("../system/hello.php");
	require_once("../interface/main_adm.php" );
	$sql = "SELECT * FROM osnastka WHERE os_id = ".$_GET['os_id']."";
	$c = OCILogon($dbuser, $dbpass, $sid);
    $stmt = OCIParse($c, $sql);
    OCIExecute($stmt);
    $dbrow = array();
    while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
    {
	echo "<b> <basefont size=4>&nbsp; Добавление оснастки и оборудования </b></basefont><br><br>
	      <b> <basefont size=2>&nbsp; Все поля обязательны для заполнения </b></basefont><br><br>
	      <form action=update.php method=post>
	      <table border=0 width=60%>
	        <tr>  <td width=10%></td>
		      <td width=25%>Название:</td>
		      <td><input name=osname type=text value='".$dbrow['OS_NAME']."'></td>
	        </tr>
	        <tr>  <td></td>
		      <td>Где применяется</td>
		      <td><select name=osopid>";
	 $sql1 = "SELECT op_name FROM operation";
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
		      <td><input size=80 name=osnote type=text value='".$dbrow['OS_NOTE']."'></td>
		    </tr>
	        <tr> <td></td>
		      <td></td>
		      <td><input type=submit value=Обновить></td>
		    </tr>
          </table><input type=hidden name=osid value=".$dbrow['OS_ID'].">  </form>";
    }
}
// скрипт обновления оснастки и оборудования
elseif( !empty ($_POST['osname']) && !empty($_POST['osopid']) && !empty($_POST['osnote']) )
{
	$c = OCILogon($dbuser, $dbpass, $sid);
	$sql1 = "SELECT op_id FROM operation WHERE op_name='".$_POST['osopid']."'";
	$stmt1 = OCIParse($c, $sql1);
	OCIExecute($stmt1);
	$dbrow = array();
	while (OCIFetchInto($stmt1, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
	{
		$sql2 = "UPDATE osnastka
			     SET os_name = '". $_POST['osname']."',
			         os_note = '". $_POST['osnote']."',
			         os_op_id = '". $dbrow['OP_ID']."'
			     WHERE os_id = '".$_POST['osid']."'";
    }
     $stmt2 = OCIParse($c, $sql2);
     OCIExecute($stmt2);
     Header( "Location: ../osn.php" );
}
// форма обновления данных о выполненных операциях
elseif ( isset ($_GET['table']) && ($_GET['table'] == "proizvodstvo"))
{
	require_once("../system/hello.php");
	require_once("../interface/main_usr.php" );
	$sql = "SELECT * FROM proizvodstvo WHERE pr_id = ".$_GET['pr_id']."";
	$c = OCILogon($dbuser, $dbpass, $sid);
    $stmt = OCIParse($c, $sql);
    OCIExecute($stmt);
    $dbrow = array();
    while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
    {
	echo "<b> <basefont size=4>&nbsp; Изменение информации о выполненных операциях </b></basefont><br><br>
	      <b> <basefont size=2>&nbsp; Поля, отмеченные * обязательны для заполнения </b></basefont><br><br>
	      <form action=update.php method=post>
	      <table border=0 width=60%>
	        <tr>  <td width=10%></td>
		      <td width=25%>Операция *</td>
		      <td><select name=propid value=>";
	 $sql1 = "SELECT op_name FROM operation";
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
		      <td >Номер изделия *</td>
		      <td><select name=prizdid>";
	 $sql1 = "SELECT izd_no FROM izdelie";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt1 = OCIParse($c, $sql1);
     OCIExecute($stmt1);
     $dbrow1 = array();
	 while (OCIFetchInto($stmt1, $dbrow1, OCI_ASSOC+OCI_RETURN_NULLS))
	 	{
	 		echo "     <option>".$dbrow1['IZD_NO'];
		 }
	 echo "    </select> </td>
	        </tr>
		    <tr>  <td></td>
		      <td>Обнаруженный или допущенный брак</td>
		      <td><input size=50 name=prbrname type=text  value ='".$dbrow['PR_BRNAME']."'></td>
		    </tr>
		    <tr>  <td></td>
		      <td>Причина брака</td>
		      <td><input size=50 name=prbrreason type=text value ='".$dbrow['PR_BRREASON']."'></td>
		    </tr>
		    <tr>  <td></td>
		      <td></td>
		      <td><input size=10 name=prnote type=hidden value=выполнил></td>
		    </tr>
	        <tr> <td></td>
		      <td></td>
		      <td><input type=submit value=Обновить></td>
		    </tr>
          </table>
          <input size=10 name=prnote type=hidden value=выполнил>
          <input size=10 name=prid type=hidden value='".$dbrow['PR_ID']."'>
          <input size=10 name=prdate type=hidden value='".$dbrow['PR_DATE']."'>
          <input size=10 name=prperid type=hidden value='".$dbrow['PR_PER_ID']."'>
          <input size=10 name=prid type=hidden value='".$dbrow['PR_ID']."'>
          </form>";
          }
	OCICommit($c);
	OCILogoff($c);
}
// скрипт обновления данных об операциях
elseif( !empty ($_POST['propid']) && !empty($_POST['prizdid']))
{	$c = OCILogon($dbuser, $dbpass, $sid);
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

	$sql3 = "UPDATE proizvodstvo
		     SET pr_op_id = '". $propid."',
			     pr_per_id = '". $prperid."',
			     pr_izd_id = '". $prizdid."',
			     pr_note = '". $_POST['prnote']."',
                 pr_date = '". $_POST['prdate']."',
			     pr_brname = '". $prbrname."',
			     pr_brreason = '". $prbrreason."'
			  WHERE pr_id = '".$_POST['prid']."'";
     $stmt3 = OCIParse($c, $sql3);
     OCIExecute($stmt3);
	 OCICommit($c);
	 OCILogoff($c);
     Header( "Location: ../stat.php" );
}
// форма редактирования изделия
elseif ( isset ($_GET['table']) && ($_GET['table'] == "izdelie"))
{	 $sql = "SELECT * FROM izdelie WHERE izd_id = ".$_GET['izd_id']."";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
     $dbrow = array();
     while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
     {
	      require_once ("../system/hello.php");
	      require_once( "../interface/main_adm.php" );
	      echo "<b> <basefont size=4>&nbsp; Добавление изделий </b></basefont><br><br>
	      <b> <basefont size=2>&nbsp; Все поля обязательны для заполнения </b></basefont><br><br>
	      <form action=update.php method=post>
	      <table width=60%>
	        <tr>  <td width=10%></td>
		      <td width=25%>Номер изделия:</td>
		      <td><input name=izdno type=text value='".$dbrow['IZD_NO']."'></td>
	        </tr>
	        <tr>   <td></td>
		      <td> ТП:</td>
		      <td><input name=izdpartno type=text value='".$dbrow['IZD_PARTNO']."'></td>
		    </tr>
	        <tr>   <td></td>
		      <td>Примечание:</td>
		      <td><input name=izdnote type=text value=NS453></td>
		    </tr>
		    <tr> <td ></td>
		      <td></td>
		      <td><input type=submit value=Добавить></td>
		    </tr>
          </table> <input type=hidden name=izdid value=".$dbrow['IZD_ID']."> </form>";
     }
}
elseif ( !empty ($_POST['izdno']) &&  !empty($_POST['izdpartno']) && !empty($_POST['izdnote']))
{
	$sql = "UPDATE izdelie
			SET izd_no = '". $_POST['izdno']."',
			    izd_partno = '". $_POST['izdpartno']."',
			    izd_note = '". $_POST['izdnote']."'
			WHERE izd_id = '". $_POST['izdid']."'";
	 $c = OCILogon($dbuser, $dbpass, $sid);
     $stmt = OCIParse($c, $sql);
     OCIExecute($stmt);
	 OCICommit($c);
	 OCILogoff($c);
     Header( "Location: ../izd.php" );
}
?>
</body>
</html>