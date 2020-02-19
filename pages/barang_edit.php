<?php
	include_once "../library/koneksi.php";
    $kd_barang = $_GET['kd_barang'];
    $barang = mysqli_query($koneksidb,"select * from barang where kd_barang='$kd_barang'");
    while($row=  mysqli_fetch_array($barang)){
		$dataSatuan		= isset($_POST['kd_satuan']) ? $_POST['kd_satuan'] : $row['kd_satuan'];
		$dataKategori	= isset($_POST['kd_kategori']) ? $_POST['kd_kategori'] : $row['kd_kategori'];
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Edit Data Barang</h4>
		</div>
        <div class="modal-body">
			<form class="form" action="barang_update.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Kategori</label>
							<select required name="kd_kategori" class="form-control">
								<option value="" disabled selected> </option>
								<?php
								  $bacaSql = "SELECT * FROM kategori ORDER BY kd_kategori";
								  $bacaQry = mysqli_query($koneksidb, $bacaSql);
								  while ($bacaData = mysqli_fetch_array($bacaQry)) {
									if ($bacaData['kd_kategori'] == $dataKategori) {
										$cek = " selected";
									} else { $cek=""; }
									echo "<option value='$bacaData[kd_kategori]' $cek>$bacaData[nm_kategori]</option>";
								  }
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Kode Barang</label>
							<input type="text" class="form-control" name="kd_barang" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Kode Barang" value="<?php echo $row['kd_barang']; ?>" readonly>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="issueinput2">Nama Barang</label>
					<input type="text" id="issueinput2" class="form-control" name="nm_barang" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Nama Barang" value="<?php echo $row['nm_barang']; ?>" required>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="issueinput3">Harga Beli</label>
							<input type="number" id="issueinput3" class="form-control" placeholder="0" name="harga_beli" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Harga Beli" value="<?php echo $row['harga_beli']; ?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="issueinput4">Harga Jual</label>
							<input type="number" id="issueinput4" class="form-control" placeholder="0" name="harga_jual" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Harga Jual" value="<?php echo $row['harga_jual']; ?>" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="issueinput5">Satuan</label>
							<select required name="kd_satuan" class="form-control">
								<option value="" disabled selected> </option>
								<?php
								  $bacaSql = "SELECT * FROM satuan ORDER BY kd_satuan";
								  $bacaQry = mysqli_query($koneksidb, $bacaSql);
								  while ($bacaData = mysqli_fetch_array($bacaQry)) {
									if ($bacaData['kd_satuan'] == $dataSatuan) {
										$cek = " selected";
									} else { $cek=""; }
									echo "<option value='$bacaData[kd_satuan]' $cek>$bacaData[nm_satuan]</option>";
								  }
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="issueinput6">Stok</label>
							<input type="number" id="issueinput6" class="form-control" placeholder="0" name="stok" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Stok Barang" value="<?php echo $row['stok']; ?>" >
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="issueinput7">Keterangan</label>
					<input type="text" id="issueinput7" class="form-control" placeholder="Keterangan" name="keterangan" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Keterangan" value="<?php echo $row['keterangan']; ?>" required>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-outline-primary">
						Simpan
					</button>
				</div>
			</form>
            <?php
    }
            ?>
        </div>
    </div>
</div>
