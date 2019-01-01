<?php
include_once "library/inc.seslogin.php";
?>
<h2> DAFTAR SUPPLIER </h2>
<table class="table-list" width="600" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="29" align="center" bgcolor="#CCCCCC"><b>No</b></td>
    <td width="173" bgcolor="#CCCCCC"><b>Nama Supplier </b></td>
    <td width="282" bgcolor="#CCCCCC"><b>Alamat Lengkap </b> </td>  
    <td width="95" bgcolor="#CCCCCC"><strong>No Telepon </strong></td>
  </tr>
<?php
	$mySql = "SELECT * FROM supplier ORDER BY kd_supplier ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($kolomData = mysql_fetch_array($myQry)) {
	$nomor++;
?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $kolomData['nm_supplier']; ?></td>
    <td><?php echo $kolomData['alamat']; ?></td>
    <td><?php echo $kolomData['no_telepon']; ?></td>
  </tr>
  <?php } ?>
</table>
<br />
<table width="100" border="0" cellspacing="2" cellpadding="4">
  <tr>
    <td align="center"><a href="cetak/cetak_supplier.php?Format=XLS" target="_blank"><img src="images/xls_icon.png" width="55" height="18" border="0" title="Cetak ke Format HTML Excel"/></a></td>
    <td align="center"><a href="cetak/cetak_supplier.php?kodeKategori=<?php echo $kodeKategori; ?>" target="_blank"><img src="images/html_icon.png" width="55" height="18" border="0" title="Cetak ke Format HTML"/></a></td>
  </tr>
</table>