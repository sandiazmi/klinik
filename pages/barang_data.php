<?php
	include_once "../library/seslogin.php";
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Tabel Data Barang
				<div class="pull-right">
					<a  href="#" data-target="#my-modal" data-toggle="modal" title='Tambah Barang' class="btn btn-info btn-xs"><i class="fa fa-plus-circle"></i> Tambah Data Barang</a>
				</div>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr>
							<th>NO.</th>
							<th>KODE</th>
							<th>BARANG</th>
							<th>BELI</th>
							<th>JUAL</th>
							<th>STOK</th>
							<th>AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php				
							
							$mySql = "SELECT * FROM barang ORDER BY kd_barang ASC";
										
							$myQry = mysqli_query($koneksidb, $mySql);
							$nomor  = 0;
							while($myData = mysqli_fetch_array($myQry))
							{
								$nomor++;
						?>
							<tr>
								<td align='center'><?php echo $nomor; ?></td>
								<td align='center'><?php echo $myData['kd_barang']; ?></td>
								<td><?php echo $myData['nm_barang']; ?></td>
								<td align='right'><?php echo format_angka($myData['harga_beli']); ?></td>
								<td align='right'><?php echo format_angka($myData['harga_jual']); ?></td>
								<td align='right'
											<?php  
											if ($myData['stok']>0 and $myData['stok']<=10) {?> 
												bgcolor="yellow" <?php ;}
											else if ($myData['stok']==0) {?>
												bgcolor="red" <?php ;
											}
											?>
											><?php echo $myData['stok']; ?></td>
								<td align='center'><a  href="#" class="barang_ubah" id="<?php echo $myData['kd_barang']; ?>" title="Edit Data"><img src="../img/icons/edit.png" width="18" title='edit data'></a>
									<a href="#" class="barang_hapus" id="<?php echo $myData['kd_barang']; ?>" title="Hapus Data"><img src="../img/icons/delete.png" width="18" title='hapus data'></span></a>
								</td>
							</tr>
						<?php  }	?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<div id="my-modal" class="modal fade text-xs-left" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Data Barang</h4>
			</div>
			<div class="modal-body">					
				<form class="form" action="barang_simpan.php" method="post" name="form1" target="_self" id="form-save">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Kategori</label>
								<select required name='kd_kategori' class="form-control" >
									<option value="" disabled selected>Pilih kategori</option>
										<?php
											  $bacaSql = 'SELECT * FROM kategori ORDER BY kd_kategori';
											  $bacaQry = mysqli_query($koneksidb, $bacaSql);
											  while ($bacaData = mysqli_fetch_array($bacaQry)) {
												echo "<option class='form-control' value='$bacaData[kd_kategori]' $cek> $bacaData[nm_kategori]</option>";
											  }
										?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Kode Barang</label>
								<input type="text" class="form-control" placeholder="issue title" name="kd_barang" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Kode Barang" value="<?= autonumber("barang", "kd_barang", 4, "B")?>" readonly>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Nama Barang</label>
						<input type="text" class="form-control" placeholder="Nama Barang" name="nm_barang" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Nama Barang" required>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Harga Beli</label>
								<input type="number" class="form-control" name="harga_beli" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Harga Beli" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Harga Jual</label>
								<input type="number" class="form-control" name="harga_jual" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Harga Jual" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Satuan</label>
								<select required name='kd_satuan' class="form-control" >
									<option value="" disabled selected>Pilih satuan</option>
										<?php
											  $bacaSql = 'SELECT * FROM satuan ORDER BY kd_satuan';
											  $bacaQry = mysqli_query($koneksidb, $bacaSql);
											  while ($bacaData = mysqli_fetch_array($bacaQry)) {
												echo "<option class='form-control' value='$bacaData[kd_satuan]' $cek> $bacaData[nm_satuan]</option>";
											  }
										?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Stok</label>
								<input type="number" class="form-control" name="stok" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Stok Barang">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<input type="text" id="issueinput7" class="form-control" placeholder="Keterangan" name="keterangan" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Keterangan" required>
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
<div id="BarangEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<!-- untuk hapus -->
<div id="BarangHapus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>