<?php
	include_once "../library/seslogin.php";

	# HAPUS DAFTAR BARANG DI TMP
	if(isset($_GET['page'])){
		if(trim($_GET['page'])=="Delete-Jual"){
			# Hapus Tmp jika datanya sudah dipindah
			$mySql = "DELETE FROM tmp_penjualan WHERE id='".$_GET['id']."' AND username='".$_SESSION['SES_USER']."'";
			mysqli_query($koneksidb, $mySql);
		}
		if(trim($_GET['page'])=="Succses"){
			echo "<b>DATA BERHASIL DISIMPAN</b> <br><br>";
		}
	}
	// =========================================================================


	# TOMBOL TAMBAH (INPUT OBAT) DIKLIK
	if(isset($_POST['btnTambah'])){
		$pesanError = array();
		if (trim($_POST['txtKodeBarang'])=="") {
			$pesanError[] = "Data <b>Kode Barang belum diisi</b>, ketik Kode dari Keyboard atau dari <b>Barcode Reader</b> !";		
		}
		if (trim($_POST['txtJumlah'])=="" or ! is_numeric(trim($_POST['txtJumlah']))) {
			$pesanError[] = "Data <b>Jumlah Barang (Qty) belum diisi</b>, silahkan <b>isi dengan angka</b> !";		
		}
		
		# Baca variabel
		$txtKodeBarang	= $_POST['txtKodeBarang'];
		$txtKodeBarang	= str_replace("'","&acute;", $txtKodeBarang);
		$txtJumlah	= $_POST['txtJumlah'];

		# Skrip validasi Stok Barang
		# Jika stok < (kurang) dari Jumlah yang dibeli, maka buat Pesan Error
		$cekSql	= "SELECT stok FROM barang WHERE kd_barang='$txtKodeBarang'";
		$cekQry = mysqli_query($koneksidb, $cekSql);
		$cekRow = mysqli_fetch_array($cekQry);
		if ($cekRow['stok'] < $txtJumlah) {
			$pesanError[] = "Stok Barang untuk Kode <b>$txtKodeBarang</b> adalah <b> $cekRow[stok]</b>, tidak dapat dijual!";
		}
				
		# JIKA ADA PESAN ERROR DARI VALIDASI
		if (count($pesanError)>=1 ){
			echo "<div class='alert alert-warning'>";
			echo "<button class='close' data-dismiss='alert'>&times;</button>";
			echo "<strong>PERHATIAN !!</strong><br>";
					$noPesan=0;
					foreach ($pesanError as $indeks=>$pesan_tampil) { 
					$noPesan++;
						echo "<span style='font-size:12px'>&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
					} 
				echo "</div> <br>"; 
		}
		else {
			# SIMPAN KE DATABASE (tmp_penjualan)	
			// Periksa, apakah Kode barang atau Kode Barcode yang diinput ada di dalam tabel barang
			$mySql ="SELECT * FROM barang WHERE kd_barang='$txtKodeBarang'";
			$myQry = mysqli_query($koneksidb, $mySql);
			$myRow = mysqli_fetch_array($myQry);
			if (mysqli_num_rows($myQry) >= 1) {
				// Membaca kode barang/ barang
				$kodeBarang	= $myRow['kd_barang'];
				
				// Jika Kode ditemukan, masukkan data ke Keranjang (TMP)
				$tmpSql 	= "INSERT INTO tmp_penjualan (kd_barang, jumlah,  username) 
							VALUES ('$kodeBarang', '$txtJumlah',  '".$_SESSION['SES_USER']."')";
				mysqli_query($koneksidb, $tmpSql);
			}
		}
	}

	# ========================================================================================================
	# JIKA TOMBOL SIMPAN TRANSAKSI DIKLIK
	if(isset($_POST['btnSimpan'])){
		$pesanError = array();
		if (trim($_POST['txtTanggal'])=="") {
			$pesanError[] = "Data <b>Tanggal Transaksi</b> belum diisi, pilih pada kalender !";		
		}
		if (trim($_POST['txtUangBayar'])==""  or ! is_numeric(trim($_POST['txtUangBayar']))) {
			$pesanError[] = "Data <b> Uang Bayar</b> belum diisi, isi dengan uang (Rp) !";		
		}
		if (trim($_POST['txtUangBayar']) < trim($_POST['txtTotBayar'])) {
			$pesanError[] = "Data <b> Uang Bayar Belum Cukup</b>.  
							 Total belanja adalah <b> Rp. ".format_angka($_POST['txtTotBayar'])."</b>";		
		}
		
		# Periksa apakah sudah ada barang yang dimasukkan
		$tmpSql ="SELECT COUNT(*) As qty FROM tmp_penjualan WHERE username='".$_SESSION['SES_USER']."'";
		$tmpQry = mysqli_query($koneksidb, $tmpSql);
		$tmpData = mysqli_fetch_array($tmpQry);
		if ($tmpData['qty'] < 1) {
			$pesanError[] = "<b>DAFTAR OBAT MASIH KOSONG</b>, belum ada barang yang dimasukan, <b>minimal 1 barang</b>.";
		}
		
		# Baca variabel from
		$txtTanggal 	= $_POST['txtTanggal'];
		$txtPelanggan	= $_POST['txtPelanggan'];
		$txtKeterangan	= $_POST['txtKeterangan'];
		$txtUangBayar	= $_POST['txtUangBayar'];
				
				
		# JIKA ADA PESAN ERROR DARI VALIDASI
		if (count($pesanError)>=1 ){
			echo "<div class='alert alert-info alert-dismissible fade in mb-2' role='alert'>";
			echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>";
			echo "<strong><h6>PERHATIAN !!</strong></h6>";
				$noPesan=0;
				foreach ($pesanError as $indeks=>$pesan_tampil) { 
				$noPesan++;
					echo "<h6>&nbsp;&nbsp; $noPesan. $pesan_tampil</h6>";	
				} 
			echo "</div>";
		}
		else {
			# SIMPAN DATA KE DATABASE
			# Jika jumlah error pesanError tidak ada, maka penyimpanan dilakukan. Data dari tmp dipindah ke tabel penjualan dan penjualan_item
			$noTransaksi = autonumber("penjualan", "no_penjualan", 5, "PJ");
			$mySql	= "INSERT INTO penjualan SET 
							no_penjualan='$noTransaksi', 
							tgl_penjualan='".InggrisTgl($_POST['txtTanggal'])."', 
							pelanggan='$txtPelanggan', 
							keterangan='$txtKeterangan', 
							uang_bayar='$txtUangBayar',
							username='".$_SESSION['SES_USER']."'";
			mysqli_query($koneksidb, $mySql);
			
			# SIMPAN DATA TMP KE PENJUALAN_ITEM
			# Ambil semua data barang yang dipilih, berdasarkan kasir yg login
			$tmpSql ="SELECT barang.*, tmp.jumlah FROM barang, tmp_penjualan As tmp
						WHERE barang.kd_barang = tmp.kd_barang ";
			$tmpQry = mysqli_query($koneksidb, $tmpSql);
			while ($tmpData = mysqli_fetch_array($tmpQry)) {
				// Baca data dari tabel barang dan jumlah yang dibeli dari TMP
				$dataKode 	= $tmpData['kd_barang'];
				$dataHargaM	= $tmpData['harga_beli'];
				$dataHargaJ	= $tmpData['harga_jual'];
				$dataJumlah	= $tmpData['jumlah'];
				
				// MEMINDAH DATA, Masukkan semua data di atas dari tabel TMP ke tabel ITEM
				$itemSql = "INSERT INTO penjualan_item SET 
										no_penjualan='$noTransaksi', 
										kd_barang='$dataKode', 
										harga_beli='$dataHargaM', 
										harga_jual='$dataHargaJ', 
										jumlah='$dataJumlah'";
				mysqli_query($koneksidb, $itemSql);
				
				// Skrip Update stok
				$stokSql = "UPDATE barang SET stok = stok - $dataJumlah WHERE kd_barang='$dataKode'";
				mysqli_query($koneksidb, $stokSql);
			}
			
			# Kosongkan Tmp jika datanya sudah dipindah
			$hapusSql = "DELETE FROM tmp_penjualan WHERE username='".$_SESSION['SES_USER']."'";
			mysqli_query($koneksidb, $hapusSql);
			
			// Jalankan skrip Nota
			echo "<script>";
			echo "window.open('penjualan_nota.php?noNota=$noTransaksi', width=330,height=330,left=100, top=25)";
			echo "</script>";
			
			// Refresh form
			echo "<meta http-equiv='refresh' content='0; url=?page=Penjualan-Baru'>";

		}	
	}

	# TAMPILKAN DATA KE FORM
	$KdBarang= isset($_GET['KdBarang']) ?  $_GET['KdBarang'] : '';
	$mySql			= "SELECT kd_barang, nm_barang, harga_jual FROM barang WHERE kd_barang='$KdBarang'";
	$myQry			= mysqli_query($koneksidb, $mySql);
	$myData 		= mysqli_fetch_array($myQry);
	$databarang		= $myData['nm_barang'];
	$dataharga		= $myData['harga_jual'];
	$noTransaksi 	= autonumber("penjualan", "no_penjualan", 5, "PJ");
	$dataTanggal 	= isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : date('d-m-Y');
	$dataPelanggan	= isset($_POST['txtPelanggan']) ? $_POST['txtPelanggan'] : 'Pasien';
	$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '...';
	$dataUangBayar	= isset($_POST['txtUangBayar']) ? $_POST['txtUangBayar'] : '';

	# Kode pasien
	if($KdBarang=="") {
		$KdBarang= isset($_POST['txtKodeBarang']) ? $_POST['txtKodeBarang'] : '';
	}
