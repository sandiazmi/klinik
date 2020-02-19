<?php
include_once "../library/seslogin.php";

	# Tombol Simpan diklik
	if(isset($_POST['btnSimpan'])){
		# Validasi form, jika kosong sampaikan pesan error
		
		# Baca Variabel Form
		$txtNama		= $_POST['txtNama'];
		$txtPassword	= $_POST['txtPassword'];
		$txtPassLama	= $_POST['txtPassLama'];

		
		# SIMPAN DATA KE DATABASE. 
		// Jika tidak menemukan error, simpan data ke database	
		# Cek Password baru
		if (trim($txtPassword)=="") {
			$txtPassLama= $_POST['txtPassLama'];
			$passwSQL = ", password='$txtPassLama'";
		}
		else {
			$passwSQL = ",  password ='".md5($txtPassword)."'";
		}
		
		$mySql	= "UPDATE user SET nama = '$txtNama' $passwSQL
				  WHERE  username='".$_SESSION['SES_USER']."'";
		$myQry	= mysqli_query($koneksidb, $mySql);
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=menu.php?page=Main'>";
		}
		exit;	
	} // Penutup Tombol Simpan

	# MENGAMBIL DATA YANG DIEDIT, SESUAI KODE YANG DIDAPAT DARI URL
	
	$mySql	= "SELECT * FROM user WHERE username='".$_SESSION['SES_USER']."'";
	$myQry	= mysqli_query($koneksidb, $mySql);
	$myData = mysqli_fetch_array($myQry);

	# MASUKKAN DATA DARI FORM KE VARIABEL TEMPORARY (SEMENTARA)
	
	
	$dataKode		= $myData['username'];
	$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nama'];
	$dataPassword	= isset($_POST['txtPassword']) ? $_POST['txtPassword'] : $myData['password'];
	
?>
<div class="row">
	<div class="col-lg-6" style='margin-left: 25%;'>
		<div class="panel panel-default">
			<div class="panel-heading">
				Edit Profile
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">				
				<form class="form"  action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
					<div class="form-group">
						<label>Username</label>
						<input name="textfield" class='form-control' type="text"  value="<?php echo $dataKode; ?>" readonly="readonly"/>
									  <input name="txtKode" class='form-control' type="hidden" value="<?php echo $dataKode; ?>" />
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input name="txtNama" class='form-control' type="text" value="<?php echo $dataNama; ?>" />
					</div>
					<div class="form-group">
						<label>Password</label>
						<input name="txtPassword" type="password" class='form-control' size="30" maxlength="20" />
						<input name="txtPassLama" type="hidden" class='form-control' value="<?php echo $myData['password']; ?>" />
					</div>
					<div class="form-actions">
						<button type="submit" name="btnSimpan" class="btn btn-primary">
							<i class="icon-check2"></i> Edit
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
