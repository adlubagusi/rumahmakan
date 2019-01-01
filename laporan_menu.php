<?php
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 30;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM menu";
$pageQry = mysql_query($pageSql, $koneksidb) or die("error paging:".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<h2>DAFTAR MENU</h2>
<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="25" bgcolor="#CCCCCC"><b>No</b></td>
    <td width="200" bgcolor="#CCCCCC"><strong>Kategori</strong></td>
    <td width="80" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="283" bgcolor="#CCCCCC"><b>Nama Menu </b></td>
    <td width="86" align="right" bgcolor="#CCCCCC"><b>Harga (Rp) </b></td>
  </tr>
  <?php
	# MENJALANKAN QUERY
	$mySql 	= "SELECT menu.*, kategori.nm_kategori FROM menu, kategori
				WHERE menu.kd_kategori=kategori.kd_kategori 
				ORDER BY menu.kd_kategori, menu.nm_menu ASC LIMIT $hal, $row";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = $hal; 
	while ($kolomData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $kolomData['kd_menu'];
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $kolomData['nm_kategori']; ?></td>
    <td><?php echo $kolomData['kd_menu']; ?></td>
    <td><?php echo $kolomData['nm_menu']; ?></td>
    <td align="right">Rp. <b><?php echo format_angka($kolomData['harga']); ?></b></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="2"><b>Jumlah Data :</b> <?php echo $jml; ?> </td>
    <td colspan="3" align="right"><b>Halaman ke :</b>
    <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Laporan-Menu&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>
<br />
<table width="100" border="0" cellspacing="2" cellpadding="4">
  <tr>
    <td align="center"><a href="cetak/cetak_menu.php?Format=XLS" target="_blank"><img src="images/xls_icon.png" width="55" height="18" border="0" title="Cetak ke Format HTML Excel"/></a></td>
    <td align="center"><a href="cetak/cetak_menu.php" target="_blank"><img src="images/html_icon.png" width="55" height="18" border="0" title="Cetak ke Format HTML"/></a></td>
  </tr>
</table>