?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Transaksi Penjualan Barang
			</div>
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self"> 
					<table class='table table-bordered'>
						<tr>
							<td align='center'>Nomor</td>
							<td align='center'>Tanggal</td>
							<td align='center'>Jam</td>
							<td align='center'>Konsumen</td>
							<td align='center'>Keterangan</td>
						</tr>
						<tr>
						  <td><input name="txtNomor" class='form-control' value="<?php echo $noTransaksi; ?>" readonly="readonly" disabled /></td>
						  <td><input name="txtTanggal" type="text" class="tcal form-control" value="<?php echo $dataTanggal; ?>" /></td>
						  <td>
								<div id="jam">
									<script language="javascript">
										jam();
										function jam(){
											var time = new Date();
											document.getElementById('jam').innerHTML = time.getHours()+ ":" + time.getMinutes() + ":" + time.getSeconds();
											setTimeout("jam()", 1000);
										}
									</script>
								</div>
						  </td>
						  <td><input name="txtPelanggan" class='form-control' value="<?php echo $dataPelanggan; ?>" /></td>
						  <td><input name="txtKeterangan" class='form-control' value="<?php echo $dataKeterangan; ?>" /></td>
						</tr>
					</table>
					<table class='table table-bordered'>
						<tr>
							<td align='center' width='17%'>Kode</td>
							<td align='center'>Nama Barang</td>
							<td align='center' width='15%'>Harga</td>
							<td align='center' width='10%'>Jumlah</td>
							<td align='center' width='10%'>Jual</td>
							
						</tr>
						<tr>
							<td>
								<div class="input-group">
									<input name="txtKodeBarang" class='form-control' value="<?php echo $KdBarang; ?>" />
									<span class="input-group-btn">
										<a  href="#" data-target="#my-modal" data-toggle="modal" class="btn btn-default"><i class="fa fa-search"></i></a>
									</span>
								</div>
							</td>
							<td><input name="txtNamaBarang" class='form-control'value="<?php echo $databarang; ?>" readonly /></td>
							<td><input name="txtHrgObat" class='form-control'value="<?php echo format_angka($dataharga); ?>" readonly /></td>
							<td><input type='number' class="angkaC form-control" name="txtJumlah" size="10" maxlength="4" value="1" 
								 onblur="if (value == '') {value = '1'}" 
								 onfocus="if (value == '1') {value =''}"/></td>
							<td align='center'>
								<button type="submit" name="btnTambah" value="Simpan" class="btn btn-primary">
									<span class="icon icon-cart"></span> OK</button>
							</td>
						</tr>
					</table>
					<table class='table table-bordered'>	
						<tr>
						  <th bgcolor="#CCCCCC">NO.</th>
						  <th bgcolor="#CCCCCC">KODE</th>
						  <th bgcolor="#CCCCCC" width='30%'>NAMA BARANG</th>
						  <th bgcolor="#CCCCCC">HARGA</th>
						  <th align="right" width='10%' bgcolor="#CCCCCC">JUMLAH</th>
						  <th align="right" width='18%' bgcolor="#CCCCCC">SUB TOTAL(Rp)</th>
						  <th align="center" bgcolor="#CCCCCC">HAPUS</th>
						</tr>
						<?php
							// Qury menampilkan data dalam Grid TMP_Penjualan 
							$tmpSql ="SELECT barang.*, tmp.id, tmp.jumlah FROM barang, tmp_penjualan As tmp
									WHERE barang.kd_barang=tmp.kd_barang AND tmp.username='".$_SESSION['SES_USER']."'
									ORDER BY barang.kd_barang ";
							$tmpQry = mysqli_query($koneksidb, $tmpSql);
							$nomor=0;  $hargaDiskon = 0;   $totalBayar	= 0;  $jumlahbarang	= 0;
							while($tmpData = mysqli_fetch_array($tmpQry)) {
								$nomor++;
								$subSotal 	= $tmpData['jumlah'] * $tmpData['harga_jual'];
								$totalBayar	= $totalBayar + $subSotal;
								$jumlahbarang	= $jumlahbarang + $tmpData['jumlah'];
						?>
						<tr>
						  <td><?php echo $nomor; ?></td>
						  <td><?php echo $tmpData['kd_barang']; ?></b></td>
						  <td><?php echo $tmpData['nm_barang']; ?></td>
						  <td align="right"><?php echo format_angka($tmpData['harga_jual']); ?></td>
						  <td align="right"><?php echo $tmpData['jumlah']; ?></td>
						  <td align="right"><?php echo format_angka($subSotal); ?></td>
						  <td align='center'><a href="?page=Delete-Jual&id=<?php echo $tmpData['id']; ?>" target="_self"><img src="../img/icons/delete.png" width="18" title='hapus data'></a></td>
						</tr>
						<?php } ?>
						<tr>
						  <td colspan="4" align="right" bgcolor="#F5F5F5"><strong>GRAND TOTAL   (Rp.) : </strong></td>
						  <td align="right" bgcolor="#F5F5F5"><strong><?php echo $jumlahbarang; ?></strong></td>
						  <td align="right" bgcolor="#F5F5F5"><strong><?php echo format_angka($totalBayar); ?></strong></td>
						  <td bgcolor="#F5F5F5">&nbsp;</td>
						</tr>
						<tr>
						  <td colspan="4" align="right" bgcolor="#F5F5F5"><strong>UANG BAYAR (Rp.) : </strong></td>
						  <td bgcolor="#F5F5F5"><input name="txtTotBayar" type="hidden" value="<?php echo $totalBayar; ?>" /></td>
						  <td bgcolor="#F5F5F5"><input type='number' name="txtUangBayar" class='form-control' value="<?php echo $dataUangBayar; ?>" size="16" maxlength="16"/></td>
						  <td bgcolor="#F5F5F5"><button type="submit" name="btnSimpan" value="Simpan" class="btn btn-primary">
									<span class="fa fa-save"></span> Simpan</button></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>


