<?php

try
{
	//Open database connection
	$con = mysql_connect("localhost","root","");
	mysql_select_db("sjm", $con);

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get record count
		$result = mysql_query("SELECT COUNT(*) AS RecordCount FROM barang;");
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];

		//Get records from database
		$result = mysql_query("SELECT * FROM barang ORDER BY nm_brg LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
		//Add all records to an array
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}
        //$angka=$_GET["jtSorting"];
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
		//echo  $recordCount;
		//echo "aaaa";
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
		 $gambar = $_FILES["userfile"]["name"];
		//Insert record into database
		$result = mysql_query("INSERT INTO barang(kd_jenis,kd_merek,nm_brg,stok,hrg_beli,hrg_jual,gmbr) VALUES('" . $_POST["kd_jenis"] . "','" . $_POST["kd_merek"] . "','". $_POST["nm_brg"] ."',". $_POST["stok"] .",". $_POST["hrg_beli"] .",". $_POST["hrg_jual"] .",'" . $gambar . "')");
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM barang where kd_brg=LAST_INSERT_ID();");
		$row = mysql_fetch_array($result);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$result = mysql_query("UPDATE barang SET nm_brg = '" . $_POST["nm_brg"] . "', kd_jenis = '" . $_POST["kd_jenis"] . "', kd_merek='" . $_POST["kd_merek"] . "',hrg_beli=" . $_POST["hrg_beli"] . ",hrg_jual=" . $_POST["hrg_jual"] . " WHERE kd_brg = " . $_POST["kd_brg"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM barang WHERE kd_brg = " . $_POST["kd_brg"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	//Close database connection
	mysql_close($con);

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>