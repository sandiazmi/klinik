<?php
include_once "library/koneksi.php";
include_once "library/library.php";

if($_GET) {
	# Baca variabel URL
	$noNota = $_GET['noNota'];
	
	# Perintah untuk mendapatkan data dari tabel penjualan
	$mySql = "SELECT penjualan.*, user.nama FROM penjualan 
			  LEFT JOIN user ON penjualan.username=user.username
			  WHERE no_penjualan='$noNota'";
	$myQry = mysqli_query($koneksidb, $mySql);
	$myData = mysqli_fetch_array($myQry);
}
else {
	echo "Nomor Transaksi Tidak Terbaca";
	exit;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Cetak Penjualan</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link href="styles/styles_cetak.css" rel="stylesheet" type="text/css">
	<style>
		@page {
				margin : 0px auto;
		}
	</style>
	
</head>
<body onLoad="window.print()">
	<h2> PENJUALAN BARANG </h2>
	<table width="600" border="0" cellspacing="1" cellpadding="4" class="table-print">
	  <tr>
		<td width="139"><b>No. Penjualan </b></td>
		<td width="5"><b>:</b></td>
		<td width="378" valign="top"><strong><?php echo $myData['no_penjualan']; ?></strong></td>
	  </tr>
	  <tr>
		<td><b>Tgl. Penjualan </b></td>
		<td><b>:</b></td>
		<td valign="top"><?php echo IndonesiaTgl($myData['tgl_penjualan']); ?></td>
	  </tr>
	  <tr>
		<td><b>Pelanggan</b></td>
		<td><b>:</b></td>
		<td valign="top"><?php echo $myData['pelanggan']; ?></td>
	  </tr>
	  <tr>
		<td><strong>Keterangan</strong></td>
		<td><b>:</b></td>
		<td valign="top"><?php echo $myData['keterangan']; ?></td>
	  </tr>
	  <tr>
		<td><strong>Petugas/Kasir</strong></td>
		<td><b>:</b></td>
		<td valign="top"><?php echo $myData['nama']; ?></td>
	  </tr>
	  <tr>
		<td align="center">&nbsp;</td>
		<td>&nbsp;</td>
		<td valign="top">&nbsp;</td>
	  </tr>
	</table>

	<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="2">
	  <tr>
		<td colspan="6" bgcolor="#CCCCCC"><strong>DAFTAR BARANG </strong></td>
	  </tr>
	  <tr>
		<td width="30" align="center" bgcolor="#F5F5F5"><b>No</b></td>
		<td width="78" bgcolor="#F5F5F5"><strong>Kode </strong></td>
		<td width="319" bgcolor="#F5F5F5"><b>Nama Barang</b></td>
		<td width="91" align="right" bgcolor="#F5F5F5"><b> Harga (Rp) </b></td>
		<td width="55" align="right" bgcolor="#F5F5F5"><b> Jumlah </b></td>
		<td width="96" align="right" bgcolor="#F5F5F5"><strong>Sub Total(Rp) </strong></td>
	  </tr>
	  <?php
		// Buat variabel
		$subTotalJual	= 0;
		$grandTotalJual	= 0;
		
		// SQL menampilkan item barang yang dijual
		$mySql ="SELECT penjualan_item.*, barang.nm_barang FROM penjualan_item
				  LEFT JOIN barang ON penjualan_item.kd_barang=barang.kd_barang 
				  WHERE penjualan_item.no_penjualan='$noNota'
				  ORDER BY penjualan_item.kd_barang";
		$myQry = mysqli_query($koneksidb, $mySql);
		$nomor  = 0;  
		while($myData = mysqli_fetch_array($myQry)) {
			$nomor++;
			$subTotalJual 	= $myData['jumlah'] * $myData['harga_jual'];
			$grandTotalJual	= $grandTotalJual + $subTotalJual;
		?>
	  <tr>
		<td align="center"><?php echo $nomor; ?></td>
		<td><?php echo $myData['kd_barang']; ?></td>
		<td><?php echo $myData['nm_barang']; ?></td>
		<td align="right"><?php echo format_angka($myData['harga_jual']); ?></td>
		<td align="right"><?php echo $myData['jumlah']; ?></td>
		<td align="right"><?php echo format_angka($subTotalJual); ?></td>
	  </tr>
	  <?php } ?>
	  <tr>
		<td colspan="5" align="right"><b> Grand Total (Rp)  : </b></td>
		<td align="right" bgcolor="#F5F5F5"><strong><?php echo format_angka($grandTotalJual); ?></strong></td>
	  </tr>
	</table>
</body>
</html>