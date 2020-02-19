<?php
	include_once "../library/seslogin.php";

	# Tombol Simpan diklik
	if(isset($_POST['btnSimpan'])){
		# Validasi form, jika kosong sampaikan pesan error
		$pesanError = array();
		if (trim($_POST['txtNama'])=="") {
			$pesanError[] = "Data <b>Nama Pasien</b> tidak boleh kosong, silahkan dilengkapi !";		
		}
		if (trim($_POST['txtJk'])=="") {
			$pesanError[] = "Data <b>Jenis Kelamin</b> tidak boleh kosong, silahkan pilih !";		
		}	

		# Baca Variabel Form
		$txtNama		= $_POST['txtNama'];
		$txtJk			= $_POST['txtJk'];
		$txtTmpLahir	= $_POST['txtTmpLahir'];
		$txtTglLahir	= InggrisTgl($_POST['txtTglLahir']);
		$txtPhone		= $_POST['txtPhone'];
		$txtAlamat		= $_POST['txtAlamat'];
		
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
			$awal		= substr($txtNama,0,1);
			$id			= autoid("pasien", "id_pasien", "id_pasien", 5, "$awal");
			
			$mySql 	= "INSERT INTO pasien (id_pasien, nm_pasien, jk, tempatlahir, tgllahir, alamat, no_telepon)
									VALUES ('$id','$txtNama', '$txtJk', '$txtTmpLahir', '$txtTglLahir', '$txtAlamat', '$txtPhone')";
			$myQry	= mysqli_query($koneksidb, $mySql);
			if($myQry){		
				echo "<div class='alert alert-info alert-dismissible fade in mb-2' role='alert'>";
					echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
							</button>";
					echo "<strong><h6>PENDAFTARAN BERHASIL !!</strong></h6>";
					echo "<h6>&nbsp;&nbsp; Pasien baru an.&nbsp;<b>$txtNama</b> telah berhasil ditambah dengan nomor ID <b>$id</b> </h6>";
				echo "</div>";
			
				
			}
			
		}	
	} // Penutup Tombol Simpan

	# MASUKKAN DATA DARI FORM KE VARIABEL TEMPORARY (SEMENTARA)
	$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
	$dataTmpLahir	= isset($_POST['txtTmpLahir']) ? $_POST['txtTmpLahir'] : '';
	$dataTglLahir	= isset($_POST['txtTglLahir']) ? $_POST['txtTglLahir'] :  date('d-m-Y');
	$dataJk			= isset($_POST['txtJk']) ? $_POST['txtJk'] : '';
	$dataAlamat		= isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '';
	$dataPhone		= isset($_POST['txtPhone']) ? $_POST['txtPhone'] : '';
?>
<div class="row">
	<div class="col-lg-6" style='margin-left: 25%;'>
		<div class="panel panel-default">
			<div class="panel-heading">
				Pendaftaran Pasien Baru
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
					<div class="form-group">
						<label>Nama Pasien</label>
						<input name="txtNama" onkeyup="this.value = this.value.toUpperCase()" class='form-control' required />
						
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label>Tempat Lahir</label>
									<input name="txtTmpLahir" onkeyup="this.value = this.value.toUpperCase()" class='form-control' value="<?php echo $dataTmpLahir; ?>" />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Tanggal Lahir</label>
									<input name="txtTglLahir" type="text" class="tcal form-control"  />
							</div>
						</div>						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<div class="input-group">
									<label class="display-inline-block custom-control custom-radio ml-1">
										<input type="radio" name="txtJk" class="custom-control-input" value='L' required>
										<span class="custom-control-indicator"></span>
										<span class="custom-control-description ml-0">Laki-laki &nbsp</span>
									</label>
									<label class="display-inline-block custom-control custom-radio">
										<input type="radio" name="txtJk" class="custom-control-input" value='P' required>
										<span class="custom-control-indicator"></span>
										<span class="custom-control-description ml-0">Perempuan</span>
									</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Telephone</label>
								<div class="input-group">
									<input type='number' name="txtPhone" class='form-control' />
								</div>
							</div>
						</div>				
					</div>
					
					<div class="form-group">
						<label>Alamat</label>
							<input name="txtAlamat" onkeyup="this.value = this.value.toUpperCase()" class='form-control' />
					</div>
						
					<div class="form-actions center">
						<button type="reset" class="btn btn-warning mr-1" name='reset' value='Reset'>
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