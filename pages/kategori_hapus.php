<?php
	include_once "../library/koneksi.php";
	$kd_kategori = $_GET['kd_kategori'];
    $kategori = mysqli_query($koneksidb,"SELECT * FROM kategori WHERE kd_kategori='$kd_kategori'");
    
    while($row=  mysqli_fetch_array($kategori)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Hapus Data Kategori</h4>
			</div>
        <div class="modal-body">
			<form class="form-horizontal" action="kategori_delete.php" name="modal-popup" enctype="multipart/form-data" method="POST">
				<div class="alert alert-danger"><span class="text-bold-600">PERINGATAN !!</span> Apakah anda yakin ingin menghapus data ini ?</div>
				<div class="form-group">
					<label>Kode</label>
					<input type="text" class="form-control" name="kd_kategori" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Kode Kategori" value="<?php echo $row['kd_kategori']; ?>" readonly>
				</div>
				<div class="form-group">
					<label>Satuan</label>
					<input type="text" class="form-control" name="nm_kategori" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Kategori Barang" value="<?php echo $row['nm_kategori']; ?>" readonly>
				</div>	
				
					
				<div class="modal-footer">
					<button type="submit" class="btn btn-outline-primary">
						Hapus
					</button>
				</div>
			</form>
        <?php
    }
		?>
        </div>
    </div>
</div>