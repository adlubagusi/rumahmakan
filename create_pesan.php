<?php
include_once "library/inc.seslogin.php";

if($_GET) {
	# HAPUS DAFTAR barang DI TMP
	if(isset($_GET['Act'])){
		if(trim($_GET['Act'])=="Delete"){
			# Hapus Tmp jika datanya sudah dipindah
			$mySql = "DELETE FROM tmp_penjualan WHERE id='".$_GET['id']."' AND kd_user='".$_SESSION['SES_LOGIN']."'";
			mysql_query($mySql, $koneksidb) or die ("Gagal kosongkan tmp".mysql_error());
		}
		if(trim($_GET['Act'])=="Sucsses"){
			echo "<b>DATA BERHASIL DISIMPAN</b> <br><br>";
		}
	}
	// =========================================================================

	# TOMBOL PILIH (KODE barang) DIKLIK
	if(isset($_POST['btnPilih'])){
		$pesanError = array();
		if (trim($_POST['cmbMenu'])=="BLANK") {
			$pesanError[] = "<b>Nama Menu Makan belum diisi</b>, pilih pada daftar menu !";
		}
		if (trim($_POST['txtJumlah'])=="" OR ! is_numeric(trim($_POST['txtJumlah']))) {
			$pesanError[] = "Data <b>Jumlah Porsi (Qty) belum diisi</b>, silahkan <b>isi dengan angka</b> !";
		}

		# Baca variabel
		$cmbMenu	= $_POST['cmbMenu'];
		$txtJumlah	= $_POST['txtJumlah'];

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
			# Jika jumlah error pesanError tidak ada

			# Jika sudah pernah dipilih, cukup datanya di update jumlahnya
			$cekSql ="SELECT * FROM tmp_penjualan WHERE kd_menu='$cmbMenu' AND kd_user='".$_SESSION['SES_LOGIN']."'";
			$cekQry = mysql_query($cekSql, $koneksidb) or die ("Gagal Query".mysql_error());
			if (mysql_num_rows($cekQry) >= 1) {
				// Jika tadi sudah dipilih, cukup jumlahnya diupdate
				$tmpSql = "UPDATE tmp_penjualan SET jumlah=jumlah + $txtJumlah
							WHERE kd_menu='$cmbMenu' AND kd_user='".$_SESSION['SES_LOGIN']."'";
				mysql_query($tmpSql, $koneksidb) or die ("Gagal Query : ".mysql_error());
			}
			else {
				$menuSql ="SELECT * FROM menu WHERE kd_menu='$cmbMenu'";
				$menuQry = mysql_query($menuSql, $koneksidb) or die ("Gagal Query".mysql_error());
				$menuRow = mysql_fetch_array($menuQry);
				if (mysql_num_rows($menuQry) >= 1) {
					# Hitung Diskon (Jika Ada), dan Harga setelah diskon
					//$besarDiskon = intval($menuRow['harga']) * (intval($menuRow['diskon'])/100);
					//$hargaDiskon = intval($menuRow['harga']) - $besarDiskon;

					$dataHarga = $menuRow['harga'];
					$tmp2Sql = "INSERT INTO tmp_penjualan SET
											kd_menu='$cmbMenu',
											harga='$dataHarga',
											jumlah='$txtJumlah',
											kd_user='".$_SESSION['SES_LOGIN']."'";
					mysql_query($tmp2Sql, $koneksidb) or die ("Gagal Query detail barang : ".mysql_error());
				}
			}
		}

	}
	// ============================================================================

	# JIKA TOMBOL SIMPAN DIKLIK
	if(isset($_POST['btnSave'])){
		$pesanError = array();
		if (trim($_POST['cmbTanggal'])=="") {
			$pesanError[] = "Data <b>Tanggal transaksi</b> belum diisi, pilih pada combo !";
		}
		//if (trim($_POST['txtNoMeja'])=="") {
		//	$pesanError[] = "Data <b> Nomor Meja</b> belum diisi, isi dengan informasi meja";
		//}
		//if (trim($_POST['txtUangBayar'])==""  OR ! is_numeric(trim($_POST['txtUangBayar']))) {
		//	$pesanError[] = "Data <b> Uang Bayar</b> belum diisi, isi dengan uang (Rp) !";
		//}
		//if (trim($_POST['txtUangBayar']) < trim($_POST['txtTotBayar'])) {
		//	$pesanError[] = "Data <b> Uang Bayar Belum Cukup</b>";
		//}

		$tmpSql ="SELECT COUNT(*) As qty FROM tmp_penjualan WHERE kd_user='".$_SESSION['SES_LOGIN']."'";
		$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
		$tmpRow = mysql_fetch_array($tmpQry);
		if ($tmpRow['qty'] < 1) {
			$pesanError[] = "<b>Item Menu</b> belum ada yang dimasukan, <b>minimal 1 menu</b>.";
		}

		# Baca variabel
		$txtNoMeja		= $_POST['txtNoMeja'];
		$txtPelanggan	= $_POST['txtPelanggan'];
		$txtKeterangan	= $_POST['txtKeterangan'];
		$txtUangBayar	= $_POST['txtUangBayar'];
		$cmbTanggal 	= $_POST['cmbTanggal'];


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
			# Jika jumlah error pesanError tidak ada
			$noTransaksi = buatKode("penjualan", "JL");
			$mySql	= "INSERT INTO penjualan SET
							no_penjualan='$noTransaksi',
							tgl_penjualan='".InggrisTgl($_POST['cmbTanggal'])."',
							nomor_meja='$txtNoMeja',
							pelanggan='$txtPelanggan',
							keterangan='$txtKeterangan',
							uang_bayar='$totalBayar',
							kd_user='".$_SESSION['SES_LOGIN']."'";
			$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());

			if($myQry){
				# �LANJUTAN, SIMPAN DATA
				# Ambil semua data barang yang dipilih, berdasarkan kasir yg login
				$tmpSql ="SELECT * FROM tmp_penjualan WHERE kd_user='".$_SESSION['SES_LOGIN']."'";
				$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
				while ($tmpRow = mysql_fetch_array($tmpQry)) {
					$dataKode =	$tmpRow['kd_menu'];
					$dataHarga=	$tmpRow['harga'];
					$dataJumlah=$tmpRow['jumlah'];

					// Masukkan semua data dari tabel TMP ke tabel ITEM
					$itemSql = "INSERT INTO penjualan_item SET
											no_penjualan='$noTransaksi',
											kd_menu='$dataKode',
											harga='$dataHarga',
											jumlah='$dataJumlah'";
		  			mysql_query($itemSql, $koneksidb) or die ("Gagal Query ".mysql_error());

					// Skrip Update stok
					//$stokSql = "UPDATE barang SET stok = stok - $tmpRow[jumlah] WHERE kd_barang='$tmpRow[kd_barang]'";
		  			//mysql_query($stokSql, $koneksidb) or die ("Gagal Query Edit Stok".mysql_error());
				}

				# Kosongkan Tmp jika datanya sudah dipindah
				$hapusSql = "DELETE FROM tmp_penjualan WHERE kd_user='".$_SESSION['SES_LOGIN']."'";
				mysql_query($hapusSql, $koneksidb) or die ("Gagal kosongkan tmp".mysql_error());

				// Refresh form
				echo "<meta http-equiv='refresh' content='0; url=transaksi_penjualan_view2.php?noNota=$noTransaksi'>";
			}
			else{
				$pesanError[] = "Gagal penyimpanan ke database";
			}
		}
	}

	// ============================================================================
} // Penutup GET
$sqlmeja= mysql_query("SELECT * FROM user WHERE kd_user='$_SESSION[SES_LOGIN]'");
$bcmeja=mysql_fetch_array($sqlmeja);
# TAMPILKAN DATA KE FORM
$noTransaksi 	= buatKode("penjualan", "JL");
$tglTransaksi 	= isset($_POST['cmbTanggal']) ? $_POST['cmbTanggal'] : date('d-m-Y');
$dataNoMeja		= isset($_POST['txtNoMeja']) ? $_POST['txtNoMeja'] : $bcmeja['nm_user'];
$dataPelanggan	= isset($_POST['txtPelanggan']) ? $_POST['txtPelanggan'] : 'Pelanggan';
$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
$dataUangBayar	= isset($_POST['txtUangBayar']) ? $_POST['txtTotBayar'] : '';
?>
<form action="?page=Pesan-Menu" method="post"  name="frmadd">
<table width="700" cellpadding="3" cellspacing="1" class="table-common" style="margin-top:0px;">
	<tr>
		<td colspan="3" align="right"><h1>PEMESANAN MENU</h1> </td>
	</tr>
	<tr>
		<td bgcolor="#CCCCCC"><b>DATA TRANSAKSI </b></td>
		<td bgcolor="#CCCCCC">&nbsp;</td>
		<td>&nbsp;</td>
    </tr>
	<tr>
		<td width="21%"><b>No Penjualan </b></td>
		<td width="1%"><b>:</b></td>
		<td width="78%">
			<input name="txtNomor" value="<?php echo $noTransaksi; ?>" size="11" maxlength="11" readonly="readonly"/>
		</td>
	</tr>
	<tr>
		<td><b>Tanggal Transaksi </b></td>
		<td><b>:</b></td>
		<td><?php echo form_tanggal("cmbTanggal",$tglTransaksi); ?></td>
    </tr>
	<tr>
		<td><b>Nomor Meja </b></td>
		<td><b>:</b></td>
		<td><input name="txtNoMeja" value="<?php echo $dataNoMeja; ?>" size="55" maxlength="60"/></td>
    </tr>
	<tr>
		<td><b>Pelanggan</b></td>
		<td><b>:</b></td>
		<td><input name="txtPelanggan" id="txtPelanggan"
				 	 onfocus="if (value == 'Umum') {value =''}"
					 onBlur="if (value == '') {value = 'Umum'}" value="<?php echo $dataPelanggan; ?>" size="55" maxlength="30"/>
		* Diisi nama pelanggan</td>
    </tr>
	<tr>
		<td><strong>Keterangan</strong></td>
		<td><b>:</b></td>
		<td><input name="txtKeterangan" value="<?php echo $dataKeterangan; ?>" size="55" maxlength="100" /></td>
    </tr>
	<tr>
		<td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
    </tr>
	<tr>
		<td bgcolor="#CCCCCC"><b>PESAN MENU </b></td>
		<td bgcolor="#CCCCCC">&nbsp;</td>
		<td>&nbsp;</td>
    </tr>
	<tr>
		<td><b>Menu Makan </b></td>
		<td><b>:</b></td>
		<td>
			<b>
				<select name="cmbMenu">
					<option value="BLANK">....</option>
					<?php
						$mySql = "SELECT * FROM menu ORDER BY kd_kategori";
						$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
						while ($kolomData = mysql_fetch_array($myQry)) {
							echo "<option value='$kolomData[kd_menu]'>[ $kolomData[kd_menu] ] $kolomData[nm_menu]</option>";
						}
						$mySql ="";
					?>
					</select>
					Jumlah Porsi :
					<input class="angkaC" name="txtJumlah" size="2" maxlength="4" value="1"
						 onblur="if (value == '') {value = '1'}"
						 onfocus="if (value == '1') {value =''}"/>

				<input name="btnPilih" type="submit" style="cursor:pointer;" value=" Pilih " />
			</b>
		</td>
    </tr>

	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
