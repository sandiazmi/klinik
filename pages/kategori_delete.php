<?php
	include_once "../library/koneksi.php";
	
	$kd_kategori= $_POST['kd_kategori'];
	$kategori	= mysqli_query($koneksidb, "delete from kategori where kd_kategori='$kd_kategori'");

	header('location:menu.php?page=Kategori-Data');
?>
