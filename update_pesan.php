<?php
      include 'library/inc.connection.php';
      $sql1 = mysql_query("SELECT * FROM penjualan WHERE no_penjualan ='$_GET[no_penjualan]'");
      $bc1  = mysql_fetch_array($sql1);
      if ($bc1['stts_pesan']=='Belum Dimasak') {
        $stts_pesan="Sudah Dimasak";
      }elseif ($bc1['stts_pesan']=='Sudah Dimasak') {
        $stts_pesan="Belum Dimasak";
      }
      mysql_query("UPDATE penjualan SET stts_pesan='$stts_pesan' WHERE no_penjualan='$_GET[no_penjualan]'");
      ?>
          <script type="text/javascript">
            window.location.href="index.php?page=Antrian-Menu-Koki";
          </script>
      <?php
 ?>
