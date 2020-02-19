<?php
include_once "../library/koneksi.php";
	
    $kd_kategori= $_POST['kd_kategori'];
	$nm_kategori= $_POST['nm_kategori'];
	
	$cekSql="SELECT * FROM kategori WHERE kd_kategori='$kd_kategori'";
	$cekQry=mysqli_query($koneksidb, $cekSql); 
	$mySql 	= "UPDATE kategori SET nm_kategori='$nm_kategori'
								WHERE kd_kategori='$kd_kategori'";
	$myQry	= mysqli_query($koneksidb, $mySql);
	header('location:menu.php?page=Kategori-Data');
?>
