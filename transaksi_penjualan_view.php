<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# Baca variabel URL
$kodeTransaksi = $_GET['noNota'];

# Perintah untuk mendapatkan data dari tabel penjualan
$mySql = "SELECT penjualan.*, user.nm_user FROM penjualan, user
			WHERE penjualan.kd_user=user.kd_user AND no_penjualan='$kodeTransaksi'";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query penjualan salah : ".mysql_error());
$kolomData = mysql_fetch_array($myQry);
?>
<html>
<head>
<title> :: Nota ::</title>
<link href="styles/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="550" border="0" cellspacing="1" cellpadding="4" class="table-print">
  <tr>
    <td width="59" rowspan="2" align="center"><img src="images/logonota.png" width="97" height="61" /></td>
    <td width="208"><strong>
      <h3>RESTO</h3>
    </strong></td>
    <td width="217"><strong>Malang, </strong> <?php echo IndonesiaTgl($kolomData['tgl_penjualan']); ?></td>
  </tr>
  <tr>
    <td>Desa Ngijo, Kecamatan Karangploso, Kabupaten Malang <br> Telpon : 07241111111 </td>
    <td valign="top"><strong>Kepada Yth.</strong> <?php echo $kolomData['pelanggan']; ?> .. ..... ... .. ... ... .... . .... ... ... .. .... ..... ....... ....... .... ... ... ... ... .... .... ....</td>
  </tr>
</table>
<table class="table-list" width="550" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="5"><strong>No Nota : <?php echo $kolomData['no_penjualan']; ?></strong></td>
  </tr>
  <tr>
    <td width="37" align="center" bgcolor="#CCCCCC"><b>No</b></td>
    <td width="277" bgcolor="#CCCCCC"><b>Daftar  Menu </b></td>
    <td width="71" align="center" bgcolor="#CCCCCC"><b>Harga (Rp) </b></td>
    <td width="49" align="center" bgcolor="#CCCCCC"><strong>Jumlah</strong></td>
    <td width="90" align="right" bgcolor="#CCCCCC"><b>Subtotal (Rp)</b></td>
  </tr>
	<?php
		# Menampilkan List Item menu yang dibeli untuk Nomor Transaksi Terpilih
		$notaSql = "SELECT menu.*, penjualan_item.* FROM menu, penjualan_item
					WHERE menu.kd_menu=penjualan_item.kd_menu AND penjualan_item.no_penjualan='$kodeTransaksi'
					ORDER BY menu.kd_menu ASC";
		$notaQry = mysql_query($notaSql, $koneksidb)  or die ("Query list menu salah : ".mysql_error());
		$nomor  = 0;  $totalBelanja = 0;
		while ($notaRow = mysql_fetch_array($notaQry)) {
		$nomor++;
		# Hitung Diskon (jika ada), dan Harga setelah diskon
		//$besarDiskon = intval($notaRow['harga']) * (intval($notaRow['diskon'])/100);
		//$hargaDiskon = intval($notaRow['harga']) - $besarDiskon;

		# Membuat Subtotal
		$subtotal  = $notaRow['harga'] * intval($notaRow['jumlah']);

		# Menghitung Total Belanja keseluruhan
		$totalBelanja = $totalBelanja + intval($subtotal);


    # Hitung ppn
    $ppn = $totalBelanja*10/100;

    # Hitung  total bayar
    $totalBayar = $totalBelanja+$ppn;

    # Hitung sisa bayar (pengembalian)
    $UangKembali = $kolomData['uang_bayar'] - $totalBayar;

	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $notaRow['nm_menu']; ?></td>
    <td align="right"><?php echo format_angka($notaRow['harga']); ?></td>
    <td align="center"><?php echo $notaRow['jumlah']; ?></td>
    <td align="right"><?php echo format_angka($subtotal); ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="4" align="right"><b>Total Harga (Rp) : </b></td>
    <td align="right" bgcolor="#F5F5F5"><b><?php echo format_angka($totalBelanja); ?></b></td>
  </tr>
  <tr>
    <td colspan="4" align="right"><b>PPN (10%) : </b></td>
    <td align="right" bgcolor="#F5F5F5"><b><?php echo format_angka($ppn); ?></b></td>
  </tr>
  <tr>
    <td colspan="4" align="right"><b>Total Bayar (Rp) : </b></td>
    <td align="right" bgcolor="#F5F5F5"><b><?php echo format_angka($totalBayar); ?></b></td>
  </tr>
  <tr>
    <td colspan="4" align="right"><b>Uang  Bayar (Rp) : </b></td>
    <td align="right" bgcolor="#F5F5F5"><b><?php echo format_angka($kolomData['uang_bayar']); ?></b></td>
  </tr>
  <tr>
    <td colspan="4" align="right"><b>Pengembalian (Rp) : </b></td>
    <td align="right" bgcolor="#CCFFFF"><b><?php echo format_angka($UangKembali); ?></b></td>
  </tr>
  <tr>
    <td colspan="5"><!--<strong>Kasir :</strong>--> <?php// echo $kolomData['nm_user']; ?></td>
  </tr>
</table>
<br/>
<table class="table-print" width="550" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="140" align="center">&nbsp;</td>
    <td width="204">&nbsp;</td>
    <td width="140" align="center">Hormat kami,<br /><br /><br />
	( Resto ) </td>
  </tr>
</table>

<img src="images/btn_print.png" width="40" height="44" onClick="javascript:window.print()" class="no_print" />
</body>
</html>
