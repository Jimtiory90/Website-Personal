<?php
session_start();
require '../functions/koneksi.php';
define("Balitbang",1);

echo "<html>
<head><title>Login Administrator</title>
<link rel='stylesheet' type='text/css' href='admin.css'>
<link rel='stylesheet' type='text/css' href='tmplgmbr.css'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css' rel='stylesheet'
            integrity='sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl' crossorigin='anonymous'>

</head>
<body topmargin='0' leftmargin='0'>";
?>

<script type="text/javascript">
/* <![CDATA[ */
<?php
SetCookie('didgettingstarted',1);
	function redirectPage ($page) {
   $newpage = "<script type='text/javascript'>";
   $newpage .= "window.location.href='$page';";
   $newpage .= "</script>";
   $newpage .= "<noscript>";
   $newpage .= "<meta http-equiv='refresh' content='0;url=$page'/>";
   $newpage .= "</noscript>";
 
   return $newpage;
}
?>
function setDisplayMenu(idName)
{
    if (idName == '') {
        // '' is news, and etc.    
        idName = 'o';
    }

    if ( idName !=null) {
        closeMenuDiv();
        openMenuDiv(idName);
    } else {
        closeMenuDiv();
    }
}

function clickOpenMenu(idName)
{
	closeMenuDiv();
	openMenuDiv(idName);
}

function closeMenuDiv()
{
	var aObjDiv = document.getElementsByTagName("div");
	var numDiv = aObjDiv.length;

	for(i=0; i < numDiv; i++) 
	{
		var idName = aObjDiv[i].getAttribute("id");
		
		if(idName)
		{
			var isMenu = idName.match(/SubCat/i);
					
			if(isMenu !=null) 
			{				
				document.getElementById(idName).style.visibility = "hidden";
				document.getElementById(idName).style.position = "absolute";
			}
		}
	}

}

function openMenuDiv(idName)
{
	document.getElementById('SubCat_'+idName).style.visibility = "visible";
	document.getElementById('SubCat_'+idName).style.position = "static";
}

function clickOpenPage(URL,target)
{
	window.open(URL, target);
}
</script>

<?php

