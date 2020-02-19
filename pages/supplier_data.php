<?php
	include_once "../library/seslogin.php";
?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Tabel Data Supplier
				<div class="pull-right">
					<a  href="#" data-target="#my-modal" data-toggle="modal" title='Tambah Supplier' class="btn btn-info btn-xs"><i class="fa fa-plus-circle"></i> Tambah Data Supplier</a>
				</div>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr>
						<th width='8%'>NO.</th>
						<th>SUPPLIER</th>
						<th>ALAMAT</th>
						<th>AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php				
							
							$mySql = "SELECT * FROM supplier ORDER BY kd_supplier ASC";					
							$myQry = mysqli_query($koneksidb, $mySql);
							$nomor  = 0;
							while($myData = mysqli_fetch_array($myQry))
							{
								$nomor++;
						?>
							<tr>
								<td align="center"><?php echo $nomor; ?></td>
								<td><?php echo $myData['nm_supplier']; ?></td>
								<td><?php echo $myData['alamat'].', '.$myData['telephone']; ?></td>
								<td align='center'>	<a  href="#" class="kategori_ubah" id="<?php echo $myData['kd_kategori']; ?>" ><img src="../img/icons/edit.png" width="18" title='edit data'></a>
													<a href="#" class="kategori_hapus" id="<?php echo $myData['kd_kategori']; ?>" ><img src="../img/icons/delete.png" width="18" title='hapus data'></a>
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
				<h4 class="modal-title">Tambah Data Supplier</h4>
			</div>
			<div class="modal-body">					
				<form class="form" action="kategori_simpan.php" method="post" name="form1" target="_self" id="form-save">
					<div class="form-group">
						<label>Kode</label>
						<input type="text" class="form-control" name="kd_supplier" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Kode Supplier" value="<?= autonumber("supplier", "kd_supplier", 3, "S")?>" readonly>
					</div>
					<div class="form-group">
						<label>Nama Supplier</label>
						<input type="text" class="form-control" name="nm_supplier" placeholder="Nama Supplier" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Nama Supplier" required >
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea name='alamat' class='form-control' data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Alamat"></textarea>
					</div>
					<div class="form-group">
						<label>Telephone</label>
						<input type="text" class="form-control" name="telephone" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Telephone" required >
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