<div id="my-modal" class="modal fade text-xs-left" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tabel Barang</h4>
			</div>
			<div class="modal-body">					
				<?php		
					// Membaca variabel form
					$KeyWord	= isset($_GET['KeyWord']) ? $_GET['KeyWord'] : '';
					$dataCari	= isset($_POST['txtCari']) ? $_POST['txtCari'] : $KeyWord;

					// Jika tombol Cari diklik
					if(isset($_POST['btnCari'])){
						if($_POST) {
							$filterSql = "WHERE nm_barang LIKE '%$dataCari%'";
						}
					}
					else {
						if($KeyWord){
							$filterSql = "WHERE nm_barang LIKE '%$dataCari%'";
						}
						else {
							$filterSql = "";
						}
					}
				?>

				<div class="row">										
					<div class="panel-body">
						<table id="" class="display table table-hover table-bordered" width="100%" cellspacing="0">
							<thead>
								<tr>
								<th>Kode</th>
								<th>Nama Barang</th>
								<th>Harga Jual</th>
								<th>Stok</th>
								</tr>
							</thead>
							<tbody>
								<?php
								
								$mySql = "SELECT * FROM barang ORDER BY kd_barang DESC";
								$myQry = mysqli_query($koneksidb, $mySql);
								while($myData = mysqli_fetch_array($myQry))
								{
									$Kode = $myData['kd_barang'];
									?>
									<tr>
										<td><a href="?page=Penjualan-Baru&amp;KdBarang=<?php echo $myData['kd_barang']; ?>" target="_self"><?php echo $myData['kd_barang']; ?></a></td>
										<td><?php echo $myData['nm_barang']; ?></td>
										<td align='center'><?php echo format_angka($myData['harga_jual']); ?></td>
										<td align='right'
											<?php  
											if ($myData['stok']>0 and $myData['stok']<=10) {?> 
												bgcolor="yellow" <?php ;}
											else if ($myData['stok']==0) {?>
												bgcolor="red" <?php ;
											}
											?>
											><?php echo $myData['stok']; ?></td>
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