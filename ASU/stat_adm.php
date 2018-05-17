<?php
	$del_path = "../script/delete.php?table=proizvodstvo";
	echo "<table align=center width=98% height=7% border=3 bordercolor=#2D991A>
			 <tr>
			  <td width=14.286% align=center> <a href=../sotr.php> Сотрудники </a> </td>
			  <td width=14.286% align=center> <a href=../oper.php> Операции </a> </td>
			  <td width=14.286% align=center> <a href=../kompl.php> Комплектующие и материалы </a> </td>
			  <td width=14.286% align=center> <a href=../osn.php> Оборудование и оснастка </a> </td>
			  <td width=14.286% align=center> <a href=../izd.php> Изделия </a>
			  <td width=14.286% align=center> <a href=../stat.php> Статиcтика </a>
			     <br><br> <a href=" . $del_path . "> очистить статитику </a></td></td>
			  <td width=14.286% align=center> <a href=../brak.php> Брак </a> </td>
			 </tr>
			</table><br>";
?>