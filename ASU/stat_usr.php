<?php
	$add_path = "../script/add.php?table=proizvodstvo";
 	echo "<table align=center width=98% height=10% border=3 bordercolor=#14789E>
			 <tr>
			  <td width=25% align=center> <a href=../oper.php> �������� </a> </td>
			  <td width=25% align=center> <a href=../kompl.php> ������������� � ��������� </a> </td>
			  <td width=25% align=center> <a href=../osn.php> ������������ � �������� </a> </td>
			  <td width=25% align=center> <a href=../stat.php> ������� � ���������� �������� </a>  <br><br>
			          <a href=" . $add_path . "> �������� </a></td>
			 </tr>
			</table><br>";
?>