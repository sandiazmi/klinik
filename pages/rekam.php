<?php
	include_once "../library/koneksi.php";
    $rm = $_GET['rm'];
	
    $rekammedis = mysqli_query($koneksidb,"select pendaftaran.*, pasien.nm_pasien from pendaftaran LEFT JOIN pasien ON pendaftaran.id_pasien = pasien.id_pasien where rm='$rm'");
    while($row=  mysqli_fetch_array($rekammedis)){
		
		
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Diagnosa Medis</h4>
		</div>
        <div class="modal-body">
			<form class="form" action="rekam_update.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
				<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Rekam Media</label>
								<input type="text" class="form-control" name="rm" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Rekam Medis" value="<?php echo $row['rm']; ?>" readonly>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label>Nama Pasien</label>
								<input type="text" class="form-control" name="nm_pasien" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Nama Pasien" value="<?php echo $row['nm_pasien']; ?>" readonly>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Keluhan</label>
						<textarea name='keluhan' class='form-control' readonly><?php echo $row['keluhan']; ?></textarea>			
					</div>
					<div class="form-group">
						<label>Diagnosa</label>
						<textarea name='diagnosa' class='form-control' readonly><?php echo $row['diagnosa']; ?></textarea>
					</div>
					<div class="form-group">
						<label>Terapi</label>
						<textarea name='terapi' class='form-control' readonly><?php echo $row['terapi']; ?></textarea>
					</div>
				
			</form>
            <?php
    }
            ?>
        </div>
    </div>
</div>
