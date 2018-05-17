<?php
	$add_patht = "../script/add.php?table=personal";
	echo "<table align=center width=98% height=10% border=3 bordercolor=#2D991A>
			 <tr>
			 <td width=14.286% align=center> <a href=../izd.php> Изделия </a> </td>
			 <td width=14.286% align=center> <a href=../oper.php> Операции </a>
			  <td width=14.286% align=center> <a href=../sotr.php> Сотрудники </a> <br><br>
			          <a href= ". $add_patht . " > добавить </a> </td> </td>
			  <td width=14.286% align=center> <a href=../kompl.php> Комплектующие и материалы </a> </td>
			  <td width=14.286% align=center> <a href=../osn.php> Оборудование и оснастка </a> </td>
			 </tr>
			</table><br>";
?>