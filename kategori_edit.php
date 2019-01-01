<?php
include_once "library/inc.seslogin.php";

if($_GET) {
	if(isset($_POST['btnSave'])){
		# Validasi form, jika kosong sampaikan pesan error
		$pesanError = array();
		if (trim($_POST['txtKategori'])=="") {
			$pesanError[] = "Data <b>Nama Kategori</b> tidak boleh kosong !";		
		}
		
		# Baca Variabel Form
		$txtKategori= $_POST['txtKategori'];
		
		# Validasi Nama Kategori, jika sudah ada akan ditolak
		$cekSql="SELECT * FROM kategori WHERE nm_kategori='$txtKategori' AND NOT(nm_kategori='".$_POST['txtLama']."')";
		$cekQry=mysql_query($cekSql, $koneksidb) or die ("Eror Query".mysql_error()); 
		if(mysql_num_rows($cekQry)>=1){
			$pesanError[] = "Maaf, Kategori <b> $txtKategori </b> sudah ada, ganti dengan yang lain";
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
			# SIMPAN PERUBAHAN DATA, Jika jumlah error pesanError tidak ada, simpan datanya
			$mySql	= "UPDATE kategori SET nm_kategori='$txtKategori' WHERE kd_kategori ='".$_POST['txtKode']."'";
			$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
			if($myQry){
				echo "<meta http-equiv='refresh' content='0; url=?page=Kategori-Data'>";
			}
			exit;
		}	

	} // Penutup POST
	
	# TAMPILKAN DATA LOGIN UNTUK DIEDIT
	$Kode	 = isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
	$sqlShow = "SELECT * FROM kategori WHERE kd_kategori='$Kode'";
	$qryShow = mysql_query($sqlShow, $koneksidb)  or die ("Query ambil data kategori salah : ".mysql_error());
	$dataShow = mysql_fetch_array($qryShow);
	
		# MASUKKAN DATA KE VARIABEL
		$dataKode	= $dataShow['kd_kategori'];
		$dataNama	= isset($dataShow['nm_kategori']) ?  $dataShow['nm_kategori'] : $_POST['txtKategori'];
		$dataNamaLm	= $dataShow['nm_kategori'];
} // Penutup GET
?>
<form action="?page=Kategori-Edit" method="post" name="frmedit">
<table class="table-list" width="100%" style="margin-top:0px;">
	<tr>
	  <th colspan="3">UBAH  KATEGORI </th>
	</tr>
	<tr>
	  <td width="15%"><b>Kode</b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="textfield" id="textfield" value="<?php echo $dataKode; ?>" size="8" maxlength="4"  readonly="readonly"/>
    <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td></tr>
	<tr>
	  <td><b>Nama Kategori </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtKategori" type="text" value="<?php echo $dataNama; ?>" size="60" maxlength="100" />
      <input name="txtLama" type="hidden" value="<?php echo $dataNamaLm; ?>" /></td></tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSave" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
</table>
</form>

