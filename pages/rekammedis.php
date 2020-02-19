<?php
	include_once "../library/seslogin.php";
	
	$Kode	 = $_GET['Kode'];
	$mySql = "SELECT * FROM pasien WHERE id_pasien='$Kode'";
	$myQry = mysqli_query($koneksidb, $mySql);
	$myData = mysqli_fetch_array($myQry);
	
	$dataTanggal 	= isset($_POST['tanggal']) ? $_POST['tanggal'] : date('d-m-Y');
	$tempat_lhr = $myData['tempatlahir'];
	$tgl_lhr 	= IndonesiaYear($myData['tgllahir']);
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Data Rekam Medis
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="dataTable_wrapper">
					<table>
						<tr>
							<td>Id Pasien</td>
							<td>:</td>
							<td><?php echo $myData['id_pasien']; ?></td>
						</tr>
						<tr>
							<td>Nama Pasien</td>
							<td>:</td>
							<td><?php echo $myData['nm_pasien']; ?></td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td>
							<td>:</td>
							<td><?php echo $myData['jk']; ?></td>
						</tr>
						<tr>
							<td>Tempat dan Tanggal Lahir</td>
							<td>:</td>
							<td> 
								<?php 
									if (isset($tempat_lhr)) {
										echo $myData['tempatlahir'].', '; 
									}
								?>
								<?php 
									if (IndonesiaYear($myData['tgllahir']) != 0000) {
										echo Indonesia2Tgl($myData['tgllahir'])." [Usia ".(date('Y')-IndonesiaYear($myData['tgllahir']))." Tahun]"; 
									}
								?> 
							</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>:</td>
							<td><?php echo $myData['alamat']; ?></td>
						</tr>
						<tr>
							<td>Telephone</td>
							<td>:</td>
							<td><?php echo $myData['no_telepon']; ?></td>
						</tr>
					</table>
				</div>
				<hr>
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-hover table-bordered" id="dataTables-example">
							<thead>
								<tr>
									<th width='13%'>TANGGAL</th>
									<th>KELUHAN</th>
									<th>DIAGNOSA</th>
									<th>TERAPI</th>
								</tr>
							</thead>
							<tbody>
								<?php				
									$mySql = "SELECT * FROM pendaftaran WHERE id_pasien='$Kode' ORDER BY rm ASC";					
									$myQry = mysqli_query($koneksidb, $mySql);
									$nomor  = 0;
									while($myData = mysqli_fetch_array($myQry))
									{
										$nomor++;
										$Kode = $myData['id_pasien'];
								?>
									<tr>
										<td><?php echo IndonesiaTgl($myData['tgl_janji']); ?></td>
										<td><?php echo $myData['keluhan']; ?></td>
										<td><?php echo $myData['diagnosa']; ?></td>
										<td><?php echo $myData['terapi']; ?></td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>