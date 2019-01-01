<?php
include_once "library/inc.seslogin.php";

if($_GET) {
	# HAPUS DAFTAR barang DI TMP
	if(isset($_GET['Act'])){
		if(trim($_GET['Act'])=="Delete"){
			# Hapus Tmp jika datanya sudah dipindah
			$mySql = "DELETE FROM tmp_pembelian WHERE id='".$_GET['id']."' AND kd_user='".$_SESSION['SES_LOGIN']."'";
			mysql_query($mySql, $koneksidb) or die ("Gagal kosongkan tmp".mysql_error());
		}
		if(trim($_GET['Act'])=="Sucsses"){
			echo "<b>DATA BERHASIL DISIMPAN</b> <br><br>";
		}
	}
	// =========================================================================
	
	# TOMBOL PILIH DIKLIK
	if(isset($_POST['btnPilih'])){
		$pesanError = array();
		if (trim($_POST['txtItemBarang'])=="") {
			$pesanError[] = "Data <b>Nama Item Barang</b> belum diisi, harus Anda isi !";		
		}
		if (trim($_POST['cmbSatuan'])=="BLANK") {
			$pesanError[] = "Data <b>Satuan Barang</b> belum dipilih, silahkan pilih !";		
		}
		if (trim($_POST['txtHarga'])=="" OR ! is_numeric(trim($_POST['txtHarga']))) {
			$pesanError[] = "Data <b>Harga Item Barang</b> belum diisi, harus Anda isi dengan angka !";		
		}
		if (trim($_POST['txtJumlah'])=="" OR ! is_numeric(trim($_POST['txtJumlah']))) {
			$pesanError[] = "Data <b>Jumlah Porsi (Qty) belum diisi</b>, silahkan <b>isi dengan angka</b> !";		
		}
		
		# Baca variabel
		$txtItemBarang	= $_POST['txtItemBarang'];
		$txtHarga	= $_POST['txtHarga'];
		$cmbSatuan	= $_POST['cmbSatuan'];
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
			$tmpSql = "INSERT INTO tmp_pembelian SET 
									item_barang='$txtItemBarang', 
									harga='$txtHarga', 
									jumlah='$txtJumlah',
									satuan='$cmbSatuan',
									kd_user='".$_SESSION['SES_LOGIN']."'";
			mysql_query($tmpSql, $koneksidb) or die ("Gagal Query detail barang : ".mysql_error());
			
			// Refresh form
			echo "<meta http-equiv='refresh' content='0; url=?page=Transaksi-Pembelian'>";
		}

	}
	// ============================================================================
	
	# JIKA TOMBOL SIMPAN DIKLIK
	if(isset($_POST['btnSave'])){
		$pesanError = array();
		if (trim($_POST['cmbSupplier'])=="BLANK") {
			$pesanError[] = "Data <b> Nama Supplier</b> belum diisi, pilih pada combo !";		
		}
		if (trim($_POST['cmbTanggal'])=="") {
			$pesanError[] = "Data <b>Tanggal Transaksi</b> belum diisi, pilih pada combo !";		
		}
		
		// Validasi jika belum ada satupun data item yang dimasukkan
		$tmpSql ="SELECT COUNT(*) As qty FROM tmp_pembelian WHERE kd_user='".$_SESSION['SES_LOGIN']."'";
		$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
		$tmpRow = mysql_fetch_array($tmpQry);
		if ($tmpRow['qty'] < 1) {
			$pesanError[] = "Maaf...., <b>Item Barang</b> belum ada yang dimasukan, <b>minimal 1 menu</b>.";
		}
		
		# Baca variabel
		$cmbSupplier	= $_POST['cmbSupplier'];
		$txtKeterangan	= $_POST['txtKeterangan'];
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
			# Jika jumlah error pesanError tidak ada
			$noTransaksi = buatKode("pembelian", "BL");
			$mySql	= "INSERT INTO pembelian SET 
							no_pembelian='$noTransaksi', 
							tgl_pembelian='".InggrisTgl($_POST['cmbTanggal'])."', 
							kd_supplier='$cmbSupplier', 
							keterangan='$txtKeterangan', 
							kd_user='".$_SESSION['SES_LOGIN']."'";
			$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
			if($myQry){
				# Ambil semua data barang yang dipilih, berdasarkan kasir yg login
				$tmpSql ="SELECT * FROM tmp_pembelian WHERE kd_user='".$_SESSION['SES_LOGIN']."'";
				$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
				while ($tmpRow = mysql_fetch_array($tmpQry)) {
					$dataKode =	$tmpRow['item_barang'];
					$dataHarga=	$tmpRow['harga'];
					$dataJumlah=$tmpRow['jumlah'];
					$dataSatuan=$tmpRow['satuan'];
					
					// Masukkan semua barang yang udah diisi ke tabel pembelian detail
					$itemSql = "INSERT INTO pembelian_item SET 
											no_pembelian='$noTransaksi', 
											item_barang='$dataKode', 
											harga='$dataHarga', 
											jumlah='$dataJumlah',
											satuan='$dataSatuan'";
		  			mysql_query($itemSql, $koneksidb) or die ("Gagal Query ".mysql_error());
				}
				
				# Kosongkan Tmp jika datanya sudah dipindah
				$hapusSql = "DELETE FROM tmp_pembelian WHERE kd_user='".$_SESSION['SES_LOGIN']."'";
				mysql_query($hapusSql, $koneksidb) or die ("Gagal kosongkan tmp".mysql_error());
				
				// Refresh form
				echo "<meta http-equiv='refresh' content='0; url=transaksi_pembelian_view.php?noNota=$noTransaksi'>";
			}
			else{
				$pesanError[] = "Gagal penyimpanan ke database";
			}
		}	
	}
	
	// ============================================================================
} // Penutup GET

