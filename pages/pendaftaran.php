<?php
	include_once "../library/seslogin.php";

	# Tombol Simpan diklik
	if(isset($_POST['btnSimpan'])){
		# Validasi form, jika kosong sampaikan pesan error
		$pesanError = array();
		if (trim($_POST['txtIdPasien'])=="") {
			$pesanError[] = "Data <b>ID Pasien</b> tidak boleh kosong !";		
		}
		if (trim($_POST['txtTglDaftar'])=="") {
			$pesanError[] = "Data <b>Tgl. Daftar</b> tidak boleh kosong, silahkan pilih pada kalender !";		
		}	
		if (trim($_POST['txtTglJanji'])=="") {
			$pesanError[] = "Data <b>Tgl. Janji</b> tidak boleh kosong, silahkan pilih pada kalender !";			
		}
		if (trim($_POST['txtKeluhan'])=="") {
			$pesanError[] = "Data <b>Keluhan Pasien</b> tidak boleh kosong, silahkan dilengkapi !";		
		}

		# Baca Variabel Form
		$txtIdPasien	= $_POST['txtIdPasien'];
		$txtRm			= $_POST['txtRm'];
		$txtTD			= $_POST['txtTD'];
		$txtBB			= $_POST['txtBB'];
		$txtSH			= $_POST['txtSH'];
		$txtTglDaftar	= InggrisTgl($_POST['txtTglDaftar']);
		$txtTglJanji	= InggrisTgl($_POST['txtTglJanji']);
		$txtKeluhan		= $_POST['txtKeluhan'];
		
		# JIKA ADA PESAN ERROR DARI VALIDASI
		if (count($pesanError)>=1 ){
			echo "<div class='alert alert-info alert-dismissible fade in mb-2' role='alert'>";
			echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>";
			echo "<strong><h6>PERHATIAN !!</strong></h6>";
				$noPesan=0;
				foreach ($pesanError as $indeks=>$pesan_tampil) { 
				$noPesan++;
					echo "<h6>&nbsp;&nbsp; $noPesan. $pesan_tampil</h6>";	
				} 
			echo "</div>";
		}
		else {
			# SIMPAN DATA KE DATABASE. 
			// Jika tidak menemukan error, simpan data ke database	
			$userLogin	= $_SESSION['SES_USER'];
			$nomorAntri = nomorAntrian($txtTglJanji);
			$kodeBaru	= autorm("pendaftaran", "rm", "id_pasien", 3, "$txtIdPasien");
	
			$mySql	= "INSERT INTO pendaftaran (rm, id_pasien, tgl_daftar, tgl_janji, td, bb, suhu,  
							keluhan, nomor_antri, username) 
							VALUES ('$txtRm', '$txtIdPasien', '$txtTglDaftar', '$txtTglJanji', '$txtTD', '$txtBB', '$txtSH',
							'$txtKeluhan', '$nomorAntri', '$userLogin')";
			$myQry	= mysqli_query($koneksidb, $mySql);
			if($myQry){			
				// Menjalankan program cetak
				
				// Refresh halaman 
				echo "<meta http-equiv='refresh' content='0; url=?page=Main'>";
			}
			exit;
		}	
	} // Penutup Tombol Simpan

	// Membaca Nomor RM data Pasien
	$IdPasien= isset($_GET['IdPasien']) ?  $_GET['IdPasien'] : '';
	$mySql	= "SELECT id_pasien, nm_pasien FROM pasien WHERE id_pasien='$IdPasien'";
	$myQry	= mysqli_query($koneksidb, $mySql);
	$myData = mysqli_fetch_array($myQry);
	$dataPasien		= $myData['nm_pasien'];

	$dataKode	= autorm("pendaftaran", "rm", "id_pasien", 3, "$IdPasien");

	# Kode pasien
	if($IdPasien=="") {
		$IdPasien= isset($_POST['txtIdPasien']) ? $_POST['txtIdPasien'] : '';
	}

	# MASUKKAN DATA DARI FORM KE VARIABEL TEMPORARY (SEMENTARA)
	  
	$dataTglDaftar	= isset($_POST['txtTglDaftar']) ? $_POST['txtTglDaftar'] :  date('d-m-Y');
	$dataTglJanji 	= isset($_POST['txtTglJanji']) ? $_POST['txtTglJanji'] : date('d-m-Y') ;
	$dataTD			= isset($_POST['txtTD']) ? $_POST['txtTD'] : '';	
	$dataBB			= isset($_POST['txtBB']) ? $_POST['txtBB'] : '';
	$dataSH			= isset($_POST['txtSH']) ? $_POST['txtSH'] : '';
	$dataKeluhan	= isset($_POST['txtKeluhan']) ? $_POST['txtKeluhan'] : '';
