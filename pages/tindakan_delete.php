<?php
	include_once "library/koneksi.php";
	
	$kd_tindakan= $_POST['kd_tindakan'];
	$tindakan	= mysqli_query($koneksidb, "delete from tindakan where kd_tindakan='$kd_tindakan'");

	header('location:menu.php?page=Tindakan-Data');
?>
