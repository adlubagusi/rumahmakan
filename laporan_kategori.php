<?php
include_once "library/inc.seslogin.php";
?>
<h2> DAFTAR KATEGORI </h2>
<table class="table-list" width="600" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="31" align="center" bgcolor="#CCCCCC"><b>No</b></td>
    <td width="366" bgcolor="#CCCCCC"><b>Nama Kategori </b></td>
    <td width="84" align="center" bgcolor="#CCCCCC"><b>Qty Menu </b> </td>  
  </tr>
  <?php
	  // Menampilkan daftar kategori
	$mySql = "SELECT * FROM kategori ORDER BY kd_kategori ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query kategori salah : ".mysql_error());
	$nomor  = 0; 
	while ($kolomData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $kolomData['kd_kategori'];
		
		// Menghitung jumlah menu per Kategori
		$my2Sql = "SELECT COUNT(*) As qty_menu FROM menu WHERE kd_kategori='$Kode'";
		$my2Qry = mysql_query($my2Sql, $koneksidb)  or die ("Query salah : ".mysql_error());
		$kolom2Data = mysql_fetch_array($my2Qry);
  ?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $kolomData['nm_kategori']; ?></td>
    <td align="center"><?php echo $kolom2Data['qty_menu']; ?></td>
  </tr>
  <?php } ?>
</table>