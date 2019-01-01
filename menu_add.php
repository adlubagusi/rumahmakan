<?php
include_once "library/inc.seslogin.php";

if($_GET) {
	if(isset($_POST['btnSave'])){
		# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
		$pesanError = array();
		if (trim($_POST['txtMenu'])=="") {
			$pesanError[] = "Data <b>Nama Menu</b> tidak boleh kosong !";		
		}
		if (trim($_POST['txtHarga'])==""  OR ! is_numeric(trim($_POST['txtHarga']))) {
			$pesanError[] = "Data <b>Harga Menu</b> harus diisi angka !";
		}
		if (trim($_POST['cmbKategori'])=="BLANK") {
			$pesanError[] = "Data <b>Kategori</b> belum ada yang dipilih !";		
		}
				
				
		# BACA DATA DALAM FORM, masukkan datake variabel
		$txtMenu	= $_POST['txtMenu'];	
		$txtHarga	= $_POST['txtHarga'];
		$cmbKategori= $_POST['cmbKategori'];
		
		# VALIDASI NAMA, jika sudah ada akan ditolak
		$cekSql="SELECT * FROM menu WHERE nm_menu='$txtMenu'";
		$cekQry=mysql_query($cekSql, $koneksidb) or die ("Eror Query".mysql_error()); 
		if(mysql_num_rows($cekQry)>=1){
			$pesanError[] = "Maaf, Nama Menu <b> $txtMenu </b> sudah ada, ganti dengan yang lain";
		}

		# JIKA ADA PESAN ERROR DARI VALIDASI
		if (count($pesanError)>=1 ){
            echo "<div class='mssgBox'>";
			echo "<img src='images/attention.png'> <br><hr>";
				$noPesan=0;
				foreach ($pesanError as $indeks=>$pesan_tampil) { 
				$noPesan++;
					echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
				} 
			echo "</div> <br>"; 
		}
		else {
			# SIMPAN DATA KE DATABASE
			// Jika tidak menemukan error, simpan data ke database
			$kodeBaru	= buatKode("menu", "M");
			$mySql	= "INSERT INTO menu (kd_menu, nm_menu, harga, kd_kategori) 
						VALUES ('$kodeBaru', 
								'$txtMenu', 
								'$txtHarga', 
								'$cmbKategori')";
			$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
			if($myQry){
				echo "<meta http-equiv='refresh' content='0; url=?page=Menu-Data'>";
			}
			exit;
		}	
	} // Penutup POST
	
	# MASUKKAN DATA KE VARIABEL
	// Supaya saat ada pesan error, data di dalam form tidak hilang. Jadi, tinggal meneruskan/memperbaiki yg salah
	$dataKode	= buatKode("menu", "M");
	$dataMenu	= isset($_POST['txtMenu']) ? $_POST['txtMenu'] : '';
	$dataHarga	= isset($_POST['txtHarga']) ? $_POST['txtHarga'] : '';
	$dataKategori	= isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : '';
} // Penutup GET
?>

<form action="?page=Menu-Add" method="post" name="form1" target="_self">
  <table width="700" class="table-list" border="0" cellspacing="1" cellpadding="4">
    <tr>
      <th colspan="3"><b>TAMBAH PRODUK MENU</b></th>
    </tr>
    <tr>
      <td width="133"><b>Kode </b></td>
      <td width="3"><b>:</b></td>
      <td width="536"> <input name="textfield" type="text" id="textfield" value="<?php echo $dataKode; ?>" size="10" maxlength="5"  readonly="readonly"/></td>
    </tr>
    <tr>
      <td><b>Nama Menu </b></td>
      <td><b>:</b></td>
      <td><input name="txtMenu" type="text" value="<?php echo $dataMenu; ?>" size="80" maxlength="100"/></td>
    </tr>
    <tr>
      <td><b>Harga (Rp) </b></td>
      <td><b>:</b></td>
      <td> <input name="txtHarga" type="text"  value="<?php echo $dataHarga; ?>" size="20" maxlength="10"/></td>
    </tr>
    <tr>
      <td><b>Kategori</b></td>
      <td><b>:</b></td>
      <td><select name="cmbKategori">
        <option value="BLANK">...</option>
        <?php
		  $mySql = "SELECT * FROM kategori ORDER BY kd_kategori";
		  $myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
		  while ($myRow = mysql_fetch_array($myQry)) {
			if ($myRow['kd_kategori']== $dataKategori) {
				$cek = " selected";
			} else { $cek=""; }
			echo "<option value='$myRow[kd_kategori]' $cek>$myRow[nm_kategori]</option>";
		  }
		  $mySql ="";
		  ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="btnSave" value=" Simpan "/></td>
    </tr>
  </table>
</form>
