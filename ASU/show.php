<?php
	//�������� �.�. ��4-83
	//������������ ������ ������ ������
	//��������� ���������� 1 ��� 2018
    // ���� ����������� �� ��������� - ������� �� �������� �����������
if ( !isset ( $_SESSION['log'], $_SESSION['passwd'], $_SESSION['type']))
{
    Header( "Location: index.php" );
}
if (!isset( $show_type ))
{	Header ( "Location: main.php" );
}
require_once( "system/password.php" );
// ����� ������ �� ���������
if(( $show_type == "oper" ) OR ( $show_type == "oper_adm" ))
{ 		// ������ � �� �� ����� ��������� �� ��������� 		$sql = "SELECT op_id, op_name, op_note
 			    FROM operation ORDER BY op_id";
 		$c = OCILogon($dbuser, $dbpass, $sid);
        $stmt = OCIParse($c, $sql);
        OCIExecute($stmt);
        $dbrow = array();
        // �������� ����� html ������
	
        echo "<b> <basefont size=4>&nbsp; �������� �� ��������� </b></basefont><br><br>";
        
		echo "<table width=98% align=center border=1 bordercolor=black cellspacing=1 cellpadding=1>
		         <tr>
		               <td width=10% align=center>�����</td>
		               <td width=40% align=center>��������</td>
		               <td align=center>��������</td>";
		// ���� ������ ������ �������������, ������� �������������� ����� ��� ������ ������
		if( $show_type == "oper_adm" )
		{
			echo "     <td width=10%></td>";
		}
		echo"   </tr>";
		// ����� ������ �� ������ Oracle �� ������
        $x=1;      // ���������� ��� ������� ����� �cnhjr
        while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
        {        	if (($x%2)==1)echo "<tr bgcolor=#D2C9AE>";
        	else echo "<tr>";
			echo "	    <td align=center>&nbsp;". $x ."</td>
						<td>&nbsp;". $dbrow["OP_NAME"] ."</td>
				        <td>&nbsp;". $dbrow["OP_NOTE"] ."</td>";
			if( $show_type == "oper_adm" )
			{
				echo "  <td><a href=../script/update.php?op_id=" . $dbrow["OP_ID"] . "&table=operation>������</a> |
				            <a href=../script/delete.php?op_id=" . $dbrow["OP_ID"] . "&table=operation>�������</a> </td>";
			}
			echo"	  </tr>";
			$x=$x+1;
  		}
  		echo "</table>";
}
// ����� ������ � �������������
elseif(( $show_type == "kompl" ) OR ( $show_type == "kompl_adm" ))
{ 		// ������ � �� �� ����� ��������� �� �������������� � ����������
 		$sql = "SELECT k.kom_id, k.kom_note, k.kom_kolvo, k.kom_cost, k.kom_name, o.op_name
 			    FROM operation o, komplekt k
 			    WHERE k.kom_op_id = o.op_id
 			    ORDER BY k.kom_id
 			    ";
 		$c = OCILogon($dbuser, $dbpass, $sid);
        $stmt = OCIParse($c, $sql);
        OCIExecute($stmt);
        $dbrow = array();
        // �������� ����� html ������
        echo "<b> <basefont size=4>&nbsp; �������� � ������������� � ���������� </b></basefont><br><br>
              <table width=98% align=center border=1 bordercolor=black cellspacing=1 cellpadding=1>
		         <tr>
		               <td width=20% align=center>��������</td>
		               <td width=7% align=center>����������</td>
		               <td width=20% align=center>��� �����������</td>
		               <td align=center>��������</td>";
		// ���� ������ ������ �������������, ������� �������������� ����� ��� ������ ������
		if( $show_type == "kompl_adm" )
		{
			echo "     <td width=10%></td>";
		}
		echo"    </tr>";
		// ����� ������ �� ������ Oracle �� ������
        $x=1;      // ���������� ��� ������� ����� �cnhjr
        while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
        {
        	if (($x%2)==1)echo "<tr bgcolor=#D2C9AE>";
        	else echo "<tr>";
			echo "	    <td>&nbsp;". $dbrow["KOM_NAME"] ."</td>
						<td align=center>&nbsp;". $dbrow["KOM_KOLVO"] ." <br> " . $dbrow["KOM_COST"] . "</td>
				        <td>&nbsp;". $dbrow["OP_NAME"] ."</td>
				        <td>&nbsp;". $dbrow["KOM_NOTE"] ."</td>";
			if( $show_type == "kompl_adm" )
			{
				echo "  <td><a href=../script/update.php?kom_id=" . $dbrow["KOM_ID"] . "&table=komplekt>������</a> |
				            <a href=../script/delete.php?kom_id=" . $dbrow["KOM_ID"] . "&table=komplekt>�������</a> </td>";
			}
			echo"	  </tr>";
			$x=$x+1;
  		}
  		echo "</table>";}
