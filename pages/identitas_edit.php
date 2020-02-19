<?php
include_once "../library/seslogin.php";

	# Tombol Simpan diklik
	if(isset($_POST['btnSimpan'])){
		# Validasi form, jika kosong sampaikan pesan error
		
		# Baca Variabel Form
		$txtNama		= $_POST['txtNama'];
		$txtAlamat		= $_POST['txtAlamat'];
		$txtTelephone	= $_POST['txtTelephone'];
		$txtLegalitas	= $_POST['txtLegalitas'];
		
		# SIMPAN DATA KE DATABASE. 
		// Jika tidak menemukan error, simpan data ke database	
		$mySql	= "UPDATE identitas SET nama = '$txtNama',
					alamat = '$txtAlamat',
					telephone= '$txtTelephone',
					legalitas = '$txtLegalitas'
				  WHERE  aktif='Y'";
		$myQry	= mysqli_query($koneksidb, $mySql);
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=menu.php?page=Main'>";
		}
		exit;	
	} // Penutup Tombol Simpan

	# MENGAMBIL DATA YANG DIEDIT, SESUAI KODE YANG DIDAPAT DARI URL
	
	$mySql	= "SELECT * FROM identitas WHERE aktif='Y'";
	$myQry	= mysqli_query($koneksidb, $mySql);
	$myData = mysqli_fetch_array($myQry);

	# MASUKKAN DATA DARI FORM KE VARIABEL TEMPORARY (SEMENTARA)
	
	$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nama'];
	$dataAlamat		= isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : $myData['alamat'];
	$dataTelephone	= isset($_POST['txtTelephone']) ? $_POST['txtTelephone'] : $myData['telephone'];
	$dataLegalitas	= isset($_POST['txtLegalitas']) ? $_POST['txtLegalitas'] : $myData['legalitas'];
	
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Identitas Klinik
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<form class="form-horizontal "  action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
					<div class="form-group">
						<label class="col-sm-2 control-label">Nama Klinik</label>
						<div class="col-sm-10">
							<input name="txtNama" type="text" class="form-control" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Nama Klinik" value="<?php echo $dataNama; ?>" required>
							<input name="txtNamaLama" type="hidden" value="<?php echo $myData['nama']; ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Alamat</label>
						<div class="col-sm-10">
							<textarea name='txtAlamat' class='form-control' data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Alamat"><?php echo $myData['alamat']; ?> </textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Telephone</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="txtTelephone" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Nomor Telephone" value="<?php echo $dataTelephone; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Legalitas</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="txtLegalitas" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Legalitas" value="<?php echo $dataLegalitas; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
						  <button type="submit" name="btnSimpan" class="btn btn-danger">Edit</button>
						</div>
					</div>						
				</form>
			</div>
		</div>
	</div>
</div>
