<?php
include_once "../library/koneksi.php";
	
    $kd_satuan= $_POST['kd_satuan'];
	$nm_satuan= $_POST['nm_satuan'];
	
	$cekSql="SELECT * FROM satuan WHERE kd_satuan='$kd_satuan'";
	$cekQry=mysqli_query($koneksidb, $cekSql); 
	$mySql 	= "UPDATE satuan SET nm_satuan='$nm_satuan'
								WHERE kd_satuan='$kd_satuan'";
	$myQry	= mysqli_query($koneksidb, $mySql);
	header('location:menu.php?page=Satuan-Data');
?>
