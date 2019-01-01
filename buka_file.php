<?php
# KONTROL MENU PROGRAM
if($_GET) {
	// Jika mendapatkan variabel URL ?page
	switch ($_GET['page']){
		case '' :
			if(!file_exists ("main.php")) die ("Empty Main Page!");
			include "main.php";	break;

		case 'HalamanUtama' :
			if(!file_exists ("main.php")) die ("Sorry Empty Page!");
			include "main.php";	break;

			case 'ValidasiBayar' :
				if(!file_exists ("validasi_bayar.php")) die ("Sorry Empty Page!");
				include "validasi_bayar.php";	break;

		case 'Login' :
			if(!file_exists ("login.php")) die ("Sorry Empty Page!");
			include "login.php"; break;

		case 'Login-Validasi' :
			if(!file_exists ("login_validasi.php")) die ("Sorry Empty Page!");
			include "login_validasi.php"; break;

		case 'Logout' :
			if(!file_exists ("login_out.php")) die ("Sorry Empty Page!");
			include "login_out.php"; break;

		# USER LOGIN (Admin, Directur, Kasir)
		case 'User-Data' :
			if(!file_exists ("user_data.php")) die ("Sorry Empty Page!");
			include "user_data.php";	 break;
		case 'User-Add' :
			if(!file_exists ("user_add.php")) die ("Sorry Empty Page!");
			include "user_add.php";	 break;
		case 'User-Delete' :
			if(!file_exists ("user_delete.php")) die ("Sorry Empty Page!");
			include "user_delete.php"; break;
		case 'User-Edit' :
			if(!file_exists ("user_edit.php")) die ("Sorry Empty Page!");
			include "user_edit.php"; break;

		# KATEGORI
		case 'Kategori-Data' :
			if(!file_exists ("kategori_data.php")) die ("Sorry Empty Page!");
			include "kategori_data.php"; break;
		case 'Kategori-Add' :
			if(!file_exists ("kategori_add.php")) die ("Sorry Empty Page!");
			include "kategori_add.php";	break;
		case 'Kategori-Delete' :
			if(!file_exists ("kategori_delete.php")) die ("Sorry Empty Page!");
			include "kategori_delete.php"; break;
		case 'Kategori-Edit' :
			if(!file_exists ("kategori_edit.php")) die ("Sorry Empty Page!");
			include "kategori_edit.php"; break;

		# RESTO MENU (Menu makanan restoran)
		case 'Menu-Data' :
			if(!file_exists ("menu_data.php")) die ("Sorry Empty Page!");
			include "menu_data.php"; break;
		case 'Menu-Add' :
			if(!file_exists ("menu_add.php")) die ("Sorry Empty Page!");
			include "menu_add.php"; break;
		case 'Menu-Delete' :
			if(!file_exists ("menu_delete.php")) die ("Sorry Empty Page!");
			include "menu_delete.php"; break;
		case 'Menu-Edit' :
			if(!file_exists ("menu_edit.php")) die ("Sorry Empty Page!");
			include "menu_edit.php"; break;

		# SUPPLIER
		case 'Supplier-Data' :
			if(!file_exists ("supplier_data.php")) die ("Sorry Empty Page!");
			include "supplier_data.php";	 break;
		case 'Supplier-Add' :
			if(!file_exists ("supplier_add.php")) die ("Sorry Empty Page!");
			include "supplier_add.php";	 break;
		case 'Supplier-Delete' :
			if(!file_exists ("supplier_delete.php")) die ("Sorry Empty Page!");
			include "supplier_delete.php"; break;
		case 'Supplier-Edit' :
			if(!file_exists ("supplier_edit.php")) die ("Sorry Empty Page!");
			include "supplier_edit.php"; break;

		# PEMESANAN
		case 'Pemesanan-Data' :
			if(!file_exists ("pemesanan_data.php")) die ("Sorry Empty Page!");
			include "pemesanan_data.php";	 break;
		case 'Pemesanan-Add' :
			if(!file_exists ("pemesanan_add.php")) die ("Sorry Empty Page!");
			include "pemesanan_add.php";	 break;
		case 'Pemesanan-Delete' :
			if(!file_exists ("pemesanan_delete.php")) die ("Sorry Empty Page!");
			include "pemesanan_delete.php"; break;
		case 'Pemesanan-Edit' :
			if(!file_exists ("pemesanan_edit.php")) die ("Sorry Empty Page!");
			include "pemesanan_edit.php"; break;

		# TRANSAKSI
		case 'Transaksi-Pembelian' :
			if(!file_exists ("transaksi_pembelian.php")) die ("Sorry Empty Page!");
			include "transaksi_pembelian.php"; break;
		case 'Transaksi-Penjualan' :
			if(!file_exists ("transaksi_penjualan.php")) die ("Sorry Empty Page!");
			include "transaksi_penjualan.php"; break;

		# REPORT INFORMASI / LAPORAN DATA
		case 'Laporan' :
				if(!file_exists ("menu_laporan.php")) die ("Sorry Empty Page!");
				include "menu_laporan.php"; break;

			// INFORMASI DAN LAPORAN
			case 'Laporan-User' :
				if(!file_exists ("laporan_user.php")) die ("Sorry Empty Page!");
				include "laporan_user.php"; break;

			case 'Laporan-Supplier' :
				if(!file_exists ("laporan_supplier.php")) die ("Sorry Empty Page!");
				include "laporan_supplier.php"; break;

			case 'Laporan-Kategori' :
				if(!file_exists ("laporan_kategori.php")) die ("Sorry Empty Page!");
				include "laporan_kategori.php"; break;

			case 'Laporan-Menu' :
				if(!file_exists ("laporan_menu.php")) die ("Sorry Empty Page!");
				include "laporan_menu.php"; break;

			case 'Laporan-Menu-by-Kategori' :
				if(!file_exists ("laporan_menu_by_kategori.php")) die ("Sorry Empty Page!");
				include "laporan_menu_by_kategori.php"; break;
			case 'Antrian-Menu' :
				if(!file_exists ("antrian_menu.php")) die ("Sorry Empty Page!");
				include "antrian_menu.php"; break;
			case 'Antrian-Menu-Koki' :
				if(!file_exists ("antrian_menu_koki.php")) die ("Sorry Empty Page!");
				include "antrian_menu_koki.php"; break;



			case 'Laporan-Penjualan' :
				if(!file_exists ("laporan_penjualan.php")) die ("Sorry Empty Page!");
				include "laporan_penjualan.php"; break;
				case 'Bill-Penjualan' :
					if(!file_exists ("bill_penjualan.php")) die ("Sorry Empty Page!");
					include "bill_penjualan.php"; break;
			case 'Laporan-Penjualan-Periode' :
				if(!file_exists ("laporan_penjualan_periode.php")) die ("Sorry Empty Page!");
				include "laporan_penjualan_periode.php"; break;
			case 'Laporan-Penjualan-Menu' :
				if(!file_exists ("laporan_penjualan_menu.php")) die ("Sorry Empty Page!");
				include "laporan_penjualan_menu.php"; break;

			case 'Laporan-Pembelian' :
				if(!file_exists ("laporan_pembelian.php")) die ("Sorry Empty Page!");
				include "laporan_pembelian.php"; break;
			case 'Laporan-Pembelian-Periode' :
				if(!file_exists ("laporan_pembelian_periode.php")) die ("Sorry Empty Page!");
				include "laporan_pembelian_periode.php"; break;
//pemesanan menu
			case 'Pesan-Menu' :
				if(!file_exists ("create_pesan.php")) die ("Sorry Empty Page!");
				include "create_pesan.php"; break;


		default:
			if(!file_exists ("main.php")) die ("Empty Main Page!");
			include "main.php";
		break;
	}
}
else {
	// Jika tidak mendapatkan variabel URL : ?page
	if(!file_exists ("main.php")) die ("Empty Main Page!");
	include "main.php";
}
?>
