<?php
	include_once "../library/koneksi.php";
	
	$Kode	= $_GET['Kode'];
	$tindakan	= mysqli_query($koneksidb, "delete from pasien where id_pasien='$Kode'");
	
	echo "<meta http-equiv='refresh' content='0; url=?page=Pasien-Data'>";
?>
