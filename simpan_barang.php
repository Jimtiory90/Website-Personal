<?php
if(isset($_POST['simpan'])){
//$id=LAST_INSERT_ID();	
mysql_connect("localhost", "root", "");
	  mysql_select_db("sjm");
	  
	    
$tmp_foto=$_FILES['gambar']['tmp_name'];
$foto=$_FILES['gambar']['name'];
 move_uploaded_file($tmp_foto,'image/'.$foto);	
$result = mysql_query("INSERT INTO barang(kd_jenis,kd_merek,nm_brg,stok,hrg_beli,hrg_jual,gmbr) VALUES('" . $_POST["kd_jenis"] . "','" . $_POST["kd_merek"] . "','". $_POST["nm_brg"] ."',". $_POST["stok"] .",". $_POST["hrg_beli"] .",". $_POST["hrg_jual"] .",'" . $foto . "')");
   if($result){
		    echo "<script>alert('Data Barang berhasil disimpan');
			setInterval( () => {
   window.location.href = 'pag.php';
}, 500);
</script>";
		     
		  }else echo "<script>alert('Data Barang gagal disimpan');javascript:history.go(-1)</script>";
}
?>