<?php
	include_once "library/koneksi.php";
	
    $kd_tindakan= $_POST['kd_tindakan'];
	$nm_tindakan= $_POST['nm_tindakan'];
	$harga		= $_POST['harga'];
	
	$mySql 	= "INSERT INTO tindakan (kd_tindakan,nm_tindakan, harga)
							VALUES ('$kd_tindakan','$nm_tindakan', '$harga')";
	$myQry	= mysqli_query($koneksidb, $mySql);
	
	header('location:menu.php?page=Tindakan-Data');
	
?>
