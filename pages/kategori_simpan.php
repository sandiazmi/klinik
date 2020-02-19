<?php
	include_once "../library/koneksi.php";
	
    $kd_kategori= $_POST['kd_kategori'];
	$nm_kategori= $_POST['nm_kategori'];
	
	$mySql 	= "INSERT INTO kategori (kd_kategori,nm_kategori)
							VALUES ('$kd_kategori','$nm_kategori')";
	$myQry	= mysqli_query($koneksidb, $mySql);
	
	header('location:menu.php?page=Kategori-Data');
	
?>
