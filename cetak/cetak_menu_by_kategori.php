<?php
session_start();
include_once "../library/inc.seslogin.php";
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

if($_GET) {
	if(isset($_GET['Format'])=="XLS") {
		$tanggal=date('d-m-Y');
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=Report_Menu_by_Kategori.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
	}
	
	// Baca variabel URL browser
	$kodeKategori = isset($_GET['kodeKategori']) ? $_GET['kodeKategori'] : '';
	
	// Menampilkan Nama Kategori
	$mySql		= "SELECT * FROM kategori WHERE kd_kategori='$kodeKategori'";
	$myQry 		= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$kolomData = mysql_fetch_array($myQry);
}
?>
<html>
<head>
<title> APLIKASI RUMAH MAKAN </title>
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
<h2> DAFTAR MENU <?php echo strtoupper($kolomData['nm_kategori']); ?></h2>
<table class="table-list" width="600" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="28" bgcolor="#CCCCCC"><b>No</b></td>
    <td width="421" bgcolor="#CCCCCC"><b>Nama Menu </b></td>
    <td width="135" align="right" bgcolor="#CCCCCC"><b>Harga (Rp) </b></td>
  </tr>
  <?php
	# MENJALANKAN QUERY
	if(trim($kodeKategori)=="ALL") {
		//Query #1 (all)
		$my2Sql 	= "SELECT * FROM menu ORDER BY kd_kategori, nm_menu ASC";
	}
	else {
		//Query #2 (filter)
		$my2Sql 	= "SELECT * FROM menu WHERE kd_kategori='$kodeKategori' ORDER BY kd_kategori, nm_menu ASC";
	}
	
	$my2Qry 	= mysql_query($my2Sql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($kolom2Data = mysql_fetch_array($my2Qry)) {
		$nomor++;
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $kolom2Data['nm_menu']; ?></td>
    <td align="right">Rp. <b><?php echo format_angka($kolom2Data['harga']); ?></b></td>
  </tr>
  <?php } ?>
</table>
<img src="../images/btn_print.png" width="40" height="44" onClick="javascript:window.print()" />
</body>
</html>