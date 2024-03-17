<?php
if(isset($_POST['simpan'])){
//$id=LAST_INSERT_ID();	
mysql_connect("localhost", "root", "");
	  mysql_select_db("sjm");
	  
$id=$_POST['id'];	    
$tmp_foto1=$_FILES['gambar1']['tmp_name'];
$gmbr1=$_FILES['gambar1']['name'];
$tmp_foto2=$_FILES['gambar2']['tmp_name'];
$gmbr2=$_FILES['gambar2']['name'];
$tmp_foto3=$_FILES['gambar3']['tmp_name'];
$gmbr3=$_FILES['gambar3']['name'];
if( ($gmbr1!="") && ($gmbr2!="") && ($gmbr3!="") ){
move_uploaded_file($tmp_foto1,'image/'.$gmbr1);	
move_uploaded_file($tmp_foto2,'image/'.$gmbr2);	
move_uploaded_file($tmp_foto3,'image/'.$gmbr3);	
}
$result = mysql_query("INSERT INTO detail_barang(id,jenis,merek,gmbr1,gmbr2,gmbr3) VALUES($id,'" . $_POST["kd_jenis"] . "','". $_POST["kd_merek"] ."','" . $gmbr1 . "','" . $gmbr2 . "','" . $gmbr3 . "')");
   if($result){
		    echo "<script>alert('Data Detail Barang berhasil disimpan');
			setInterval( () => {
   window.location.href = 'pag.php';
}, 500);
</script>";
		     
		  }else echo "<script>alert('Data Detail Barang gagal disimpan');javascript:history.go(-1)</script>";
}

?>