</table>

<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="2">
    <tr>
    	<th colspan="7">DAFTAR  ITEM</th>
    </tr>
    <tr>
	    <td width="25" align="center" bgcolor="#CCCCCC"><b>No</b></td>
	    <td width="63" align="center" bgcolor="#CCCCCC"><b>Kode</b></td>
	    <td width="325" bgcolor="#CCCCCC"><b>Nama Menu </b></td>
	    <td width="97" align="right" bgcolor="#CCCCCC"><b>Harga (Rp.) </b></td>
	    <td width="59" align="center" bgcolor="#CCCCCC"><b>Jumlah</b></td>
	    <td width="100" align="right" bgcolor="#CCCCCC"><b>Subtotal (Rp.) </b></td>
	    <td width="45" align="center" bgcolor="#FFCC00"><b>Delete</b></td>
    </tr>
<?php
//  tabel menu
$tmpSql ="SELECT menu.*, tmp_penjualan.id, tmp_penjualan.jumlah
		FROM menu, tmp_penjualan
		WHERE menu.kd_menu=tmp_penjualan.kd_menu
		AND tmp_penjualan.kd_user='".$_SESSION['SES_LOGIN']."'
		ORDER BY menu.kd_menu ";
$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
$totalBayar = 0; $qtyItem = 0; $nomor=0;
while($tmpRow = mysql_fetch_array($tmpQry)) {
	$nomor++;
	$id			= $tmpRow['id'];
	$subSotal 	= $tmpRow['jumlah'] * $tmpRow['harga'];
	$totalBayar	= $totalBayar + $subSotal;
	$qtyItem	= $qtyItem + $tmpRow['jumlah'];
?>
    <tr>
	    <td align="center"><?php echo $nomor; ?></td>
	    <td align="center"><b><?php echo $tmpRow['kd_menu']; ?></b></td>
	    <td><?php echo $tmpRow['nm_menu']; ?></td>
	    <td align="right"><?php echo format_angka($tmpRow['harga']); ?></td>
	    <td align="center"><?php echo $tmpRow['jumlah']; ?></td>
	    <td align="right"><?php echo format_angka($subSotal); ?></td>
	    <td align="center" bgcolor="#FFFFCC">
	    	<a href="?page=Transaksi-Penjualan&Act=Delete&id=<?php echo $id; ?>" target="_self">
	    		<img src="images/hapus.gif" width="16" height="16" border="0" />
	    	</a>
	    </td>
    </tr>
<?php
}?>
    <tr>
	    <td colspan="4" align="right" bgcolor="#F5F5F5"><b>Total Bayar (Rp.) : </b></td>
	    <td align="center" bgcolor="#F5F5F5"><b><?php echo $qtyItem; ?></b></td>
	    <td align="right" bgcolor="#F5F5F5"><b><?php echo format_angka($totalBayar); ?></b></td>
	    <td align="center" bgcolor="#F5F5F5">&nbsp;</td>
    </tr>
  <!--<tr>
    <td colspan="4" align="right" bgcolor="#F5F5F5"><b>Uang  Bayar (Rp.) : </b></td>
    <td align="center" bgcolor="#F5F5F5">&nbsp;</td>-->
    <td align="right" bgcolor="#F5F5F5"><input type="hidden" name="txtUangBayar" value="<?php echo $dataUangBayar; ?>" size="16" maxlength="12"/></td>
    <!--<td align="center" bgcolor="#F5F5F5">&nbsp;</td>
  </tr>-->
    <tr>
	    <td colspan="4" align="right">&nbsp;</td>
	    <td align="center">&nbsp;</td>
	    <td align="right"><input name="txtTotBayar" type="hidden" value="<?php echo $totalBayar; ?>" /></td>
	    <td align="center">&nbsp;</td>
    </tr>
    <tr>
	    <td colspan="6" align="right"><input name="btnSave" type="submit" style="cursor:pointer;" value=" SIMPAN TRANSAKSI " /></td>
	    <td align="center">&nbsp;</td>
    </tr>
</table>
</form>
