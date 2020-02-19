<?php
	include_once "../library/seslogin.php";

	# Deklarasi variabel
	$filterPeriode = ""; 
	$tglAwal	= ""; 
	$tglAkhir	= "";

	# Membaca tanggal dari form, jika belum di-POST formnya, maka diisi dengan tanggal sekarang
	$tglAwal 	= isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : date('d-m-Y');
	$tglAkhir 	= isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : date('d-m-Y');

	// Jika tombol filter tanggal (Tampilkan) diklik
	if (isset($_POST['btnTampil'])) {
		// Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
		$filterPeriode = "WHERE ( tgl_rawat BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
	}
	else {
		// Membaca data tanggal dari URL, saat menu Pages diklik
		$tglAwal 	= isset($_GET['tglAwal']) ? $_GET['tglAwal'] : $tglAwal;
		$tglAkhir 	= isset($_GET['tglAkhir']) ? $_GET['tglAkhir'] : $tglAkhir; 
		
		// Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
		$filterPeriode = "WHERE ( tgl_rawat BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
	}

?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Data Pasien Berobat
				<div class="pull-right">
					<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
					  <input name="txtTglAwal" type="text" class="tcal" value="<?php echo $tglAwal; ?>" />
						s/d
						<input name="txtTglAkhir" type="text" class="tcal" value="<?php echo $tglAkhir; ?>" />
						<button type="submit" name="btnTampil" class="btn btn-primary btn-xs">
							<span class="icon icon-android-desktop"></span> Tampil
						</button>		
					</form>
				</div>
			</div>
			<div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-bordered table-hover" id="dataTables-example" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th width='8%'>NO.</th>
								<th width='13%'>NO.RAWAT</th>
								<th width='13%'>TANGGAL</th>
								<th width='13%'>RM</th>
								<th>NAMA PASIEN</th>
								<th width='13%'>NOTA</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$mySql = "SELECT rawat.*, pasien.nm_pasien	FROM rawat 
										LEFT JOIN pasien ON rawat.id_pasien = pasien.id_pasien
										$filterPeriode
										ORDER BY rawat.no_rawat ASC";
								$myQry = mysqli_query($koneksidb, $mySql);
								$nomor = 0; 
								while ($myData = mysqli_fetch_array($myQry)) {
									$nomor++;											
							?>
							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $myData['no_rawat']; ?></td>
								<td><?php echo IndonesiaTgl($myData['tgl_rawat']); ?></td>
								<td><?php echo $myData['rm']; ?></td>
								<td><?php echo $myData['nm_pasien']; ?></td>
								<td align='center'><a  href="#" class="rekam" id=<?php echo $myData['rm']; ?> title="Diagnosa"><i class='icon-android-clipboard font-medium-3'></i></a>
												<a  href="?page=Tagihan&amp;nomorRawat=<?php echo $myData['no_rawat']; ?>&amp;IdPasien=<?php echo $myData['id_pasien']; ?>&amp;Rm=<?php echo $myData['rm']; ?>" title="Lihat tagihan pembayaran"><i class='icon-banknote font-medium-3'></i></a>
												<a  href="rawat_nota.php?nomorRawat=<?php echo $myData['no_rawat']; ?>&amp;IdPasien=<?php echo $myData['id_pasien']; ?>&amp;Rm=<?php echo $myData['rm']; ?>" target="_blank" title="Cetak Nota"><i class='icon-printer4 font-medium-3'></i></a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="RekamLihat" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>