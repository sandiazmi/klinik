<?php
	include_once "library/koneksi.php";
	
	$nm_pasien	= $_POST['nm_pasien'];
	$jk			= $_POST['jk'];
	$alamat		= $_POST['alamat'];
	$no_telepon = $_POST['no_telepon'];
	$awal		= substr($nm_pasien,0,1);
	$id			= autoid("pasien", "id_pasien", "id_pasien", 5, "$awal");
	
	
	$mySql 	= "INSERT INTO pasien (id_pasien, nm_pasien, jk, alamat, no_telepon)
							VALUES ('$id','$nm_pasien', '$jk', '$alamat', '$no_telepon')";
	$myQry	= mysqli_query($koneksidb, $mySql);
	
	header('location:menu.php?page=Pasien-Data');
	
?>
