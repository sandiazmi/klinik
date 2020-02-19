<?php
	include_once "../library/seslogin.php";

	# Deklarasi variabel
	$filterPeriode = ""; 
	$tglAwal	= ""; 
	$tglAkhir	= "";

	# Membaca tanggal dari form, jika belum di-POST formnya, maka diisi dengan tanggal sekarang
	$tglAwal 	= isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : "01-".date('d-m-Y');
	$tglAkhir 	= isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : date('d-m-Y');

	// Jika tombol filter tanggal (Tampilkan) diklik
	if (isset($_POST['btnTampil'])) {
		// Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
		$filterPeriode = "WHERE ( tgl_janji BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
	}
	else {
		// Membaca data tanggal dari URL, saat menu Pages diklik
		$tglAwal 	= isset($_GET['tglAwal']) ? $_GET['tglAwal'] : $tglAwal;
		$tglAkhir 	= isset($_GET['tglAkhir']) ? $_GET['tglAkhir'] : $tglAkhir; 
		
		// Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
		$filterPeriode = "WHERE ( tgl_janji BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
	}

?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Data Pendaftaran
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
								<th align="center" width='7%'>NO.</th>
								<th width='13%'>TANGGAL</th>
								<th width='13%'>RM</th>
								<th>NAMA PASIEN</th>
								<th width='10%' align="center">AKSI</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$mySql = "SELECT pendaftaran.*, pasien.nm_pasien
											FROM pendaftaran 
											LEFT JOIN pasien ON pendaftaran.id_pasien = pasien.id_pasien						
											$filterPeriode
											ORDER BY pendaftaran.rm ASC";
								$myQry = mysqli_query($koneksidb, $mySql);
								$nomor = 0; 
								while ($myData = mysqli_fetch_array($myQry)) {
									$nomor++;	
									$Kode  = $myData['rm'];
									$Nama  = $myData['nm_pasien'];
									$Daftar= $myData['tgl_daftar'];
									$Janji = $myData['tgl_janji'];
									$Keluh = $myData['keluhan'];
							?>
							<tr>
								<td width='8%'><?php echo $nomor; ?></td>
								<td><?php echo IndonesiaTgl($myData['tgl_janji']); ?></td>
								<td><?php echo $myData['rm']; ?></td>
								<td><?php echo $myData['nm_pasien']; ?></td>
								<td align='center'><a  href="#" class="rekam_ubah" id="<?php echo $myData['rm']; ?>" ><img src='../img/icons/view.png' width='18' title='Rekam medis'></a>
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

<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Diagnosa Medis</h4>
			</div>
			<div class="modal-body">					
				<form class="form" action="rekammedis_simpan.php" method="post" name="form1" target="_self" id="form-save">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Rekam Medis</label>
								<input type="text" class="form-control" name="id_pasien" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Rekam Medis" value="<?php echo $Kode; ?>" readonly>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label>Nama Pasien</label>
								<input type="text" class="form-control" name="nm_pasien" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Nama Pasien" value="<?php echo $Nama; ?>" readonly>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Keluhan</label>
						<textarea name='keluhan' class='form-control' readonly><?php echo $Keluh; ?> </textarea>			
					</div>
					<div class="form-group">
						<label>Diagnosa</label>
						<textarea rows="4" class="form-control border-primary" name="diagnosa" placeholder="Rincian Diagnosa"></textarea>
					</div>
					<div class="form-group">
						<label>Terapi</label>
						<textarea rows="4" class="form-control border-primary" name="terapi" placeholder="Rincian Terapi"></textarea>
					</div>
								
					<div class="modal-footer">
						<button type="submit" class="btn btn-outline-primary">
							Simpan
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="RekamEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>