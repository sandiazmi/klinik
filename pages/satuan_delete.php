<?php
	include_once "../library/koneksi.php";
	
	$kd_satuan= $_POST['kd_satuan'];
	$satuan	= mysqli_query($koneksidb, "delete from satuan where kd_satuan='$kd_satuan'");

	header('location:menu.php?page=Satuan-Data');
?>
