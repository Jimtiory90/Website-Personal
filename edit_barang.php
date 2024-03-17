<?php
session_start();
require '../functions/koneksi.php';
define("Balitbang",1);

echo "<html>
<head><title>Login Administrator</title>
<link rel='stylesheet' type='text/css' href='admin.css'>
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
    <tr><td colspan='2' ><img src='../images/atas_admin.jpg' width='1360' height='220' >
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
	  	echo"</td><td valign='top' width='1260'>";
		//------------------------tengah-------------------
require('../lib/config.php');
//include "../functions/functions_home.php";
//$homepageclass = new homepageclass;
 ?>
    <form action='edit_data_barang.php' METHOD='POST' enctype='multipart/form-data' name='pelayanan'>  
<?php
    $id=$_GET['id'];
	  mysql_connect("localhost", "root", "");
	  mysql_select_db("sjm");
	  $sql=mysql_query("SELECT * from barang WHERE kd_brg='$id'");
	  $r=mysql_fetch_array($sql);
?>
	  <TABLE>
	    <TR>
		  <TD width='250' height='25'>Kode Barang</TD>
		  <TD><?php echo $id;?><input type='hidden' name='kd_brg' VALUE='<?php echo $id;?>'></TD>
		</TR>
	    <TR>
		  <TD width='250' height='25'>Jenis</TD>
		  <TD><input type='text' name='kd_jenis' VALUE='<?php echo $r['kd_jenis'];?>'></TD>
		</TR>
		<TR>
		  <TD width='250' height='25'>Merek</TD>
		  <TD><input type='text' name='kd_merek' value='<?php echo $r['kd_merek'];?>'></TD>
		</TR>
		<TR>
		  <TD width='250' height='25'>Nama Barang</TD>
		  <TD><input type='text' name='nm_brg' value='<?php echo $r['nm_brg'];?>'></TD>
		</TR>
		<TR>
		  <TD width='250' height='25'>Stok</TD>
		  <TD><input type='text' name='stok' value='<?php echo $r['stok'];?>'></TD>
		</TR>
		<TR>
		  <TD width='250' height='25'>Harga Beli</TD>
		  <TD><input type='text' name='hrg_beli' value='<?php echo $r['hrg_beli'];?>'></TD>
		</TR>
		<TR>
		  <TD width='250' height='25'>Harga Jual</TD>
		  <TD><input type='text' name='hrg_jual' value='<?php echo $r['hrg_jual'];?>'></TD>
		</TR>
		<TR>
		  <TD valign='top' width='250' height='25'>Foto</TD>
		  <TD><img src='image/<?php echo $r['gmbr'];?>' width='150' height='150'><BR>
		      <input type='file' name='gambar'></TD>
		</TR>
		<TR>
		  <TD aLIGn='center'>
		   <input type='Submit' VAlue='Update' name='update'> <input type='reset' Value='Batal'>
		  </TD>
		</TR>
		</TABLE>
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