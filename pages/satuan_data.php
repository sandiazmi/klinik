<?php
	include_once "../library/seslogin.php";
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Tabel Data Satuan
				<div class="pull-right">
					<a  href="#" data-target="#my-modal" data-toggle="modal" title='Tambah Satuan' class="btn btn-info btn-xs"><i class="fa fa-plus-circle"></i> Tambah Data Satuan</a>
				</div>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr>
							<th width='8%'>NO.</th>
							<th width='10%'>KODE</th>
							<th>SATUAN</th>
							<th width='10%'>AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php				
							
							$mySql = "SELECT * FROM satuan ORDER BY kd_satuan ASC";
										
							$myQry = mysqli_query($koneksidb, $mySql);
							$nomor  = 0;
							while($myData = mysqli_fetch_array($myQry))
							{
								$nomor++;
						?>
							<tr>
								<td align='center'><?php echo $nomor; ?></td>
								<td align='center'><?php echo $myData['kd_satuan']; ?></td>
								<td><?php echo $myData['nm_satuan']; ?></td>
								<td align='center'><a  href="#" class="satuan_ubah" id="<?php echo $myData['kd_satuan']; ?>" title="Edit Data"><img src="../img/icons/edit.png" width="18" title='edit data'></a>
													<a href="#" class="satuan_hapus" id="<?php echo $myData['kd_satuan']; ?>" title="Hapus Data"><img src="../img/icons/delete.png" width="18" title='hapus data'></a>
								</td>
							</tr>
						<?php  }	?>
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
				<h4 class="modal-title">Tambah Data Satuan</h4>
			</div>
			<div class="modal-body">					
				<form class="form" action="satuan_simpan.php" method="post" name="form1" target="_self" id="form-save">
					<div class="form-group">
						<label>Kode</label>
						<input type="text" class="form-control" name="kd_satuan" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Kode Satuan" value="<?= autonumber("satuan", "kd_satuan", 2, "S")?>" readonly>
					</div>
					<div class="form-group">
						<label>Satuan</label>
						<input type="text" class="form-control" name="nm_satuan" placeholder="Satuan Barang" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Satuan Barang" required>
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
<div id="SatuanEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<!-- untuk hapus -->
<div id="SatuanHapus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>