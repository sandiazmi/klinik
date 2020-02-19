<?php
	include_once "../library/koneksi.php";
    $kd_satuan = $_GET['kd_satuan'];
    $satuan = mysqli_query($koneksidb,"select * from satuan where kd_satuan='$kd_satuan'");
    while($row=  mysqli_fetch_array($satuan)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Data Satuan</h4>
			</div>
        <div class="modal-body">
			<form class="form" action="satuan_update.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
				<div class="form-group">
					<label>Kode</label>
					<input type="text" class="form-control" name="kd_satuan" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Kode Satuan" value="<?php echo $row['kd_satuan']; ?>" readonly>
				</div>
				<div class="form-group">
					<label>Satuan</label>
					<input type="text" class="form-control" name="nm_satuan" placeholder="Satuan Barang" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Satuan Barang" value="<?php echo $row['nm_satuan']; ?>" required>
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
