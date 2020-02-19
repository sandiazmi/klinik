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
		$filterPeriode = "WHERE ( tgl_janji BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
	}
	else {
		// Membaca data tanggal dari URL, saat menu Pages diklik
		$tglAwal 	= isset($_GET['tglAwal']) ? $_GET['tglAwal'] : $tglAwal;
		$tglAkhir 	= isset($_GET['tglAkhir']) ? $_GET['tglAkhir'] : $tglAkhir; 
		
		// Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
		$filterPeriode = "WHERE ( tgl_janji BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
	}

	$barang = "SELECT * FROM barang";
	$myQry = mysqli_query($koneksidb, $barang);
	$jumbar= mysqli_num_rows($myQry);
	$pasien = "SELECT * FROM pasien";
	$myQry = mysqli_query($koneksidb, $pasien);
	$jumpas= mysqli_num_rows($myQry);
	$tgl   = Date("y-m-d");
	$skrg  = date("Y-m-d");
	$daftar = "SELECT * FROM pendaftaran WHERE tgl_daftar='$tgl'";
	$myQry = mysqli_query($koneksidb, $daftar);
	$jumdaf= mysqli_num_rows($myQry);
?>

<!-- /.row -->
<div class="row">
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-users fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $jumpas;?></div>
						<div>Total Pasien</div>
					</div>
				</div>
			</div>
			<a href="?page=Pasien-Data">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-edit fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $jumdaf;?></div>
						<div>Pasien hari ini</div>
					</div>
				</div>
			</div>
			<a href="?page=Pendaftaran">
				<div class="panel-footer">
					<span class="pull-left">Pendaftaran Pasien</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-shopping-cart fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $jumbar;?></div>
						<div>Total Barang</div>
					</div>
				</div>
			</div>
			<a href="?page=Barang-Data">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-clock-o fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">
							<div id="jam">
								<script language="javascript">
									jam();
									function jam(){
										var time = new Date();
										document.getElementById('jam').innerHTML = time.getHours()+ ":" + time.getMinutes() + ":" + time.getSeconds();
										setTimeout("jam()", 1000);
									}
								</script>
							</div>
						</div>
						<div>Waktu saat ini!</div>
					</div>
				</div>
			</div>
			<a href="#">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Data Pendaftaran Hari ini
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th width='7%'>NO.</th>
								<th>NAMA PASIEN</th>
								<th width='10%'>AKSI</td>
							</tr>
						</thead>
						<tbody>
							<?php
								$mySql = "SELECT pendaftaran.*, pasien.nm_pasien
											FROM pendaftaran 
											LEFT JOIN pasien ON pendaftaran.id_pasien = pasien.id_pasien						
											WHERE tgl_janji='$tgl'
											ORDER BY nomor_antri";
								$myQry = mysqli_query($koneksidb, $mySql);
								$nomor = 0; 
								while ($myData = mysqli_fetch_array($myQry)) {
									$nomor++;	
									$Kode  = $myData['rm'];
									$Nama  = $myData['nm_pasien'];
									$Daftar= $myData['tgl_daftar'];
									$Janji = $myData['tgl_janji'];
									$Keluh = $myData['keluhan'];
									$Diagnosa = $myData['diagnosa'];
									$Terapi = $myData['terapi'];
									$Ok = $myData['ok'];
									
							?>
							<tr>
								<?php
									if($Ok == 2) {
											echo "<td align='right'>$nomor</td>";
											echo "<td>".$myData['nm_pasien']."</td>";
											echo "<td align='center'><span style='color:3333ff'>
														<a  href='#' class='rekam' id=".$myData['rm']." title='Rekam medis'><img src='../img/icons/view.png' width='18' title='Rekam medis'></a>
													</td>";
									} else {
										echo "<td align='right'><span style='color:3333ff'><b> $nomor </b></span></td>";
											echo "<td><span style='color:3333ff'><b>".$myData['nm_pasien']."</b></span></td>";
											echo "<td align='center'><span style='color:3333ff'><b>
														<a  href='#' class='rekam' id=".$myData['rm']." title='Rekam medis'><img src='../img/icons/view.png' width='18' title='Rekam medis'></a>
													</td>";
									}
								?>
					
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