<?php
include_once "library/inc.seslogin.php";

if($_GET) {
	if(isset($_POST['btnSave'])){
		# Validasi form, jika kosong sampaikan pesan error
		$pesanError = array();
		if (trim($_POST['cmbTanggal'])=="") {
			$pesanError[] = "Data <b>Tanggal Pemesanan</b> belum diisi, pilih pada combo !";		
		}
		if (trim($_POST['txtJam'])=="") {
			$pesanError[] = "Data <b>Jam Makan</b> tidak boleh kosong !";		
		}
		if (trim($_POST['txtNoMeja'])=="") {
			$pesanError[] = "Data <b>Nomor Meja</b> tidak boleh kosong !";		
		}
		if (trim($_POST['txtJumlahOrg'])=="") {
			$pesanError[] = "Data <b>Jumlah Orang</b> tidak boleh kosong !";		
		}
		if (trim($_POST['txtNamaPesan'])=="") {
			$pesanError[] = "Data <b>Nama pemesanan</b> tidak boleh kosong !";		
		}
		if (trim($_POST['txtKeterangan'])=="") {
			$pesanError[] = "Data <b>keterangan Lengkap</b> tidak boleh kosong !";		
		}
		if (trim($_POST['txtTelepon'])=="") {
			$pesanError[] = "Data <b>No Telpon</b> tidak boleh kosong !";		
		}
		
		# Baca Variabel Form
		$txtKode		= $_POST['txtKode'];
		$cmbTanggal 	= InggrisTgl($_POST['cmbTanggal']);
		$txtJam			= $_POST['txtJam'];
		$txtNoMeja		= $_POST['txtNoMeja'];
		$txtJumlahOrg	= $_POST['txtJumlahOrg'];
		$txtNamaPesan	= $_POST['txtNamaPesan'];
		$txtTelepon		= $_POST['txtTelepon'];
		$txtKeterangan	= $_POST['txtKeterangan'];
		
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
			$mySql	= "UPDATE pemesanan SET tanggal = '$cmbTanggal',
											jam = '$txtJam',
											nomor_meja = '$txtNoMeja',
											jumlah_orang = '$txtJumlahOrg',
											nama_pemesan = '$txtNamaPesan',
											no_telepon = '$txtTelepon',
											keterangan = '$txtKeterangan' WHERE id ='$txtKode'";
			$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
			if($myQry){
				echo "<meta http-equiv='refresh' content='0; url=?page=Pemesanan-Data'>";
			}
			exit;
		}	
	} // Penutup POST
	
	# TAMPILKAN DATA LOGIN UNTUK DIEDIT
	$Kode	= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['Kode']; 
	$sqlShow = "SELECT * FROM pemesanan WHERE id='$Kode'";
	$qryShow = mysql_query($sqlShow, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
	$dataShow = mysql_fetch_array($qryShow);
	
	# MASUKKAN DATA KE VARIABEL
	$dataKode		= $dataShow['id'];
	$dataTanggal 	= isset($dataShow['tanggal']) ? IndonesiaTgl($dataShow['tanggal']) : $_POST['cmbTanggal'];
	$dataJam		= isset($dataShow['jam']) ?  $dataShow['jam'] : $_POST['txtJam']; 
	$dataNoMeja		= isset($dataShow['nomor_meja']) ?  $dataShow['nomor_meja'] : $_POST['txtNoMeja'];
	$dataJumlahOrg	= isset($dataShow['jumlah_orang']) ?  $dataShow['jumlah_orang'] : $_POST['txtJumlahOrg']; 
	$dataNama	= isset($dataShow['nama_pemesan']) ?  $dataShow['nama_pemesan'] : $_POST['txtNamaPesan'];
	$dataLama	= $dataShow['nama_pemesan'];
	$dataKeterangan = isset($dataShow['keterangan']) ?  $dataShow['keterangan'] : $_POST['txtKeterangan'];
	$dataTelepon= isset($dataShow['no_telepon']) ?  $dataShow['no_telepon'] : $_POST['txtTelepon'];
} // Penutup GET
?>
<form action="?page=Pemesanan-Edit&Act=Update" method="post" name="frmedit">
<table class="table-list" width="100%" style="margin-top:0px;">
	<tr>
	  <th colspan="3">
      PEMESANAN TEMPAT
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></th>
	</tr>
	<tr class="table-common">
      <td><b>Tanggal Makan</b></td>
	  <td><b>:</b></td>
	  <td><?php echo form_tanggal("cmbTanggal",$dataTanggal); ?></td>
    </tr>
	<tr>
      <td width="15%"><b>Jam Makan </b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="txtJam" value="<?php echo $dataJam; ?>" size="60" maxlength="40"/></td>
    </tr>
	<tr>
      <td><b>Nomor Meja </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtNoMeja" value="<?php echo $dataNoMeja; ?>" size="60" maxlength="40"/></td>
    </tr>
	<tr>
      <td><b>Jumlah Orang </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtJumlahOrg" value="<?php echo $dataJumlahOrg; ?>" size="60" maxlength="40"/></td>
    </tr>
	<tr>
	  <td><b>Nama Pemesan </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtNamaPesan" type="text" value="<?php echo $dataNama; ?>" size="60" maxlength="60" /></td></tr>
	<tr>
      <td><b>No Telpon </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtTelepon" value="<?php echo $dataTelepon; ?>" size="20" maxlength="20" /></td>
    </tr>
	<tr>
      <td><b>Keterangan (Menu) </b></td>
	  <td><b>:</b></td>
	  <td><textarea name="txtKeterangan" cols="45" rows="3"><?php echo $dataKeterangan; ?></textarea></td>
    </tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSave" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
</table>
</form>

