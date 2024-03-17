<html lang="en">
    
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    </head>
    
    <body>
	<?php
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
                    <td><?php echo $data['kd_jenis']; ?></td>
                    <td><?php echo $data['kd_merek']; ?></td>
                    <td><?php echo $data['nm_brg']; ?></td>
                    <td><?php echo $data['stok']; ?></td>
                    <td><?php echo $data['hrg_beli']; ?></td>
                    <td><?php echo $data['hrg_jual']; ?></td>
                    <td><img src='image/<?php echo $data['gmbr']; ?>' width='300' height='150'></td>
                    <td><a href='edit_barang.php?id=<?php echo $data['kd_brg']; ?>'>Edit </a> | <a href='paginator_class.php?id=<?php echo $data['kd_brg']; ?>&aksi=hapus'>Hapus</a></td>
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
									$page = "pag.php";
									echo redirectPage($page);
							 }else{
									echo"<script>alert('Data gagal dihapus !');</script>";
								}
							 
                         								   
					}	  

                     
                  
			    
		   
		   ?>
		   </form>
    </body>
    
    </html>
    