<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM penjualan";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<h2>DATA PEMESANAN</h2>
<table class="table-list" width="745" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="28" align="center" bgcolor="#CCCCCC"><b>No</b></td>
    <td width="79" bgcolor="#CCCCCC"><b>Tanggal</b></td>
    <td width="110" bgcolor="#CCCCCC"><b>Nomor Transaksi </b> </td>
    <td width="192" bgcolor="#CCCCCC"><b>Pelanggan </b></td>
    <td width="98" bgcolor="#CCCCCC"><strong>No Meja</strong> </td>
    <td width="118" align="right" bgcolor="#CCCCCC"><strong>Total Bayar(Rp) </strong></td>
    <td width="118" align="right" bgcolor="#CCCCCC"><strong>Uang Bayar(Rp) </strong></td>
    <td width="39" align="center" bgcolor="#CCCCCC"><b>View</b></td>
    <td width="45" align="center" bgcolor="#CCCCCC"><b>Validasi Bayar</b></td>
  </tr>
<?php
	# Perintah untuk menampilkan Semua Daftar Transaksi Penjualan
	$mySql = "SELECT * FROM penjualan ORDER BY no_penjualan DESC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor  = 0;
	while ($kolomData = mysql_fetch_array($myQry)) {
		$nomor++;

		# Membaca Kode Penjualan/ Nomor transaksi
		$noNota = $kolomData['no_penjualan'];

		# Menghitung Total penjualan setiap transaksi
		$my2Sql = "SELECT SUM(harga * jumlah) as subtotal FROM penjualan_item WHERE no_penjualan='$noNota'";
		$my2Qry = mysql_query($my2Sql, $koneksidb)  or die ("Query 2 salah : ".mysql_error());
		$kolom2Data = mysql_fetch_array($my2Qry);
//mulai dari sini


//sele

?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo IndonesiaTgl($kolomData['tgl_penjualan']); ?></td>
    <td><?php echo $kolomData['no_penjualan']; ?></td>
    <td><?php echo $kolomData['pelanggan']; ?></td>
    <td><?php echo $kolomData['nomor_meja']; ?></td>
    <td align="right"><?php echo format_angka($kolom2Data['subtotal']); ?></td>
    <td align="right"><?php echo format_angka($kolomData['uang_bayar']); ?></td>
    <td align="center"><a href="transaksi_penjualan_view.php?noNota=<?php echo $noNota; ?>" target="_blank"><img src="images/btn_view.png" width="20" height="20" border="0" /></a></td>
<?php if ($kolomData['uang_bayar']<$kolom2Data['subtotal']) {
 ?>
    <td align="center"><a href="index.php?page=ValidasiBayar&no_penjualan=<?php echo $kolomData['no_penjualan'];?>&uang=<?php echo $kolom2Data['subtotal'];?>"><img src="images/pay.png" width="20" height="20" border="0" /></a></td>
<?php } ?>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3"><b>Jumlah Data :</b> <?php echo $jml; ?></td>
    <td colspan="4" align="right"><b>Halaman ke :</b>
      <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Laporan-Penjualan&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>
