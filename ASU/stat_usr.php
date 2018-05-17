<?php
	$add_path = "../script/add.php?table=proizvodstvo";
 	echo "<table align=center width=98% height=10% border=3 bordercolor=#14789E>
			 <tr>
			  <td width=25% align=center> <a href=../oper.php> Операции </a> </td>
			  <td width=25% align=center> <a href=../kompl.php> Комплектующие и материалы </a> </td>
			  <td width=25% align=center> <a href=../osn.php> Оборудование и оснастка </a> </td>
			  <td width=25% align=center> <a href=../stat.php> Отметки о выполнении операций </a>  <br><br>
			          <a href=" . $add_path . "> добавить </a></td>
			 </tr>
			</table><br>";
?>