# TAMPILKAN DATA KE FORM
$noTransaksi 	= buatKode("pembelian", "BL");
$tglTransaksi 	= isset($_POST['cmbTanggal']) ? $_POST['cmbTanggal'] : date('d-m-Y');
$dataSupplier	= isset($_POST['cmbSupplier']) ? $_POST['cmbSupplier'] : '';
$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';

$dataItemBarang	= isset($_POST['txtItemBarang']) ? $_POST['txtItemBarang'] : '';
$dataHarga		= isset($_POST['txtHarga']) ? $_POST['txtHarga'] : '';
$dataSatuan		= isset($_POST['cmbSatuan']) ? $_POST['cmbSatuan'] : '';
?>
<form action="?page=Transaksi-Pembelian" method="post"  name="frmadd">
<table width="700" cellspacing="1" class="table-common" style="margin-top:0px;">
	<tr>
	  <td colspan="3" align="right"><h1>TRANSAKSI PEMBELIAN  </h1> </td>
	</tr>
	<tr>
	  <td bgcolor="#CCCCCC"><b>DATA TRANSAKSI </b></td>
	  <td bgcolor="#CCCCCC">&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td width="21%"><b>No Pembelian </b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="78%"><input name="txtNomor" value="<?php echo $noTransaksi; ?>" size="11" maxlength="11" readonly="readonly"/></td></tr>
	<tr>
      <td><b>Tanggal Transaksi </b></td>
	  <td><b>:</b></td>
	  <td><?php echo form_tanggal("cmbTanggal",$tglTransaksi); ?></td>
    </tr>
	<tr>
      <td><b>Supplier</b></td>
	  <td><b>:</b></td>
	  <td><b>
        <select name="cmbSupplier">
          <option value="BLANK">....</option>
          <?php
	  $mySql = "SELECT * FROM supplier ORDER BY kd_supplier";
	  $myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($kolomData = mysql_fetch_array($myQry)) {
	  	if ($dataSupplier == $kolomData['kd_supplier']) {
			$cek = " selected";
		} else { $cek=""; }
	  	echo "<option value='$kolomData[kd_supplier]' $cek>[ $kolomData[kd_supplier] ] $kolomData[nm_supplier]</option>";
	  }
	  $mySql ="";
	  ?>
        </select>
	  </b></td>
    </tr>
	<tr>
      <td><strong>Keterangan</strong></td>
	  <td><b>:</b></td>
	  <td><input name="txtKeterangan" value="<?php echo $dataKeterangan; ?>" size="60" maxlength="100" /></td>
    </tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td bgcolor="#CCCCCC"><b>ITEM PEMBELIAN </b></td>
	  <td bgcolor="#CCCCCC">&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td><b>Nama Item Barang </b></td>
	  <td><b>:</b></td>
	  <td><b><input name="txtItemBarang" value="<?php echo $dataItemBarang; ?>" size="60" maxlength="100" />
	  </b></td>
    </tr>
	<tr>
	  <td><b>Harga Satuan (Rp.) </b></td>
	  <td><b>:</b></td>
	  <td><b>
	    <input name="txtHarga" value="<?php echo $dataHarga; ?>" size="20" maxlength="12" />
	     
	    Jumlah  :
        <input class="angkaC" name="txtJumlah" size="2" maxlength="5" value="1" 
	  		 onblur="if (value == '') {value = '1'}" 
      		 onfocus="if (value == '1') {value =''}"/>
        <select name="cmbSatuan">
          <option value="BLANK"> - Satuan -</option>
          <?php
		  $satuan = array("Ons", "Kg", "Biji", "Ekor", "Bungkus", "Sashet", "Karung", "Botol", "Galon", "Dus", "Paket");
          foreach ($satuan as $nilai) {
            if ($dataSatuan == $nilai) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek>$nilai</option>";
          }
          ?>
        </select>
        <input name="btnPilih" type="submit" style="cursor:pointer;" value=" Pilih " />
