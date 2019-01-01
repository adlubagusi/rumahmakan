<?php
if(isset($_SESSION['SES_ADMIN'])){
# JIKA YANG LOGIN LEVEL ADMIN, menu di bawah yang dijalankan
?>
<ul>
	<li><a href='?page' title='Halaman Utama'><img src="images/home.png" width="30px" height="30px" alt="">Home</a></li>
	<li><a href='?page=User-Data' title='User Login'><img src="images/hire-me.png" width="30px" height="30px" alt="">Data User</a></li>
	<!--<li><a href='?page=Supplier-Data' title='Supplier'>Data Supplier</a></li>-->
	<li><a href='?page=Kategori-Data' title='Data Kategori'><img src="images/kategori.png" width="30px" height="30px" alt="">Data Kategori</a></li>
	<li><a href='?page=Menu-Data' title='Menu'><img src="images/menu.png" width="30px" height="30px" alt="">Data Menu</a></li>
	<!--<li><a href='?page=Pemesanan-Add' title='Pemesanan'>Pemesanan Tempat</a></li>-->
	<!--<li><a href='?page=Transaksi-Pembelian' title='Transaksi Pembelian' target='_blank'>Transaksi Pembelian</a> </li>-->
	<li><a href='?page=Transaksi-Penjualan' title='Transaksi Penjualan' target='_blank'><img src="images/communication.png" width="30px" height="30px" alt=""> Transaksi Penjualan</a></li>
	<li><a href='?page=Laporan' title='Laporan'><img src="images/laporan.png" width="30px" height="30px" alt="">Laporan</a></li>
	<li><a href='?page=Logout' title='Logout (Exit)'><img src="images/sign-out.png" width="30px" height="30px" alt="">Logout</a></li>
</ul>
<?php
}
elseif(isset($_SESSION['SES_KASIR'])){
# JIKA YANG LOGIN LEVEL KASIR, menu di bawah yang dijalankan
?>
<ul>
	<li><a href='?page' title='Halaman Utama'><img src="images/home.png" width="30px" height="30px" alt="">Home</a></li>
	<li><a href="?page=Bill-Penjualan"><img src="images/bill.png" width="30px" height="30px" alt="">Bill Pesanan</a></li>
	<!--<li><a href='?page=Pemesanan-Add' title='Pemesanan'>Pemesanan Tempat</a></li>-->
	<!--<li><a href='?page=Transaksi-Pembelian' title='Transaksi Pembelian' target='_blank'>Transaksi Pembelian</a></li>-->
	<li><a href='?page=Transaksi-Penjualan' title='Transaksi Penjualan' target='_blank'><img src="images/communication.png" width="30px" height="30px" alt="">Transaksi Penjualan</a></li>
	<li><a href='?page=Logout' title='Logout (Exit)'><img src="images/sign-out.png" width="30px" height="30px" alt="">Logout</a></li>
</ul>
<?php
}elseif (isset($_SESSION['SES_MEJA'])) {
	?>
	<ul>
		<li valign="center"><a href='?page=Pesan-Menu' title='Pesan Menu' target='_blank'><img src="images/btn_edit.png" width="30px" height="30px" alt="">Pesan Menu</a></li>
		<li><a href='?page=Logout' title='Logout (Exit)'><img src="images/sign-out.png" width="30px" height="30px" alt="">Logout</a></li>
	</ul>
	<?php
}elseif (isset($_SESSION['SES_KOKI'])) {
	?>
	<ul>
		<li><a href="?page=Antrian-Menu-Koki"><img src="images/bill.png" width="30px" height="30px" alt="">Pesanan Menu</a></li>
		<li><a href='?page=Logout' title='Logout (Exit)'><img src="images/sign-out.png" width="30px" height="30px" alt="">Logout</a></li>
	</ul>
	<?php
}else {
# JIKA BELUM LOGIN (BELUM ADA SESION LEVEL YG DIBACA)
?>
<ul>
	<li><a href='?page=Login' title='Login System'><img src="images/login.png" width="30px" height="30px" alt="">Login</a></li>
</ul>
<?php
}
?>
