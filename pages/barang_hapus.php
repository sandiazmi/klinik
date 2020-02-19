<?php
	include_once "../library/koneksi.php";
	include_once "../library/library.php";
    $kd_barang = $_GET['kd_barang'];
    $barang = mysqli_query($koneksidb,"select barang.*, kategori.nm_kategori, satuan.nm_satuan from barang 
										left join satuan on barang.kd_satuan=satuan.kd_satuan
										left join kategori on barang.kd_kategori=kategori.kd_kategori
										where barang.kd_barang='$kd_barang'");
    while($row=  mysqli_fetch_array($barang)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Hapus Data Barang</h4>
		</div>
        <div class="modal-body">
			<form class="form" action="barang_delete.php" name="modal-popup" enctype="multipart/form-data" method="POST">
				<div class="alert alert-danger"><span class="text-bold-600">PERINGATAN !!</span> Apakah anda yakin ingin menghapus data ini ?</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Kategori</label>
							<input name="nm_kategori" class='form-control' type="text" value="<?php echo $row['nm_kategori']; ?>" readonly>
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
					<label>Nama Barang</label>
					<input type="text" class="form-control" name="nm_barang" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Nama Barang" value="<?php echo $row['nm_barang']; ?>" readonly>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Harga Beli</label>
							<input type="number" id="issueinput3" class="form-control" placeholder="0" name="harga_beli" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Harga Beli" value="<?php echo format_angka($row['harga_beli']); ?>" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Harga Jual</label>
							<input type="number" class="form-control" placeholder="0" name="harga_jual" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Harga Jual" value="<?php echo format_angka($row['harga_jual']); ?>" readonly>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="issueinput5">Satuan</label>
							<input name="nm_satuan" class='form-control' type="text" value="<?php echo $row['nm_satuan']; ?>" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Stok</label>
							<input type="number" class="form-control" placeholder="0" name="stok" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Stok Barang" value="<?php echo $row['stok']; ?>" readonly>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Keterangan</label>
					<input type="text" class="form-control" placeholder="Keterangan" name="keterangan" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Keterangan" value="<?php echo $row['keterangan']; ?>" readonly>
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