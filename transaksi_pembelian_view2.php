<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# Baca variabel URL
$kodeTransaksi = $_GET['noNota'];

# Perintah untuk mendapatkan data dari tabel pembelian
$mySql = "SELECT pembelian.*, supplier.nm_supplier, user.nm_user
			FROM pembelian, supplier, user
			WHERE pembelian.kd_supplier=supplier.kd_supplier AND pembelian.kd_user=user.kd_user
			AND no_pembelian='$kodeTransaksi'";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$kolomData = mysql_fetch_array($myQry);
?>
<html>
<head>
<title>Transaksi Pembelanjaan Stok</title>
<link href="styles/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="600" border="0" cellspacing="1" cellpadding="4" class="table-print">
  <tr>
    <td width="139"><b>No pembelian </b></td>
    <td width="5"><b>:</b></td>
    <td width="378" valign="top"><strong><?php echo $kolomData['no_pembelian']; ?></strong></td>
  </tr>
  <tr>
    <td><b>Tanggal Transaksi </b></td>
    <td><b>:</b></td>
    <td valign="top"><?php echo IndonesiaTgl($kolomData['tgl_pembelian']); ?></td>
  </tr>
  <tr>
    <td><b>Supplier</b></td>
    <td><b>:</b></td>
    <td valign="top"><?php echo $kolomData['nm_supplier']; ?></td>
  </tr>
  <tr>
    <td><strong>Keterangan</strong></td>
    <td><b>:</b></td>
    <td valign="top"><?php echo $kolomData['keterangan']; ?></td>
  </tr>
  <tr>
    <td><strong>Kasir</strong></td>
    <td><b>:</b></td>
    <td valign="top"><?php echo $kolomData['nm_user']; ?></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
<table class="table-list" width="600" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="37" align="center" bgcolor="#CCCCCC"><b>No</b></td>
    <td width="277" bgcolor="#CCCCCC"><b>Daftar  Item Barang </b></td>
    <td width="71" align="center" bgcolor="#CCCCCC"><b>Harga (Rp) </b></td>
    <td width="49" align="center" bgcolor="#CCCCCC"><strong>Jumlah</strong></td>
    <td width="49" align="center" bgcolor="#CCCCCC"><strong>Satuan</strong></td>
    <td width="90" align="right" bgcolor="#CCCCCC"><b>Subtotal (Rp)</b></td>
  </tr>
	<?php
		# Menampilkan List Item barang
		$notaSql = "SELECT * FROM pembelian_item WHERE no_pembelian='$kodeTransaksi'";
		$notaQry = mysql_query($notaSql, $koneksidb)  or die ("Query salah : ".mysql_error());
		$nomor  = 0;  $totalBelanja = 0;
		while ($notaRow = mysql_fetch_array($notaQry)) {
			$nomor++;
			# Membuat Subtotal
			$subtotal  = $notaRow['harga'] * intval($notaRow['jumlah']);

			# Menghitung Total Belanja keseluruhan
			$totalBelanja = $totalBelanja + intval($subtotal);
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $notaRow['item_barang']; ?></td>
    <td align="right"><?php echo format_angka($notaRow['harga']); ?></td>
    <td align="center"><?php echo $notaRow['jumlah']; ?></td>
    <td align="center"><?php echo $notaRow['satuan']; ?></td>
    <td align="right"><?php echo format_angka($subtotal); ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="5" align="right"><b> Total Belanja (Rp) : </b></td>
    <td align="right" bgcolor="#CCFFFF"><b><?php echo format_angka($totalBelanja); ?></b></td>
  </tr>
</table>
<br/>
<!--<img src="images/btn_print.png" width="40" height="44" onClick="javascript:window.print()" />-->
</body>
</html>
