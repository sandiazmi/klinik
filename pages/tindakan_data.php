<?php
	include_once "../library/seslogin.php";
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Tabel Data Tindakan
				<div class="pull-right">
					<a  href="#" data-target="#my-modal" data-toggle="modal" title='Tambah Pasien' class="btn btn-info btn-xs"><i class="fa fa-plus-circle"></i> Tambah Data Tindakan</a>
				</div>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr>
						<th width='8%'>NO.</th>
						<th width='10%'>KODE</th>
						<th>TINDAKAN</th>
						<th width='11%'>HARGA</th>
						<th width='10%'>AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php				
							
							$mySql = "SELECT * FROM tindakan ORDER BY kd_tindakan ASC";					
							$myQry = mysqli_query($koneksidb, $mySql);
							$nomor  = 0;
							while($myData = mysqli_fetch_array($myQry))
							{
								$nomor++;
						?>
							<tr>
								<td align="center"><?php echo $nomor; ?></td>
								<td align="center"><?php echo $myData['kd_tindakan']; ?></td>
								<td><?php echo $myData['nm_tindakan']; ?></td>
								<td align='right'><?php echo format_angka($myData['harga']); ?></td>
								<td align='center'><a  href="#" class="tindakan_ubah" id="<?php echo $myData['kd_tindakan']; ?>" title="Edit Data"><img src="../img/icons/edit.png" width="18" title='edit data'></a>
													<a href="#" class="tindakan_hapus" id="<?php echo $myData['kd_tindakan']; ?>" title="Hapus Data"><img src="../img/icons/delete.png" width="18" title='hapus data'></a>
								</td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Data Tindakan</h4>
			</div>
			<div class="modal-body">					
				<form class="form" action="tindakan_simpan.php" method="post" name="form1" target="_self" id="form-save">
					<div class="form-group">
						<label>Kode</label>
						<input type="text" class="form-control" name="kd_tindakan" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Kode Tindakan" value="<?= autonumber("tindakan", "kd_tindakan", 3, "T")?>" readonly>
					</div>
					<div class="form-group">
						<label>Nama Tindakan</label>
						<input type="text" class="form-control" name="nm_tindakan" placeholder="Nama Tindakan" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Nama Tindakan" required >
					</div>
					<div class="form-group">
						<label>Harga</label>
						<input type="number" class="form-control" name="harga" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Harga Tindakan" required >
					</div>
								
					<div class="modal-footer">
						<button type="submit" class="btn btn-outline-primary">
							Simpan
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- untuk edit -->
<div id="TindakanEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<!-- untuk hapus -->
<div id="TindakanHapus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>