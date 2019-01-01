<?php
include_once "library/inc.seslogin.php";

if($_GET) {
	if(isset($_POST['btnSave'])){
		# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
		$pesanError = array();
		if (trim($_POST['txtKode'])=="") {
			$pesanError[] = "Data <b>Kode User </b> tidak terbaca !";
		}
		if (trim($_POST['txtNamaUser'])=="") {
			$pesanError[] = "Data <b>Nama User</b> tidak boleh kosong !";
		}
		if (trim($_POST['txtTelpon'])=="") {
			$pesanError[] = "Data <b>Telpon</b> tidak boleh kosong !";
		}
		if (trim($_POST['txtUsername'])=="") {
			$pesanError[] = "Data <b>Username</b> tidak boleh kosong !";
		}
		if (trim($_POST['cmbLevel'])=="BLANK") {
			$pesanError[] = "Data <b>Level login</b> belum dipilih !";
		}


		# BACA DATA DALAM FORM, masukkan datake variabel
		$txtNamaUser= $_POST['txtNamaUser'];
		$txtUsername= $_POST['txtUsername'];
		$txtPassword= $_POST['txtPassword'];
		$txtPassLama= $_POST['txtPassLama'];
		$txtTelpon	= $_POST['txtTelpon'];
		$cmbLevel	= $_POST['cmbLevel'];

		# VALIDASI NAMA, jika sudah ada akan ditolak
		$cekSql="SELECT * FROM user WHERE username='$txtUsername' AND NOT(username='".$_POST['txtUsernameLm']."')";
		$cekQry=mysql_query($cekSql, $koneksidb) or die ("Eror Query".mysql_error());
		if(mysql_num_rows($cekQry)>=1){
			$pesanError[] = "Maaf, Username <b> $txtUsername </b> sudah ada, ganti dengan yang lain";
		}

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
		}
		else {
			# Cek Password baru
			if (trim($txtPassword)=="") {
				$sqlSub = " password='$txtPassLama'";
			}
			else {
				$sqlSub = "  password ='".md5($txtPassword)."'";
			}

			# SIMPAN DATA KE DATABASE.
			// Jika tidak menemukan error, simpan data ke database
			$mySql  = "UPDATE user SET nm_user='$txtNamaUser', username='$txtUsername',
					 	no_telepon='$txtTelpon', level='$cmbLevel', $sqlSub  WHERE kd_user='".$_POST['txtKode']."'";
			$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
			if($myQry){
				echo "<meta http-equiv='refresh' content='0; url=?page=User-Data'>";
			}
			exit;
		}
	} // Penutup POST


	# TAMPILKAN DATA DARI DATABASE, Untuk ditampilkan kembali ke form edit
	$Kode= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode'];
	$mySql = "SELECT * FROM user WHERE kd_user='$Kode'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
	while($kolomData = mysql_fetch_array($myQry)) {
		$dataKode		= $kolomData['kd_user'];
		$dataNamaUser	= isset($kolomData['nm_user']) ?  $kolomData['nm_user'] : $_POST['txtNamaUser'];
		$dataUsername	= isset($kolomData['username']) ?  $kolomData['username'] : $_POST['txtUsername'];
		$dataUsernameLm	= $kolomData['username'];
		$dataPassword	= isset($kolomData['password']) ?  $kolomData['password'] : $_POST['txtPassword'];
		$dataTelpon	= isset($kolomData['no_telepon']) ?  $kolomData['no_telepon'] : $_POST['txtTelpon'];
		$dataLevel	= isset($kolomData['level']) ?  $kolomData['level'] : $_POST['cmbLevel'];
	}
} // Penutup GET
?>

<form action="?page=User-Edit" method="post" name="form1" target="_self">
  <table width="700" class="table-list" border="0" cellspacing="1" cellpadding="4">
    <tr>
      <th colspan="3"><b>[ UBAH ] USER SYSTEM </b></th>
    </tr>
    <tr>
      <td width="133"><b>Kode</b></td>
      <td width="3"><b>:</b></td>
      <td width="536"> <input name="textfield" type="text"  value="<?php echo $dataKode; ?>" size="10" maxlength="5"  readonly="readonly"/>
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td>
    </tr>
    <tr>
      <td><b>Nama Lengkap </b></td>
      <td><b>:</b></td>
      <td><input name="txtNamaUser" type="text" value="<?php echo $dataNamaUser; ?>" size="60" maxlength="100" /></td>
    </tr>
    <tr>
      <td><b>No. Telepon </b></td>
      <td><b>:</b></td>
      <td><input name="txtTelpon" type="text" value="<?php echo $dataTelpon; ?>" size="60" maxlength="20" /></td>
    </tr>
    <tr>
      <td><b>Username</b></td>
      <td><b>:</b></td>
      <td><input name="txtUsername" type="text"  value="<?php echo $dataUsername; ?>" size="60" maxlength="20" />
      <input name="txtUsernameLm" type="hidden" value="<?php echo $dataUsernameLm; ?>" /></td>
    </tr>
    <tr>
      <td><b>Password</b></td>
      <td><b>:</b></td>
      <td><input name="txtPassword" type="password" size="60" maxlength="100" />
      <input name="txtPassLama" type="hidden" value="<?php echo $dataPassword; ?>" /></td>
    </tr>
    <tr>
      <td><b>Level</b></td>
      <td><b>:</b></td>
      <td><b>
        <select name="cmbLevel">
          <option value="BLANK">....</option>
          <?php
		  $pilihan	= array("Kasir", "Admin", "Meja", "Koki");
          foreach ($pilihan as $nilai) {
            if ($dataLevel==$nilai) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek>$nilai</option>";
          }
          ?>
        </select>
      </b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="btnSave" value=" Simpan " /> </td>
    </tr>
  </table>
</form>
