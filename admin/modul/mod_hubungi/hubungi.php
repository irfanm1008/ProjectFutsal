<?php
$aksi="modul/mod_hubungi/aksi_hubungi.php";
switch($_GET[act]){
  // Tampil Hubungi Kami
  default:
    echo "<div class='post_title'><b>Manajemen Hubungi Kami.</b></div><br/>
		  <table width=100% cellpadding='7'>
          <tr style='color:#fff; height:35px;' bgcolor=#339900><th>No</th><th>Nama</th><th>Subjek</th><th>Pesan Customer</th><th align='center'>Action</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil=mysqli_query($db,"SELECT * FROM hubungi ORDER BY id_hubungi DESC LIMIT $posisi, $batas");

    $no = $posisi+1;
    while ($r=mysqli_fetch_array($tampil)){
      $tgl=tgl_indo($r[tanggal]);
	  if(($no % 2)==0){
			$warna="#ffffff";
		  }
		  // Apabila sisa baginya ganjil, maka warnanya kuning (#FFFF00). 
		  else{
			$warna="#fff";
		  }
      echo "<tr bgcolor=$warna><td>$no</td>
                <td><a title='$r[alamat_email] - $tgl' href=mailto:$r[alamat_email]>$r[nama_lengkap]</a></td>
                <td>$r[subjek]</td>
				<td>$r[pesan]</td>
                <td><input type=button value='Hapus' onclick=\"window.location.href='$aksi?module=hubungi&act=hapus&id=$r[id_hubungi]';\">
                </td></tr>";
    $no++;
    }
	$jmldata=mysqli_num_rows(mysqli_query($db,"SELECT * FROM hubungi where subjek!='Konfirmasi_Pembayaran'"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    echo "</table></span><br/>Halaman : $linkHalaman";
   

    break;
}
?>
