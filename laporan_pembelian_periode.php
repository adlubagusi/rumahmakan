<?php
include_once "library/inc.seslogin.php";

$SqlPeriode = ""; $startTgl=""; $endTgl="";

# Set Tanggal skrg
$tglStart 	= isset($_POST['cmbTglStart']) ? $_POST['cmbTglStart'] : date('d-m-Y');
$tglEnd 	= isset($_POST['cmbTglEnd']) ? $_POST['cmbTglEnd'] : date('d-m-Y');

# Jika Nomor Page (halaman) diklik
if($_GET) {
	if (isset($_POST['btnShow'])) {
		$SqlPeriode = "( tgl_pembelian BETWEEN '".InggrisTgl($_POST['cmbTglStart'])."' AND '".InggrisTgl($_POST['cmbTglEnd'])."')";
	}
	else {
		$startTgl 	= isset($_GET['startTgl']) ? $_GET['startTgl'] : $tglStart;
		$endTgl 	= isset($_GET['endTgl']) ? $_GET['endTgl'] : $tglEnd; 
		$SqlPeriode = " ( tgl_pembelian BETWEEN '".InggrisTgl($startTgl)."' AND '".InggrisTgl($endTgl)."')";
	}
}

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 20;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pembelian WHERE $SqlPeriode";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<h2>LAPORAN PEMBELIAN PERIODE </h2>
<form action="?page=Laporan-Pembelian-Periode" method="post" name="form1" target="_self" id="form1">
  <table width="500" border="0"  class="table-list">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>PERIODE TANGGAL </strong></td>
    </tr>
    <tr>
      <td width="90"><strong>Periode </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="391"><?php echo form_tanggal("cmbTglStart",$tglStart); ?> s/d <?php echo form_tanggal("cmbTglEnd",$tglEnd); ?>
      <input name="btnShow" type="submit" value=" Tampilkan " /></td>
    </tr>
  </table>
</form>

Daftar Pembelian dari tanggal <b><?php echo $tglStart; ?></b> s/d <b><?php echo $tglEnd; ?></b><br /><br />

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
				WHERE pembelian.kd_supplier=supplier.kd_supplier AND $SqlPeriode
				ORDER BY pembelian.no_pembelian ASC";
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
</table> 