?>

<div class="row">
	<div class="col-lg-6" style='margin-left: 25%;'>
		<div class="panel panel-default">
			<div class="panel-heading">
				Pendaftaran Pasien
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>ID Pasien</label>
								<div class="form-group input-group">
									<input name="txtIdPasien" class='form-control' value="<?php echo $IdPasien; ?>" />
									<span class="input-group-addon"><a  href="#" data-target="#my-modal" data-toggle="modal"><i class="fa fa-search"></i></a></span>
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label>Nama Pasien</label>
								<input name="txtPasien" class='form-control' value="<?php echo $dataPasien; ?>" readonly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>No. RM</label>
								<input name="txtRm" class="form-control" value="<?php echo $dataKode; ?>" readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Tanggal Daftar</label>
								<div class="input-group">
									<input name="txtTglDaftar" type="text" class="tcal form-control" value="<?php echo $dataTglDaftar; ?>" />
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Tanggal Berobat</label>
								<div class="input-group">
									<input name="txtTglJanji" type="text" class="tcal form-control" value="<?php echo $dataTglJanji; ?>" />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Tekanan Darah</label>
								<input name="txtTD" type="text" class="form-control" value="<?php echo $dataTD; ?>" >
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Berat Badan</label>
								<div class="input-group">
									<input name="txtBB" type="text" class="form-control" value="<?php echo $dataBB; ?>" />
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Suhu</label>
								<div class="input-group">
									<input name="txtSH" type="text" class="form-control" value="<?php echo $dataSH; ?>" />
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Keluhan Pasien</label>
						<textarea rows="4" class="form-control border-primary" name="txtKeluhan" placeholder="Penjelasan keluhan pasien" value="<?php echo $dataKeluhan; ?>"></textarea>
					</div>
					<div class="form-actions center">
						<button type="button" class="btn btn-warning mr-1" name='reset' value='Reset'>
							<i class="icon-cross2"></i> Cancel
						</button>
						<button type="submit" class="btn btn-primary" name="btnSimpan" value="Simpan">
							<i class="icon-check2"></i> Save
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<div id="my-modal" class="modal fade text-xs-left" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Data Pasien</h4>
			</div>
			<div class="modal-body">					
				<?php		
					// Membaca variabel form
					$KeyWord	= isset($_GET['KeyWord']) ? $_GET['KeyWord'] : '';
					$dataCari	= isset($_POST['txtCari']) ? $_POST['txtCari'] : $KeyWord;

					// Jika tombol Cari diklik
					if(isset($_POST['btnCari'])){
						if($_POST) {
							$filterSql = "WHERE nm_pasien LIKE '%$dataCari%'";
						}
					}
					else {
						if($KeyWord){
							$filterSql = "WHERE nm_pasien LIKE '%$dataCari%'";
						}
						else {
							$filterSql = "";
						}
					}
				?>

				<div class="row">
					<div class="col-lg-12">
						<!-- /.panel-heading -->
						<div class="panel-body">
							<div class="dataTable_wrapper">					
								<table id="dataTables-example" class="table table-hover table-bordered" width="100%" cellspacing="0">
									<thead>
										<tr>
										<th width='15%'>ID</th>
										<th>NAMA PASIEN</th>
										<th>ALAMAT</th>
										</tr>
									</thead>
									<tbody>
										<?php
										
										$mySql = "SELECT * FROM pasien ORDER BY id_pasien ASC";
										$myQry = mysqli_query($koneksidb, $mySql);
										while($myData = mysqli_fetch_array($myQry))
										{
											$Kode = $myData['id_pasien'];
										
											?>
											<tr>
												<td><a href="?page=Pendaftaran&amp;IdPasien=<?php echo $myData['id_pasien']; ?>" target="_self"><?php echo $myData['id_pasien']; ?></a></td>
												<td><?php echo $myData['nm_pasien']; ?></td>
												<td><?php echo $myData['alamat']; ?></td>
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
	</div>
</div>
