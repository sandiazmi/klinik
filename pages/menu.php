<?php
	session_start();
	include_once "../library/koneksi.php";
	include_once "../library/library.php";
	include_once "../library/tanggal.php";
	// Baca Jam pada Komputer
	date_default_timezone_set("Asia/Jakarta");
	if (!isset($_SESSION['SES_USER'])) {
		 header("Location: pages/login.php");
	}
	if(isset($_POST['txtKode'])){
		$Kode = $_POST['txtKode'];
		echo "<meta http-equiv='refresh' content='0; url=?page=Rekam-Medis&amp;Kode=".$Kode."'>";
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head.php"; ?>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<?php include "nav-top.php"; ?>
        </nav>
        <div id="page-wrapper">
            <?php include "buka_file.php"; ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "script.php"; ?>
	<div id="pasien" class="modal fade text-xs-left" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Data Pasien</h4>
				</div>
				<div class="modal-body">					
					<?php		
						// Membaca variabel form
						$KeyWord	= isset($_GET['KeyWord']) ? $_GET['KeyWord'] : '';
						$dataCari	= isset($_POST['txtCari']) ? $_POST['txtCari'] : $KeyWord;

						// Jika tombol Cari diklik
						if(isset($_POST['btnCari'])){
							if($_POST) {
								$filterSql = "WHERE nm_pasien LIKE '%$dataCari%'";
							}
						}
						else {
							if($KeyWord){
								$filterSql = "WHERE nm_pasien LIKE '%$dataCari%'";
							}
							else {
								$filterSql = "";
							}
						}
					?>

					<div class="row">
						<div class="col-lg-12">								
							<!-- /.panel-heading -->
							<div class="panel-body">
								<div class="dataTable_wrapper">					
									<table id="" class="display table table-hover table-bordered" width="100%" cellspacing="0">
										<thead>
											<tr>
											<th width='15%'>ID</th>
											<th>NAMA PASIEN</th>
											<th>ALAMAT</th>
											</tr>
										</thead>
										<tbody>
											<?php
											
											$mySql = "SELECT * FROM pasien ORDER BY id_pasien ASC";
											$myQry = mysqli_query($koneksidb, $mySql);
											while($myData = mysqli_fetch_array($myQry))
											{
												$Kode = $myData['id_pasien'];
											
												?>
												<tr>
													<td><a href="?page=Rekam-Medis&amp;Kode=<?php echo $myData['id_pasien']; ?>" target="_self"><?php echo $myData['id_pasien']; ?></a></td>
													<td><?php echo $myData['nm_pasien']; ?></td>
													<td><?php echo $myData['alamat']; ?></td>
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
				</div>
			</div>
		</div>
	</div>

</body>

</html>
