<?php
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus Konfirmasi
if ($module=='konfirmasi' AND $act=='hapus'){
  mysqli_query($db,"DELETE FROM konfirmasi WHERE id_konfirmasi='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
elseif ($module=='konfirmasi' AND $act=='update'){
  mysqli_query($db,"UPDATE konfirmasi SET nama_pemesan   = '$_POST[nama_pemesan]',
                              konfirmasi_selesai = '$_POST[konfirmasi_selesai]', 
             WHERE id_konfirmasi = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}

?>
