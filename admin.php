<?php
session_start();
require '../functions/koneksi.php';
define("Balitbang",1);

echo "<html>
<head><title>Login Administrator</title>
<link rel='stylesheet' type='text/css' href='admin.css'>
</head>
<body topmargin='0' leftmargin='0'>";
?>
<script type="text/javascript">
/* <![CDATA[ */
SetCookie('didgettingstarted',1);

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
      <td width='100' valign='top' bgcolor='#D5D9E4'>";
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
	  	echo"</td><td valign='top' width='750'>";
		//------------------------tengah-------------------
require('../lib/config.php');
//include "../functions/functions_home.php";
//$homepageclass = new homepageclass;
 echo "<h3>Selamat Datang di Halaman Admin, silahkan cek menu di sebelah kiri</h3>";
		
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