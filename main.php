<?php
if(isset($_SESSION['SES_ADMIN'])) {
	echo "<h2 style='margin:-5px 0px 5px 0px; padding:0px;'>Selamat datang ........!</h2></p>";
	echo "<b> Anda login sebagai Admin";
	exit;
}
else if(isset($_SESSION['SES_KASIR'])) {
	echo "<h2 style='margin:-5px 0px 5px 0px; padding:0px;'>Selamat datang ........!</h2></p>";
	echo "<b> Anda login sebagai Kasir";
	include "login_info.php";
	exit;
}
else if(isset($_SESSION['SES_MEJA'])) {
	echo "<h2 style='margin:-5px 0px 5px 0px; padding:0px;'>Selamat datang ........!</h2></p>";
	echo "<b> Anda login sebagai Pelanggan";
	include "login_info.php";
	exit;
}
else if(isset($_SESSION['SES_KOKI'])) {
	echo "<h2 style='margin:-5px 0px 5px 0px; padding:0px;'>Selamat datang ........!</h2></p>";
	echo "<b> Anda login sebagai Koki";
	include "login_info.php";
	exit;
}
else {
			include 'login.php';
	//echo "<h2 style='margin:-5px 0px 5px 0px; padding:0px;'>Selamat datang ........!</h2></p>";
	//echo "<b>Anda belum login, silahkan <a href='?page=Login' alt='Login'>login </a>untuk mengakses sitem ini ";
}
?>
