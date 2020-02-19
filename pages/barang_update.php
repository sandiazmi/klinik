<?php
include_once "../library/koneksi.php";
	
    $kd_barang	= $_POST['kd_barang'];
	$nm_barang	= $_POST['nm_barang'];
	$harga_beli	= $_POST['harga_beli'];
	$harga_jual	= $_POST['harga_jual'];
	$kd_satuan	= $_POST['kd_satuan'];
	$stok		= $_POST['stok'];
	$keterangan	= $_POST['keterangan'];
	$kd_kategori= $_POST['kd_kategori'];
	
	$cekSql="SELECT * FROM barang WHERE kd_barang='$kd_barang'";
	$cekQry=mysqli_query($koneksidb, $cekSql); 
	$mySql 	= "UPDATE barang SET nm_barang='$nm_barang',
								harga_beli='$harga_beli',
								harga_jual='$harga_jual',
								kd_satuan='$kd_satuan',
								stok='$stok',
								keterangan='$keterangan',
								kd_kategori='$kd_kategori'
								WHERE kd_barang='$kd_barang'";
	$myQry	= mysqli_query($koneksidb, $mySql);
	header('location:menu.php?page=Barang-Data');
?>
