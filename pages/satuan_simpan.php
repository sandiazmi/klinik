<?php
	include_once "../library/koneksi.php";
	
    $kd_satuan= $_POST['kd_satuan'];
	$nm_satuan= $_POST['nm_satuan'];
	
	$mySql 	= "INSERT INTO satuan (kd_satuan,nm_satuan)
							VALUES ('$kd_satuan','$nm_satuan')";
	$myQry	= mysqli_query($koneksidb, $mySql);
	
	header('location:menu.php?page=Satuan-Data');
	
?>
