<?php
include_once "../library/koneksi.php";
	
    $kd_tindakan= $_POST['kd_tindakan'];
	$nm_tindakan= $_POST['nm_tindakan'];
	$harga      = $_POST['harga'];
	
	$cekSql="SELECT * FROM tindakan WHERE kd_tindakan='$kd_tindakan'";
	$cekQry=mysqli_query($koneksidb, $cekSql); 
	$mySql 	= "UPDATE tindakan SET nm_tindakan='$nm_tindakan', harga='$harga'
								WHERE kd_tindakan='$kd_tindakan'";
	$myQry	= mysqli_query($koneksidb, $mySql);
	header('location:menu.php?page=Tindakan-Data');
?>
