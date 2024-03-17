<?php

$con = mysql_connect("localhost","root","");
	mysql_select_db("sjm", $con);

$result = mysql_query("SELECT COUNT(*) AS RecordCount FROM barang;");
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];
echo $recordCount;

$result = mysql_query("SELECT * FROM barang");
		
		//Add all records to an array
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);

?>