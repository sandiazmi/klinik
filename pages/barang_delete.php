<?php
	include_once "../library/koneksi.php";
	
	$kd_barang= $_POST['kd_barang'];
	$kategori	= mysqli_query($koneksidb, "delete from barang where kd_barang='$kd_barang'");

	header('location:menu.php?page=Barang-Data');
?>
