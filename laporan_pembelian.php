<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pembelian";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<h2>DATA PEMBELIAN KE SUPPLIER</h2>
<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="32" align="center" bgcolor="#CCCCCC"><b>No</b></td>
    <td width="90" bgcolor="#CCCCCC"><b>Tanggal</b></td>
    <td width="121" bgcolor="#CCCCCC"><b>Nomor Transaksi</b></td>  
    <td width="246" bgcolor="#CCCCCC"><b>Supplier </b></td>
    <td width="130" align="right" bgcolor="#CCCCCC"><strong>Total Belanja (Rp) </strong></td>
    <td width="50" align="center" bgcolor="#CCCCCC"><b>View</b></td>
  </tr>
<?php
	# Perintah untuk menampilkan Semua Daftar Transaksi Pembelian
	$mySql = "SELECT pembelian.*, supplier.nm_supplier FROM pembelian, supplier 
				WHERE pembelian.kd_supplier=supplier.kd_supplier 
				ORDER BY pembelian.no_pembelian ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query pembelian salah : ".mysql_error());
	$nomor  = 0; 
	while ($myRow = mysql_fetch_array($myQry)) {
		$nomor++;
		
		# Membaca Kode Pembelian/ Nomor transaksi
		$noNota = $myRow['no_pembelian'];
		
		# Menghitung Total Pembelian (belanja) setiap nomor transaksi
		$my2Sql = "SELECT SUM(harga * jumlah) as subtotal FROM pembelian_item WHERE no_pembelian='$noNota'";
		$my2Qry = mysql_query($my2Sql, $koneksidb)  or die ("Query 2 salah : ".mysql_error());
		$kolom2Data = mysql_fetch_array($my2Qry);
?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo IndonesiaTgl($myRow['tgl_pembelian']); ?></td>
    <td><?php echo $myRow['no_pembelian']; ?></td>
    <td><?php echo $myRow['nm_supplier']; ?></td>
    <td align="right"><?php echo format_angka($kolom2Data['subtotal']); ?></td>
    <td align="center"><a href="transaksi_pembelian_view.php?noNota=<?php echo $noNota; ?>" target="_blank"><img src="images/btn_view.png" width="20" height="20" border="0" /></a></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3"><b>Jumlah Data :</b> <?php echo $jml; ?></td>
    <td colspan="3" align="right"><b>Halaman ke :</b>
      <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Laporan-Pembelian&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table> 
