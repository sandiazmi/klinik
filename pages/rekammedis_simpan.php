<?php
	include_once "library/koneksi.php";
	
    $rm 		= $_POST['rm'];
	$id_pasien	= $_POST['id_pasien'];
	$diagnosa	= $_POST['diagnosa'];
	$terapi		= $_POST['terapi'];
	
	$mySql 	= "INSERT INTO rekammedis (rm, id_pasien, tanggal, diagnosa, terapi )
							VALUES ('$rm','$id_pasien', NOW(), '$diagnosa', '$terapi')";
	$myQry	= mysqli_query($koneksidb, $mySql);
	
	header('location:menu.php?page=Pasien-Data');
	
?>
