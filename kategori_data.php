<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 20;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM kategori";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<table width="700" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2" align="right"><h1><b>DATA KATEGORI</b></h1></td>
  </tr>
  <tr>
    <td colspan="2"><a href="?page=Kategori-Add" target="_self"><img src="images/btn_add_data.png" border="0" /></a></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="32" align="center"><b>No</b></th>
        <th width="444"><b>Nama Kategori </b></th>
        <th width="93" align="center"><b>Qty Menu </b> </th>
        <td width="47" align="center" bgcolor="#CCCCCC"><b>Edit</b></td>
        <td width="52" align="center" bgcolor="#CCCCCC"><b>Delete</b></td>
      </tr>
      <?php
	  // Menampilkan daftar kategori
	$mySql = "SELECT * FROM kategori ORDER BY kd_kategori ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
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
        <td align="center">
		     <a href="?page=Kategori-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">
		     <img src="images/btn_edit.png" width="20" height="20" border="0" /></a></td>
        <td align="center">
		      <a href="?page=Kategori-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')">
			  <img src="images/btn_delete.png" width="20" height="20"  border="0"  alt="Delete Data" /></a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td><b>Jumlah Data :</b> <?php echo $jml; ?> </td>
    <td align="right"> <b>Halaman ke :</b> 
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Kategori-Data&hal=$list[$h]'>$h</a> ";
	}
	?>
	</td>
  </tr>
</table>
