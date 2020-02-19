<?php
include_once "../library/koneksi.php";
	
    $rm			= $_POST['rm'];
	$diagnosa	= $_POST['diagnosa'];
	$terapi		= $_POST['terapi'];
	if(empty($diagnosa)){
		$diag = 0;
	} else {
		$diag = 1;
	}
	if(empty($terapi)){
		$tera = 0;
	} else {
		$tera = 1;
	}
	$Yes = $diag + $tera ;
	
	$cekSql="SELECT * FROM pendaftaran WHERE rm='$rm'";
	$cekQry=mysqli_query($koneksidb, $cekSql); 
	$mySql 	= "UPDATE pendaftaran SET diagnosa='$diagnosa',	
									  terapi='$terapi' WHERE rm='$rm'";
	$myQry	= mysqli_query($koneksidb, $mySql);
	if ($Yes == 2) {
		$mySql 	= "UPDATE pendaftaran SET ok='$Yes' WHERE rm='$rm'";
		$myQry	= mysqli_query($koneksidb, $mySql);
	} else {
		$mySql 	= "UPDATE pendaftaran SET ok='$Yes' WHERE rm='$rm'";
		$myQry	= mysqli_query($koneksidb, $mySql);
	}
	header('location:menu.php?page=Laporan-Pendaftaran');
?>