if ( !isset($_SESSION['Admin']) )
{
	echo "Anda harus login dulu.. redirecting\n";
	echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\">\n";
} else {
	if ( isset($_GET['logout']) )
	{
		$username = $_SESSION['Admin']['username'];
		unset($_SESSION['Admin']);
		//session_destroy();
		echo "Terima kasih.. redirecting\n";
		echo "<meta http-equiv=\"refresh\" content=\"1;url=index.php\">\n";
	} else {
		  
		echo"<table width='1360' border='1' align='center' cellpadding='2' cellspacing='1' bordercolor='#3333cc'  >
    <tr><td colspan='2' ><img id='gmbratas' src='../images/atas_admin.jpg'>
        </td>
    </tr>
    <tr>
      <td width='150' valign='top' bgcolor='#D5D9E4'>";
	  //----------------------menu--------------------------
	  	echo '<div id="LeftMenu">
<div class="LeftMenuHead"><a href="admin.php">HOME</a>
</div>
<div class="LeftMenuline"></div>';
        	echo '<div class="LeftMenuHead" style="cursor: pointer;"><a href="logout.php">Logout</a></div>';
		echo '<div class="LeftMenuline"></div>
<div class="LeftMenuHead"><a href="../index.php">Tampilkan Web
</a></div>
<div class="LeftMenuline"></div>
<div class="LeftMenuHead"><a href="pag.php">Lihat Data</a></div>
<div style="visibility: hidden; position: absolute;" id="SubCat_o">

</div>
<div class="LeftMenuHead">';echo "<a href='barang.php'>Data Barang</a></div>";
	  //-----------------akhir menu ------------------------
	  	echo"</td><td valign='top' width='1360'>";
		//------------------------tengah-------------------
require('../lib/config.php');
//include "../functions/functions_home.php";
//$homepageclass = new homepageclass;
 ?>

     <form>
        <div class="container mt-4">
            <table class="table table-striped">
                <tr>
                    <td>No</td>
                    <td>Jenis Barang</td>
                    <td>Merek</td>
                    <td>Nama Barang</td>
                    <td>Stok</td>
                    <td>Harga Beli</td>
                    <td>Harga Jual</td>
                    <td>Gambar</td>
                    <td>Aksi</td>
					
                </tr>
                <?php
    
                    // menyimpan url halaman saat ini dengan fungsi get
                    // misalnya kalian akan melihat ?halaman= 3 pada url di atas, maka 3 akan disimpan ke dalam var halaman
                    $halaman        = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
    
                    // jika nilai halaman lebih besar dari 1 maka halaman awal adalah halaman dikali 10 - 10
                    // jika nilai halaman lebih kecil dari 1 maka halaman awal adalah 0
                    $halaman_awal   = ($halaman > 1) ? ($halaman * 8) - 8 : 0;
    
                    // membuat koneksi ke database
                    $koneksi        = mysqli_connect("localhost", "root", "", "sjm");
    
                    // jika kembali dikurangi 1 dan jika setelahnya ditambah 1
                    $sebelum        = $halaman - 1;
                    $setelah        = $halaman + 1;
    
                    // mengambil data dari tabel pegawai untuk ditotal
                    $datas           = mysqli_query($koneksi, "select * from barang");
    
                    // jumlah data pegawai ditotal
                    $jumlah_data    = mysqli_num_rows($datas);
    
                    // ceil adalah fungsi pembulatan pada php
                    $total_halaman  = ceil($jumlah_data / 8);
    
                    // yang ini mengambil data pengawai untuk ditampilkan dengan fungsi limit
                    // satu halaman akan ditampilkan paling banyak 10 atau limit 10
                    $data_pegawais   = mysqli_query($koneksi, "select * from barang limit $halaman_awal, 8");
    
                    // nomor digunakan untuk penomoran pada kolom no
                    // karena index dimulai dari angka 0 maka perlu ditambah 1
                    $nomor          = $halaman_awal + 1;
    
                    //melakukan looping data
                    while($data = mysqli_fetch_array($data_pegawais)){
                ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td width='120'><?php echo $data['kd_jenis']; ?></td>
                    <td width='120'><?php echo $data['kd_merek']; ?></td>
                    <td width='250'><?php echo $data['nm_brg']; ?></td>
                    <td width='50'><?php echo $data['stok']; ?></td>
                    <td width='100'><?php echo $data['hrg_beli']; ?></td>
                    <td width='100'><?php echo $data['hrg_jual']; ?></td>
                    <td><img id='gmbrsparepart' src='image/<?php echo $data['gmbr']; ?>'></td>
                    <td width='350'><a href='edit_barang.php?id=<?php echo $data['kd_brg']; ?>'>Edit </a> | <a href='paginator_class.php?id=<?php echo $data['kd_brg']; ?>&aksi=hapus'>Hapus</a> | <a href='tambah_detail.php?id=<?php echo $data['kd_brg']; ?>'>Tambah Detail</a></td>
                </tr>
               
                <?php 
                    }
                ?>
				  <a href='tambah_barang.php'><p align='right'>Tambah Data Barang</p></a>
            </table>
            <!-- bagian pagination  -->
            <nav>
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$sebelum'"; } ?>>Previous</a>
                    </li>
                    <?php 
                        for($x = 1; $x <= $total_halaman; $x++){
                    ?> 
                    <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"> <?php echo $x; ?></a></li>
                    <?php
                        }
                    ?> 
                    <li class="page-item">
                        <a  class="page-link" <?php  if($halaman < $total_halaman) { echo "href='?halaman=$setelah'"; } ?>>Next</a>
                    </li>
                </ul>
            </nav>
        </div>
           <?php
		      	  $aksi = $_GET['aksi'];
                     if($aksi=="hapus"){
                          mysql_connect("localhost", "root", "");
						  mysql_select_db("sjm");
						  $id=$_GET['id'];
						   $sql = "DELETE FROM barang WHERE kd_brg = '$id'";
					       mysql_query($sql);
						      if(mysql_errno() == 0)
							  {
									echo"<script>alert('Data berhasil dihapus !');</script>";
									$page = "paginator_class.php";
									echo redirectPage($page);
							 }else{
									echo"<script>alert('Data gagal dihapus !');</script>";
								}
							 
                         								   
					}	  

                     
                  
			    
		   
		   ?>
		   </form>

<?php		
if (isset($_GET['mode'])) $mode=$_GET['mode'];
else $mode=$_POST['mode'];

		
		//----------------------tutup-------------
		echo "</td></tr>
		<tr><td colspan='2' bgcolor='#4c96da' height=50 ><center><font class='adminhead'>Website engine's code is copyright © 2024 <a href='mailto:jimtiorytumangke@gmail.com'  >Momong Besar Kecil dan Meisiana Kwandou</a> versi dicoba<br><br></font></center></td></tr></table>";
	}
}

echo "</body>
</html>";

?>