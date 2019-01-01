<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    <table width=600px border="1">
      <tr>
        <td colspan="3" align="center"><h2>PEMBAYARAN BILL</h2></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td><b>Total Uang</b></td>
        <td>:</td>
        <td><?php echo "$_GET[uang]"; ?></td>
      </tr>
      <tr>
        <td><b>Total Bayar</b></td>
        <td>:</td>
        <td><input type="text" name="uang" value=""></td>
      </tr>
      <tr>
        <td colspan="3"><input type="submit" name="simpan" value="SIMPAN"></td>
      </tr>
    </table>
  </form>
  </body>
</html>

<?php
@$uang=$_POST['uang'];
if (isset($_POST['simpan'])) {
  include 'library/inc.connection.php';
  mysql_query("UPDATE penjualan SET uang_bayar='$uang' WHERE no_penjualan='$_GET[no_penjualan]'");
  //header('location:index.php?page=Bill-Penjualan');
  ?>
  <script language="javascript">
window.location.href="index.php?page=Bill-Penjualan";
</script>
  <?php
}
 ?>