</b></td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input name="btnSave" type="submit" style="cursor:pointer;" value=" SIMPAN TRANSAKSI " /></td>
    </tr>
</table>

<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <th colspan="7">DAFTAR  ITEM</th>
    </tr>
  <tr>
    <td width="27" align="center" bgcolor="#CCCCCC"><b>No</b></td>
    <td width="379" bgcolor="#CCCCCC"><b>Item Barang </b></td>
    <td width="100" align="right" bgcolor="#CCCCCC"><b>Harga (Rp.) </b></td>
    <td width="60" align="center" bgcolor="#CCCCCC"><b>Jumlah</b></td>
    <td width="60" align="center" bgcolor="#CCCCCC"><b>Satuan</b></td>
    <td width="106" align="right" bgcolor="#CCCCCC"><b>Subtotal (Rp.) </b></td>
    <td width="47" align="center" bgcolor="#FFCC00"><b>Delete</b></td>
  </tr>
<?php
//  tabel menu 
$tmpSql ="SELECT * FROM tmp_pembelian WHERE  kd_user='".$_SESSION['SES_LOGIN']."'
			ORDER BY id";
$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
$total = 0; $qtyItem = 0; $nomor=0;
while($tmpRow = mysql_fetch_array($tmpQry)) {
	$id		= $tmpRow['id'];
	$subSotal = $tmpRow['jumlah'] * $tmpRow['harga'];
	$total	= $total + $subSotal;
	$qtyItem= $qtyItem + $tmpRow['jumlah'];
	$nomor++;
?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><b><?php echo $tmpRow['item_barang']; ?></b></td>
    <td align="right"><?php echo format_angka($tmpRow['harga']); ?></td>
    <td align="center"><?php echo $tmpRow['jumlah']; ?></td>
    <td align="center"><?php echo $tmpRow['satuan']; ?></td>
    <td align="right"><?php echo format_angka($subSotal); ?></td>
    <td align="center" bgcolor="#FFFFCC"><a href="?page=Transaksi-Pembelian&Act=Delete&id=<?php echo $id; ?>" target="_self"><img src="images/hapus.gif" width="16" height="16" border="0" /></a></td>
  </tr>
<?php 
}?>
  <tr>
    <td colspan="5" align="right"><b>Grand Total Belanja : </b></td>
    <td align="right"><b><?php echo format_angka($total); ?></b></td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
</form>
