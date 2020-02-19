<?php
	include_once "../library/koneksi.php";
    $kd_tindakan = $_GET['kd_tindakan'];
    $tindakan = mysqli_query($koneksidb,"select * from tindakan where kd_tindakan='$kd_tindakan'");
    while($row=  mysqli_fetch_array($tindakan)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Data Tindakan</h4>
			</div>
        <div class="modal-body">
			<form class="form" action="tindakan_update.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
				<div class="form-group">
					<label>Kode</label>
					<input type="text" class="form-control" name="kd_tindakan" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Kode Tindakan" value="<?php echo $row['kd_tindakan']; ?>" readonly>
				</div>
				<div class="form-group">
					<label>Tindakan</label>
					<input type="text" class="form-control" name="nm_tindakan" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Tindakan" value="<?php echo $row['nm_tindakan']; ?>" required>
				</div>
				<div class="form-group">
					<label>Harga</label>
					<input type="number" class="form-control" name="harga" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Tindakan" value="<?php echo $row['harga']; ?>" required>
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
