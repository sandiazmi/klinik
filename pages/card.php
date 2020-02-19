<?php
	include_once "../library/koneksi.php";
	include_once "../library/library.php";

	# Baca noNota dari URL
	if(isset($_GET['Kode'])){
		$IdPasien = $_GET['Kode'];
		$mySql = "SELECT * FROM pasien WHERE id_pasien='$IdPasien'";
		$myQry = mysqli_query($koneksidb, $mySql);
		$myData = mysqli_fetch_array($myQry);
	}
	else {
		echo "Nomor Rawat (nomorRawat) tidak ditemukan";
		exit;
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Cetak Kartu Pasien</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link href="styles/styles_card.css" rel="stylesheet" type="text/css">
	<style>
		@page {
				margin : 0px;
		}
	</style>
	<script type="text/javascript">
		window.print();
		window.onfocus=function(){ window.close();}
	</script>
</head>
<body onLoad="window.print()">
	<table>
		<tr>
			<td colspan="3" align="center"><img src="../img/card.jpg" width="300"></td></td>
		</tr>
		<tr>
			<td align='center' colspan='3'><b><?php echo $myData['id_pasien']; ?></b></td>
		</tr>
		<tr>
			<td align='center' colspan='3' style="font-size : 12"><b><?php echo $myData['nm_pasien']; ?></b></td>
		</tr>
		<tr>
			<td align='center' colspan='3'><img alt="<?php $_GET['Kode'];?>" src="<?php echo "barcode.php?size=30&text=".$myData['id_pasien']; ?>" /></td>
		</tr>
	</table>
	<table style="font-size : 12" width="300">
		<tr>
			<td align='center' colspan='3'><?php echo CardTgl(date('Y-m-d')); ?></td>
		</tr>
		<tr>
			<td colspan='3'><hr></td>
		</tr>
	</table>
</body>
</html>
