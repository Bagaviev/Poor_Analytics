<?php
	$del_path = "../script/delete.php?table=proizvodstvo";
	echo "<table align=center width=98% height=7% border=3 bordercolor=#2D991A>
			 <tr>
			  <td width=14.286% align=center> <a href=../sotr.php> ���������� </a> </td>
			  <td width=14.286% align=center> <a href=../oper.php> �������� </a> </td>
			  <td width=14.286% align=center> <a href=../kompl.php> ������������� � ��������� </a> </td>
			  <td width=14.286% align=center> <a href=../osn.php> ������������ � �������� </a> </td>
			  <td width=14.286% align=center> <a href=../izd.php> ������� </a>
			  <td width=14.286% align=center> <a href=../stat.php> �����c���� </a>
			     <br><br> <a href=" . $del_path . "> �������� ��������� </a></td></td>
			  <td width=14.286% align=center> <a href=../brak.php> ���� </a> </td>
			 </tr>
			</table><br>";
?>