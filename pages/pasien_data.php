<?php
	include_once "../library/seslogin.php";
?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Tabel Data Pasien
				<div class="pull-right">
					<a  href="?page=Pendaftaran-Pasien" title='Tambah Pasien' class="btn btn-info btn-xs"><i class="fa fa-plus-circle"></i> Tambah Data Pasien</a>
				</div>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="employee-grid" width="100%" cellspacing="0">					
						<thead>
							<tr>
								<th width='5%'>ID</th>
								<th>PASIEN</th>
								<th>ALAMAT</th>
								<th width='12%'>AKSI</th>
							</tr>
						</thead>
						
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- untuk edit -->
<div id="PasienEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<!-- untuk hapus -->
<div id="PasienHapus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>