<?php
	include_once "../library/koneksi.php";
    $kd_kategori = $_GET['kd_kategori'];
    $kategori = mysqli_query($koneksidb,"select * from kategori where kd_kategori='$kd_kategori'");
    while($row=  mysqli_fetch_array($kategori)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Data Kategori</h4>
			</div>
        <div class="modal-body">
			<form class="form" action="kategori_update.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
				<div class="form-group">
					<label>Kode</label>
					<input type="text" class="form-control" name="kd_kategori" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Kode Kategori" value="<?php echo $row['kd_kategori']; ?>" readonly>
				</div>
				<div class="form-group">
					<label>Kategori</label>
					<input type="text" class="form-control" name="nm_kategori" placeholder="Kategori Barang" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Kategori Barang" value="<?php echo $row['nm_kategori']; ?>" required>
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
