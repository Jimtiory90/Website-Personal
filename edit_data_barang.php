<?php
  $id=$_POST['kd_brg']; 
     $tmp_foto=$_FILES['gambar']['tmp_name'];
	 $foto=$_FILES['gambar']['name'];
     mysql_connect("localhost", "root", "");
	  mysql_select_db("sjm");
	 
if($foto!=""){  
 	  move_uploaded_file($tmp_foto,'image/'.$foto);
      $result = mysql_query("UPDATE barang SET nm_brg = '" . $_POST["nm_brg"] . "', kd_jenis = '" . $_POST["kd_jenis"] . "',gmbr = '" . $foto . "', kd_merek='" . $_POST["kd_merek"] . "',hrg_beli=" . $_POST["hrg_beli"] . ",hrg_jual=" . $_POST["hrg_jual"] . " WHERE kd_brg = " . $id . ";");
}else {
	  $result = mysql_query("UPDATE barang SET nm_brg = '" . $_POST["nm_brg"] . "', kd_jenis = '" . $_POST["kd_jenis"] . "', kd_merek='" . $_POST["kd_merek"] . "',hrg_beli=" . $_POST["hrg_beli"] . ",hrg_jual=" . $_POST["hrg_jual"] . " WHERE kd_brg = " . $id . ";");
}
if($result){
		    echo "<script>alert('Data Barang dengan ID $id berhasil diupdate');
			setInterval( () => {
   window.location.href = 'pag.php';
}, 1000);
</script>";
		     
		  }else echo "<script>alert('Data pelayan dengan ID $id gagal diupdate');javascript:history.go(-1)</script>";
		  
?>