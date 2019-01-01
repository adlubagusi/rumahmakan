<?php
if($_GET) {
	if(isset($_POST['btnLogin'])){
		$pesanError = array();
		if ( trim($_POST['txtUser'])=="") {
			$pesanError[] = "Data <b> User ID </b>  tidak boleh kosong !";
		}
		if (trim($_POST['txtPassword'])=="") {
			$pesanError[] = "Data <b> Password </b> tidak boleh kosong !";
		}
		if (trim($_POST['cmbLevel'])=="BLANK") {
			$pesanError[] = "Data <b>Level</b> belum dipilih !";
		}

		# Baca variabel form
		$txtUser 	= $_POST['txtUser'];
		$txtUser 	= str_replace("'","&acute;",$txtUser);

		$txtPassword=$_POST['txtPassword'];
		$txtPassword= str_replace("'","&acute;",$txtPassword);

		$cmbLevel	=$_POST['cmbLevel'];

		# JIKA ADA PESAN ERROR DARI VALIDASI
		if (count($pesanError)>=1 ){
            echo "<div class='mssgBox'>";
			echo "<img src='images/attention.png'> <br><hr>";
				$noPesan=0;
				foreach ($pesanError as $indeks=>$pesan_tampil) {
				$noPesan++;
					echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
				}
			echo "</div> <br>";

			// Tampilkan lagi form login
			include "login.php";
		}
		else {
			# LOGIN CEK KE TABEL USER LOGIN
			$loginSql = "SELECT * FROM user WHERE username='".$txtUser."'
						AND password='".md5($txtPassword)."' AND level='$cmbLevel'";
			$loginQry = mysql_query($loginSql, $koneksidb)
						or die ("Query Salah : ".mysql_error());

			# JIKA LOGIN SUKSES
			if($loginQry){
				if (mysql_num_rows($loginQry) >=1) {
					$loginData = mysql_fetch_array($loginQry);
					$_SESSION['SES_LOGIN'] = $loginData['kd_user'];
					$_SESSION['SES_USER'] = $loginData['username'];

					// Jika yang login Administrator
					if($cmbLevel=="Admin") {
						$_SESSION['SES_ADMIN'] = "Admin";
					}

					// Jika yang login Kasir
					if($cmbLevel=="Kasir") {
						$_SESSION['SES_KASIR'] = "Kasir";
					}

					if($cmbLevel=="Meja") {
						$_SESSION['SES_MEJA'] = "Meja";
					}

					if($cmbLevel=="Koki") {
						$_SESSION['SES_KOKI'] = "Meja";
					}
					// Refresh
					echo "<meta http-equiv='refresh' content='0; url=?page=Halaman-Utama'>";
				}
				else {
					 echo "Login Anda bukan ".$_POST['cmbLevel'];
				}
			}
		}
	} // End POST
} // End GET
?>
