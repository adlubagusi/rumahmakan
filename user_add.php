<?php
include_once "library/inc.seslogin.php";

if($_GET) {
	if(isset($_POST['btnSave'])){
		# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
		$pesanError = array();
		if (trim($_POST['txtNamaUser'])=="") {
			$pesanError[] = "Data <b>Nama User</b> tidak boleh kosong !";
		}
		if (trim($_POST['txtTelpon'])=="") {
			$pesanError[] = "Data <b>Telpon</b> tidak boleh kosong !";
		}
		if (trim($_POST['txtUsername'])=="") {
			$pesanError[] = "Data <b>Username</b> tidak boleh kosong !";
		}
		if (trim($_POST['txtPassword'])=="") {
			$pesanError[] = "Data <b>Password</b> tidak boleh kosong !";
		}
		if (trim($_POST['cmbLevel'])=="BLANK") {
			$pesanError[] = "Data <b>Level login</b> belum dipilih !";
		}


		# BACA DATA DALAM FORM, masukkan datake variabel
		$txtNamaUser= $_POST['txtNamaUser'];
		$txtUsername= $_POST['txtUsername'];
		$txtPassword= $_POST['txtPassword'];
		$txtTelpon	= $_POST['txtTelpon'];
		$cmbLevel	= $_POST['cmbLevel'];

		# VALIDASI NAMA, jika sudah ada akan ditolak
		$cekSql="SELECT * FROM user WHERE nm_user='$txtNamaUser'";
		$cekQry=mysql_query($cekSql, $koneksidb) or die ("Eror Query".mysql_error());
		if(mysql_num_rows($cekQry)>=1){
			$pesanError[] = "Maaf, user <b> $txtNamaUser </b> sudah ada, ganti dengan yang lain";
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
			# SIMPAN DATA KE DATABASE.
			// Jika tidak menemukan error, simpan data ke database
			$kodeBaru	= buatKode("user", "U");
			$mySql  	= "INSERT INTO user (kd_user, nm_user, no_telepon,
											 username, password, level)
							VALUES ('$kodeBaru',
									'$txtNamaUser',
									'$txtTelpon',
									'$txtUsername',
									'$txtPassword',
									'$cmbLevel')";
			$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
			if($myQry){
				echo "<meta http-equiv='refresh' content='0; url=?page=User-Data'>";
			}
			exit;
		}
	} // Penutup POST

	# MASUKKAN DATA KE VARIABEL
	// Supaya saat ada pesan error, data di dalam form tidak hilang. Jadi, tinggal meneruskan/memperbaiki yg salah
	$dataKode	= buatKode("user", "U");
	$dataNamaUser	= isset($_POST['txtNamaUser']) ? $_POST['txtNamaUser'] : '';
	$dataUsername	= isset($_POST['txtUsername']) ? $_POST['txtUsername'] : '';
	$dataPassword	= isset($_POST['txtPassword']) ? $_POST['txtPassword'] : '';
	$dataTelpon	= isset($_POST['txtTelpon']) ? $_POST['txtTelpon'] : '';
	$dataLevel	= isset($_POST['cmbLevel']) ? $_POST['cmbLevel'] : '';
} // Penutup GET
?>

<form action="?page=User-Add" method="post" name="form1" target="_self">
  <table width="700" class="table-list" border="0" cellspacing="1" cellpadding="4">
    <tr>
      <th colspan="3"><b>[ TAMBAH ] USER SYSTEM </b></th>
    </tr>
    <tr>
      <td width="133"><b>Kode</b></td>
      <td width="3"><b>:</b></td>
      <td width="536"> <input name="textfield" type="text" value="<?php echo $dataKode; ?>" size="10" maxlength="6" readonly="readonly"/></td>
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
      <td> <input name="txtUsername" type="text"  value="<?php echo $dataUsername; ?>" size="60" maxlength="20" /></td>
    </tr>
    <tr>
      <td><b>Password</b></td>
      <td><b>:</b></td>
      <td><input name="txtPassword" type="password" value="<?php echo $dataPassword; ?>" size="60" maxlength="100" /></td>
    </tr>
    <tr>
      <td><b>Level</b></td>
      <td><b>:</b></td>
      <td><b>
        <select name="cmbLevel">
          <option value="BLANK">....</option>
          <?php
		  $pilihan	= array("Kasir", "Admin");
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
        <input type="submit" name="btnSave" value=" Simpan " />      </td>
    </tr>
  </table>
</form>
