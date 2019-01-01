<?php
include_once "library/inc.seslogin.php";

if($_GET) {
	// Baca variabel URL browser
	$kodeKategori = isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : 'ALL';
}
?>

<h2> LAPORAN MENU RESTO </h2>
<form action="?page=Laporan-Menu-by-Kategori" method="post" name="form1" target="_self">
  <b>Filter Kategori  : </b>
  <select name="cmbKategori">
    <option value="ALL">- ALL -</option>
    <?php
	  $mySql = "SELECT * FROM kategori ORDER BY kd_kategori";
	  $myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($kolomData = mysql_fetch_array($myQry)) {
	  	if ($kodeKategori == $kolomData['kd_kategori']) {
			$cek = " selected";
		} else { $cek=""; }
	  	echo "<option value='$kolomData[kd_kategori]' $cek>$kolomData[nm_kategori]</option>";
	  }
	  $mySql ="";
	  ?>
  </select>
  <input name="btnFilter" type="submit" value=" Filter " />
</form>
<table class="table-list" width="600" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="24" bgcolor="#CCCCCC"><b>No</b></td>
    <td width="70" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="385" bgcolor="#CCCCCC"><b>Nama Menu </b></td>
    <td width="100" align="right" bgcolor="#CCCCCC"><b>Harga (Rp) </b></td>
  </tr>
  <?php
	  # PENCARIAN DATA BERDASARKAN FILTER DATA (Kode Type Kamar)
	if(isset($_POST['btnFilter'])) {
		if (trim($_POST['cmbKategori'])=="ALL") {
			//Query #1 (all)
			$mySql 	= "SELECT * FROM menu ORDER BY kd_kategori, nm_menu";
		}
		else {
			//Query #2 (filter)
			$mySql 	= "SELECT * FROM menu WHERE kd_kategori ='$kodeKategori' ORDER BY kd_kategori, nm_menu";
		}
	}
	else {
		//Query #1 (all)
		$mySql 	= "SELECT * FROM menu ORDER BY kd_kategori, nm_menu";
	}

	# MENJALANKAN QUERY FILTER DI ATAS
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($kolomData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $kolomData['kd_menu'];
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $kolomData['kd_menu']; ?></td>
    <td><?php echo $kolomData['nm_menu']; ?></td>
    <td align="right">Rp. <b><?php echo format_angka($kolomData['harga']); ?></b></td>
  </tr>
  <?php } ?>
</table>
<br />
<table width="100" border="0" cellspacing="2" cellpadding="4">
  <tr>
    <td align="center"><a href="cetak/cetak_menu_by_kategori.php?Format=XLS&kodeKategori=<?php echo $kodeKategori; ?>" target="_blank"><img src="images/xls_icon.png" width="55" height="18" border="0" title="Cetak ke Format HTML Excel"/></a></td>
    <td align="center"><a href="cetak/cetak_menu_by_kategori.php?kodeKategori=<?php echo $kodeKategori; ?>" target="_blank"><img src="images/html_icon.png" width="55" height="18" border="0" title="Cetak ke Format HTML"/></a></td>
  </tr>
</table>