// ����� ������ � ��������
elseif(( $show_type == "osn" )OR ( $show_type == "osn_adm" ))
{
 		// ������ � �� �� ����� ��������� �� �������������� � ����������
 		$sql = "SELECT os.os_id, os.os_note, os.os_name, o.op_name
 			    FROM operation o, osnastka os
 			    WHERE os.os_op_id = o.op_id
 			    ORDER BY os.os_id
 			    ";
 		$c = OCILogon($dbuser, $dbpass, $sid);
        $stmt = OCIParse($c, $sql);
        OCIExecute($stmt);
        $dbrow = array();
        // �������� ����� html ������
        echo "<b> <basefont size=4>&nbsp; �������� �� �������� � ������������ </b></basefont><br><br>
              <table width=98% align=center border=1 bordercolor=black cellspacing=1 cellpadding=1>
		         <tr>
		               <td width=20% align=center>��������</td>
		               <td width=20% align=center>��� �����������</td>
		               <td align=center>����������</td>";
		// ���� ������ ������ �������������, ������� �������������� ����� ��� ������ ������
		if( $show_type == "osn_adm" )
		{
			echo "     <td width=10%></td>";
		}
		echo"    </tr>";
		// ����� ������ �� ������ Oracle �� ������
        $x=1;      // ���������� ��� ������� ����� �cnhjr
        while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
        {
        	if (($x%2)==1)echo "<tr bgcolor=#D2C9AE>";
        	else echo "<tr>";
			echo "	    <td>&nbsp;". $dbrow["OS_NAME"] ."</td>
				        <td>&nbsp;". $dbrow["OP_NAME"] ."</td>
				        <td>&nbsp;". $dbrow["OS_NOTE"] ."</td>";
			if( $show_type == "osn_adm" )
			{
				$a="op_id=" . $dbrow["OS_ID"];  // ����������, ������������ ������ ��� ��������������
				echo "  <td><a href=../script/update.php?os_id=" . $dbrow["OS_ID"] . "&table=osnastka>������</a> |
				            <a href=../script/delete.php?os_id=" . $dbrow["OS_ID"] . "&table=osnastka>�������</a> </td>";
			}
			echo"	  </tr>";
			$x=$x+1;
  		}
  		echo "</table>";
}
// ����� ������ � �����������
elseif( $show_type == "sotr" )
{
 		// ������ � �� �� ����� ��������� �� �������������� � ����������
 		$sql = "SELECT * FROM personal ORDER BY per_id";
 		$c = OCILogon($dbuser, $dbpass, $sid);
        $stmt = OCIParse($c, $sql);
        OCIExecute($stmt);
        $dbrow = array();
        // �������� ����� html ������
        echo "<b> <basefont size=4>&nbsp; �������� � ����������� </b></basefont><br><br>
              <table width=98% align=center border=1 bordercolor=black cellspacing=1 cellpadding=1>
		         <tr>
		               <td width=15% align=center>���</td>
		               <td width=15% align=center>�������</td>
		               <td width=10% align=center>�������</td>
		               <td width=10% align=center>�������������</td>
		               <td width=10% align=center>����</td>
		               <td width=10% align=center>������� �������</td>
		               <td width=10% align=center>�����</td>
		               <td width=10% align=center>������</td>
					   <td width=10%></td>
                 </tr>";
		// ����� ������ �� ������ Oracle �� ������
        $x=1;      // ���������� ��� ������� ����� �cnhjr
        while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
        {
        	if (($x%2)==1)echo "<tr bgcolor=#D2C9AE>";
        	else echo "<tr>";
			echo "	    <td>&nbsp;". $dbrow["PER_NAME"] ."</td>
				        <td>&nbsp;". $dbrow["PER_SURNAME"] ."</td>
				        <td>&nbsp;". $dbrow["PER_TEL"] ."</td>
				        <td>&nbsp;". $dbrow["PER_SPEC"] ."</td>
				        <td>&nbsp;". $dbrow["PER_STAZH"] ."</td>
				        <td>&nbsp;". $dbrow["PER_TYPE"] ."</td>
				        <td>&nbsp;". $dbrow["PER_LOG"] ."</td>
				        <td>&nbsp;". $dbrow["PER_PASS"] ."</td>
				        <td><a href=../script/update.php?per_id=" . $dbrow["PER_ID"] . "&table=personal>������</a> |
				            <a href=../script/delete.php?per_id=" . $dbrow["PER_ID"] . "&table=personal>�������</a> </td>";

			echo"	  </tr>";
			$x=$x+1;
  		}
  		echo "</table>";
}
// ����� ������ ���������� ��� �������������� � ��������
elseif(( $show_type == "stat" )OR ( $show_type == "stat_adm" ))
{	$c = OCILogon($dbuser, $dbpass, $sid);	// ���� ����� �������, ��������� ��� id
	if ( $show_type == "stat" )
	{
		$sql1 = "SELECT per_id FROM personal
				 WHERE per_log = '" . $_SESSION['log'] . "' AND per_pass = '" . $_SESSION['passwd'] . "'";
		$stmt1 = OCIParse($c, $sql1);
	    OCIExecute($stmt1);
	    $dbrow1 = array();
		while (OCIFetchInto($stmt1, $dbrow1, OCI_ASSOC+OCI_RETURN_NULLS))  $id = $dbrow1['PER_ID'];	 	$sql2 = "SELECT * FROM proizvodstvo
	 			 WHERE pr_per_id = '" . $id ."'
	 			 ORDER BY pr_id";
	 	$sql6="SELECT fk(".$id.")FROM dual";
  		$stmt6 = OCIParse($c, $sql6);
        OCIExecute($stmt6);
        $dbrow6 = array();
	    while (OCIFetchInto($stmt6, $dbrow6, OCI_ASSOC+OCI_RETURN_NULLS))
	        {
	        	echo "<b><basefont size=4>&nbsp; ���� ��������� ".$dbrow6['FK('.$id.')']." ��������: </b></basefont><br><br>";
	        }    }
    // ���� ����� �������������
    elseif ( $show_type == "stat_adm" )
    {    	echo "<b><basefont size=4>&nbsp; ��������, ����������� ��������: </b></basefont><br>"; 		$sql2 = "SELECT * FROM proizvodstvo
		         ORDER BY pr_per_id";
	}
	$stmt2 = OCIParse($c, $sql2);
    OCIExecute($stmt2);
    $dbrow2 = array();
        // �������� ����� html ������
    echo " <table width=98% align=center border=1 bordercolor=black cellspacing=1 cellpadding=1>
            <tr>";
        // ���� ������ ������ �������������, ������� �������������� ����� ��� ����� ��������
             if( $show_type == "stat_adm" ) echo "<td width=10% align=center>�������</td>";
       echo "<td width=15% align=center>��������</td>
             <td width=5% align=center>����� �������</td>
             <td width=10% align=center>����</td>
             <td width=15% align=center>����</td>
             <td width=15% align=center>������� �����</td>";
        // ���� ������ ������ �������, ������� �������������� ����� ��� ������ ������
			 if( $show_type == "stat" ) echo "<td width=10%> </td>";
       echo "</tr>";
       // ����� ����������
        $x=1;      // ���������� ��� ������� ����� ����� ���� ����� �������
     // ���������� ��� ������� ����� ����� ���� ����� �������
        while (OCIFetchInto($stmt2, $dbrow2, OCI_ASSOC+OCI_RETURN_NULLS))
        {        	if ( $show_type == "stat_adm")
        	{        		if ($dbrow2['PR_PER_ID']%2==0)echo "<tr bgcolor=#D2C9AE>";
        		else echo "<tr>";
        	}
        	if ( $show_type == "stat")
        	{
        		if (($x%2)==1)echo "<tr bgcolor=#D2C9AE>";
        		else echo "<tr>";
        	}
        	if( $show_type == "stat_adm" )
        	{        		 	 $sql3 = "SELECT DISTINCT per_name, per_surname FROM personal
        		 	          WHERE per_id = " . $dbrow2['PR_PER_ID'] . "";
                     $stmt3 = OCIParse($c, $sql3);
                     OCIExecute($stmt3);
                     $dbrow3 = array();
	                 while (OCIFetchInto($stmt3, $dbrow3, OCI_ASSOC+OCI_RETURN_NULLS))
	                 {
	                     echo "<td align=center> ".$dbrow3['PER_NAME']."&nbsp;&nbsp;".$dbrow3['PER_SURNAME']." </td>";
	                 }
        	}
            $sql4 = "SELECT DISTINCT op_name FROM operation WHERE op_id = ".$dbrow2['PR_OP_ID']."";
            $stmt4 = OCIParse($c, $sql4);
            OCIExecute($stmt4);
            $dbrow4 = array();
	        while (OCIFetchInto($stmt4, $dbrow4, OCI_ASSOC+OCI_RETURN_NULLS))
	        {
	              echo "<td align=center> ".$dbrow4['OP_NAME']." </td>";
	        }
	        $sql5 = "SELECT DISTINCT izd_no FROM izdelie WHERE izd_id = ".$dbrow2['PR_IZD_ID']."";
            $stmt5 = OCIParse($c, $sql5);
            OCIExecute($stmt5);
            $dbrow4 = array();
	        while (OCIFetchInto($stmt5, $dbrow5, OCI_ASSOC+OCI_RETURN_NULLS))
	        {
	              echo "<td align=center> ".$dbrow5['IZD_NO']." </td>";
	        }
	        echo "<td align=center> " . $dbrow2['PR_DATE'] . " </td>
	              <td>".$dbrow2['PR_BRNAME'] ." </td>
	              <td>".$dbrow2['PR_BRREASON']." </td>";
        	if( $show_type == "stat")
        	{
				echo "<td align=center><a href=../script/update.php?pr_id=" . $dbrow2["PR_ID"] . "&table=proizvodstvo>������</a></td>";
        	}
        	echo "</tr>";
			$x=$x+1;
  		}
  		echo "</t</table>";
}
// ����� ������ � ��������
elseif( $show_type == "izd" )
{
 		// ������ � �� �� ����� ��������� �� �������������� � ����������
 		$sql = "SELECT * FROM izdelie ORDER BY izd_id";
 		$c = OCILogon($dbuser, $dbpass, $sid);
        $stmt = OCIParse($c, $sql);
        OCIExecute($stmt);
        $dbrow = array();
        // �������� ����� html ������
        echo "<b> <basefont size=4>&nbsp; �������� �� �������� </b></basefont><br><br>
              <table width=98% align=center border=1 bordercolor=black cellspacing=1 cellpadding=1>
		         <tr>
		               <td width=25% align=center>�����</td>
		               <td width=25% align=center>�� </td>
		               <td width=25% align=center>����������</td>
					   <td width=25%></td>
                 </tr>";
		// ����� ������ �� ������ Oracle �� ������
        $x=1;      // ���������� ��� ������� ����� �cnhjr
        while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
        {
        	if (($x%2)==1)echo "<tr bgcolor=#D2C9AE>";
        	else echo "<tr>";
			echo "	    <td align=center>". $dbrow["IZD_NO"] ."</td>
				        <td align=center>". $dbrow["IZD_PARTNO"] ."</td>
				        <td align=center>". $dbrow["IZD_NOTE"] ."</td>
				        <td align=center><a href=../script/update.php?izd_id=" . $dbrow["IZD_ID"] . "&table=izdelie>������</a> |
				            <a href=../script/delete.php?izd_id=" . $dbrow["IZD_ID"] . "&table=izdelie>�������</a> </td>";

			echo"	  </tr>";
			$x=$x+1;
  		}
  		echo "</table>";
}
// ����� ������ � �����
elseif( $show_type == "brak" )
{
 		// ������ � �� �� ����� ��������� �� �������������� � ����������
 		$sql = "SELECT * FROM proizvodstvo
 		        WHERE pr_brname <> ' ' AND pr_brreason <> ' '
 		        ORDER BY pr_id";
 		$c = OCILogon($dbuser, $dbpass, $sid);
        $stmt = OCIParse($c, $sql);
        OCIExecute($stmt);
        $dbrow = array();
        // �������� ����� html ������
        echo "<b> <basefont size=4>&nbsp; �������� � ����� </b></basefont><br><br>
              <table width=98% align=center border=1 bordercolor=black cellspacing=1 cellpadding=1>
		         <tr>
		               <td width=50% align=center>����</td>
		               <td width=50% align=center>������� �����</td>
                 </tr>";
		// ����� ������ �� ������ Oracle �� ������
        $x=1;      // ���������� ��� ������� ����� �cnhjr
        while (OCIFetchInto($stmt, $dbrow, OCI_ASSOC+OCI_RETURN_NULLS))
        {
        	if (($x%2)==1)echo "<tr bgcolor=#D2C9AE>";
        	else echo "<tr>";
			     echo " <td align=center>". $dbrow["PR_BRNAME"] ."</td>
				        <td align=center>". $dbrow["PR_BRREASON"] ."</td>
				       </tr> ";
			$x=$x+1;
  		}
  		echo "</table>";
}
OCICommit($c);
	OCILogoff($c);
?>
<br>

		
		
	

