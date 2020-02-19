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
	
	$mySql 	= "INSERT INTO barang (kd_barang, nm_barang, harga_beli, harga_jual, kd_satuan, stok, keterangan, kd_kategori)
							VALUES ('$kd_barang','$nm_barang', '$harga_beli', '$harga_jual', '$kd_satuan', '$stok', '$keterangan', '$kd_kategori')";
	$myQry	= mysqli_query($koneksidb, $mySql);
	
	header('location:menu.php?page=Barang-Data');
	
?>
