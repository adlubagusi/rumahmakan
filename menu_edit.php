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
		$cekSql="SELECT * FROM menu WHERE nm_menu='$txtMenu' AND NOT(nm_menu='".$_POST['txtMenuLm']."')";
		$cekQry=mysql_query($cekSql, $koneksidb) or die ("Eror Query".mysql_error()); 
		if(mysql_num_rows($cekQry)>=1){
			$pesanError[] = "Maaf, Nama Menu  <b> $txtMenu </b> sudah ada, ganti dengan yang lain";
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
			$mySql  = "UPDATE menu SET nm_menu='$txtMenu', harga='$txtHarga', 
					 	kd_kategori='$cmbKategori' WHERE kd_menu='".$_POST['txtKode']."'";
			$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
			if($myQry){
				echo "<meta http-equiv='refresh' content='0; url=?page=Menu-Data'>";
			}
			exit;
		}	
	} // Penutup POST

	# TAMPILKAN DATA DARI DATABASE, Untuk ditampilkan kembali ke form edit
	$Kode  = isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
	$mySql = "SELECT * FROM menu WHERE kd_menu='$Kode'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
	$kolomData = mysql_fetch_array($myQry);

		# MASUKKAN DATA KE VARIABEL
		$dataKode	= $kolomData['kd_menu'];
		$dataMenu	= isset($kolomData['nm_menu']) ?  $kolomData['nm_menu'] : $_POST['txtMenu'];
		$dataMenuLm= $kolomData['nm_menu'];
		$dataHarga	= isset($kolomData['harga']) ?  $kolomData['harga'] : $_POST['txtHarga'];
		$dataKategori	= isset($kolomData['kd_kategori']) ?  $kolomData['kd_kategori'] : $_POST['cmbKategori'];
} // Penutup GET
?>

<form action="?page=Menu-Edit" method="post" name="form1" target="_self">
  <table width="700" class="table-list" border="0" cellspacing="1" cellpadding="4">
    <tr>
      <th colspan="3"><b>[ UBAH ] MENU RESTORAN</b></th>
    </tr>
    <tr>
      <td width="133"><b>Kode </b></td>
      <td width="3"><b>:</b></td>
      <td width="536"> <input name="textfield" type="text" id="textfield" value="<?php echo $dataKode; ?>" size="10" maxlength="5"  readonly="readonly"/>
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td>
    </tr>
    <tr>
      <td><b>Nama Menu </b></td>
      <td><b>:</b></td>
      <td><input name="txtMenu" type="text" value="<?php echo $dataMenu; ?>" size="80" maxlength="100" />
        <input name="txtMenuLm" type="hidden" value="<?php echo $dataMenuLm; ?>" /></td>
    </tr>
    <tr>
      <td><b>Harga (Rp) </b></td>
      <td><b>:</b></td>
      <td> <input name="txtHarga" type="text"  value="<?php echo $dataHarga; ?>" size="20" maxlength="10" /> Rp : <?php echo format_angka($dataHarga); ?></td>
    </tr>
    <tr>
      <td><b>Kategori</b></td>
      <td><b>:</b></td>
      <td><select name="cmbKategori">
        <option value="BLANK">...</option>
        <?php
		  $dataSql = "SELECT * FROM kategori ORDER BY kd_kategori";
		  $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
		  while ($dataRow = mysql_fetch_array($dataQry)) {
			if ($dataRow['kd_kategori']== $dataKategori) {
				$cek = " selected";
			} else { $cek=""; }
			echo "<option value='$dataRow[kd_kategori]' $cek>$dataRow[nm_kategori]</option>";
		  }
		  $sqlData ="";
		  ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="btnSave" value=" Simpan " />      </td>
    </tr>
  </table>
</form>
