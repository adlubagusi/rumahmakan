<h2> DAFTAR USER </h2>
<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="32" align="center" bgcolor="#CCCCCC"><b>No</b></td>
    <td width="276" bgcolor="#CCCCCC"><b>Nama User </b></td>
    <td width="141" bgcolor="#CCCCCC"><b>No Telepon </b></td>
    <td width="140" bgcolor="#CCCCCC"><b>Username</b></td>
    <td width="85" bgcolor="#CCCCCC"><b>Level</b></td>
  </tr>
	<?php
		$mySql 	= "SELECT * FROM user ORDER BY kd_user";
		$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
		$nomor  = 0; 
		while ($kolomData = mysql_fetch_array($myQry)) {
			$nomor++;
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $kolomData['nm_user']; ?></td>
    <td><?php echo $kolomData['no_telepon']; ?></td>
    <td><?php echo $kolomData['username']; ?></td>
    <td><?php echo $kolomData['level']; ?></td>
  </tr>
  <?php } ?>
</table>
