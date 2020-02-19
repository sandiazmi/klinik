<?php
	include_once "../library/seslogin.php";

	# Tombol Simpan diklik
	if(isset($_POST['btnSimpan'])){
		# Validasi form, jika kosong sampaikan pesan error
		$pesanError = array();
		if (trim($_POST['txtNama'])=="") {
			$pesanError[] = "Data <b>Nama Pasien</b> tidak boleh kosong !";		
		}
		
		
		
		# Baca Variabel Form
		$txtNama		= $_POST['txtNama'];
		$txtTmpLahir	= $_POST['txtTmpLahir'];
		$txtTglLahir	= $_POST['txtTglLahir'];
		$txtJk			= $_POST['txtJk'];
		$txtPhone		= $_POST['txtPhone'];
		$txtAlamat		= $_POST['txtAlamat'];
		
		
			
		# JIKA ADA PESAN ERROR DARI VALIDASI
		if (count($pesanError)>=1 ){
			echo "<br><br><br>";
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
			# SIMPAN PERUBAHAN DATA, Jika jumlah error pesanError tidak ada, simpan datanya
			
			$mySql	= "UPDATE pasien SET  nm_pasien = '$txtNama',
									jk = '$txtJk',
									tempatlahir = '$txtTmpLahir',
									tgllahir = '$txtTglLahir',
									alamat = '$txtAlamat',
									no_telepon = '$txtPhone' 
						WHERE id_pasien ='".$_POST['txtKode']."'";
			$myQry = mysqli_query($koneksidb, $mySql);
			if($myQry){
				echo "<meta http-equiv='refresh' content='0; url=?page=Pasien-Data'>";
			}
			
		}	
	} // Penutup Tombol Simpan

	# MENGAMBIL DATA YANG DIEDIT, SESUAI KODE YANG DIDAPAT DARI URL
	$Kode	= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
	$mySql = "SELECT * FROM pasien WHERE id_pasien='$Kode'";
	$myQry = mysqli_query($koneksidb, $mySql);
	$myData = mysqli_fetch_array($myQry);
	

	# MASUKKAN DATA DARI FORM KE VARIABEL TEMPORARY (SEMENTARA)
	$dataKode	= $myData['id_pasien'];
	$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nm_pasien'];
	$dataJk		= isset($_POST['txtJk']) ? $_POST['txtJk'] : $myData['jk'];
	$dataTmpLahir= isset($_POST['txtTmpLahir']) ? $_POST['txtTmpLahir'] : $myData['tempatlahir'];
	$dataTglLahir= isset($_POST['txtTglLahir']) ? $_POST['txtTglLahir'] : $myData['tgllahir'];
	$dataAlamat = isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : $myData['alamat'];
	$dataPhone= isset($_POST['txtPhone']) ? $_POST['txtPhone'] : $myData['no_telepon'];


?>

<div class="row">
	<div class="col-lg-6" style='margin-left: 25%;'>
		<div class="panel panel-default">
			<div class="panel-heading">
				Edit Data Pasien
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>ID Pasien</label>
								<input name="textfield" value="<?php echo $dataKode; ?>" class='form-control'  readonly />
								<input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>"  />
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label>Nama Pasien</label>
								<input name="txtNama" onkeyup="this.value = this.value.toUpperCase()" class='form-control' value="<?php echo $dataNama; ?>" required />
							</div>
						</div>
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
								<div class="input-group">
									<input name="txtTglLahir" type="text" class="tcal form-control" value="<?php echo $dataTglLahir; ?>"  />
								</div>
							</div>
						</div>						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<div class="input-group">
										<label class="display-inline-block custom-control custom-radio ml-1">
											<input type="radio" name="txtJk" class="custom-control-input" value='L' <?php if($myData['jk'] == 'L'){echo 'checked="checked"';}?> >
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description ml-0">Laki-laki &nbsp</span>
										</label>
										<label class="display-inline-block custom-control custom-radio">
											<input type="radio" name="txtJk" class="custom-control-input" value='P' <?php if($myData['jk'] == 'P'){echo 'checked="checked"';}?> >
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description ml-0">Perempuan</span>
										</label>
									</div>
								</div>	
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Telephone</label>
								<input type='number' name="txtPhone" class='form-control' value="<?php echo $dataPhone; ?>" />
							</div>
						</div>	
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input name="txtAlamat" onkeyup="this.value = this.value.toUpperCase()" class='form-control' value="<?php echo $dataAlamat; ?>" />
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