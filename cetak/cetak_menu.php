<?php
	session_start();
	include_once "../library/inc.seslogin.php";
	include_once "../library/inc.connection.php";
	include_once "../library/inc.library.php";

	if($_GET) {
		if(isset($_GET['Format'])=="XLS") {
			$tanggal=date('d-m-Y');
			header("Content-type: application/x-msdownload");
			header("Content-Disposition: attachment; filename=Report_Menu.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
		}
	}
?>
<html>
<head>
<title> :: APLIKASI RUMAH MAKAN </title>
<style type="text/css">
<!--
body{
	margin:0px auto 0px;
	padding:3px;
	font-family:"Arial";
	font-size:12px;
	color:#333;
	width:95%;
	background-position:top;
	background-color:#fff;
}
.table-list {
	clear: both;
	text-align: left;
	border-collapse: collapse;
	margin: 0px 0px 10px 0px;
	background:#fff;	
}
.table-list td {
	color: #333;
	font-size:12px;
	border-color: #fff;
	border-collapse: collapse;
	vertical-align: center;
	padding: 3px 5px;
	border-bottom:1px #CCCCCC solid;
}
-->
</style>
</head>
<body>
<h2> DAFTAR MENU</h2>
<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="30" bgcolor="#CCCCCC"><b>No</b></td>
    <td width="206" bgcolor="#CCCCCC"><strong>Kategori</strong></td>
    <td width="86" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="264" bgcolor="#CCCCCC"><b>Nama Menu </b></td>
    <td width="88" align="right" bgcolor="#CCCCCC"><b>Harga (Rp) </b></td>
  </tr>
  <?php
	# MENJALANKAN QUERY
	$mySql 	= "SELECT menu.*, kategori.nm_kategori FROM menu, kategori
				WHERE menu.kd_kategori=kategori.kd_kategori 
				ORDER BY menu.kd_kategori, menu.nm_menu ASC";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($kolomData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $kolomData['nm_kategori']; ?></td>
    <td><?php echo $kolomData['kd_menu']; ?></td>
    <td><?php echo $kolomData['nm_menu']; ?></td>
    <td align="right">Rp. <b><?php echo format_angka($kolomData['harga']); ?></b></td>
  </tr>
  <?php } ?>
</table>
<img src="../images/btn_print.png" width="40" height="44" onClick="javascript:window.print()" />
</body>
</html>