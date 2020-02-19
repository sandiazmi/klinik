<?php
	include_once "../library/seslogin.php";

	# SKRIP HAPUS DATA TMP
	if(isset($_GET['page'])){
		if(trim($_GET['page'])=="Delete-Beli"){
			# Hapus Tmp jika datanya sudah dipindah
			$mySql = "DELETE FROM tmp_pembelian WHERE kd_barang='".$_GET['Kode']."'";
			mysqli_query($koneksidb, $mySql);
		}
	}
	// =========================================================================

	# TOMBOL TAMBAH (SETELAH MEMILIH BARANG DARI COMBO) DIKLIK
	if(isset($_POST['btnTambah'])){
		# Baca Data dari Form
		$cmbObat	= $_POST['txtKodeBarang'];
		$txtHarga	= $_POST['txtHarga'];
		$txtJumlah	= $_POST['txtJumlah'];
				
		# Validasi Kotak isi Form
		$pesanError = array();
		if (trim($cmbObat)=="") {
			$pesanError[] = "Data <b>Kode Barang belum diisi</b>, silahkan diisi atau pilih!";
		}
		if (trim($txtHarga)=="" or ! is_numeric(trim($txtHarga))) {
			$pesanError[] = "Data <b>Harga Pembelian (Rp) belum diisi</b>, silahkan <b>isi dengan angka</b> !";
		}
		if (trim($txtJumlah)=="" or ! is_numeric(trim($txtJumlah))) {
			$pesanError[] = "Data <b>Jumlah barang (Qty) belum diisi</b>, silahkan <b>isi dengan angka</b> !";
		}
		
		# JIKA ADA PESAN ERROR DARI VALIDASI
		if (count($pesanError)>=1 ){
			echo "<div class='alert alert-warning'>";
			echo "<button class='close' data-dismiss='alert'>&times;</button>";
			echo "<strong>PERHATIAN !!</strong><br>";
					$noPesan=0;
					foreach ($pesanError as $indeks=>$pesan_tampil) { 
					$noPesan++;
						echo "<span style='font-size:12px'>&nbsp;&nbsp; $noPesan. $pesan_tampil</span><br>";	
					} 
			echo "</div> <br>"; 
		}
		else {
			# SIMPAN KE DATABASE (tmp_pembelian)	
			$tmpSql 	= "INSERT INTO tmp_pembelian (kd_barang, harga, jumlah) 
						VALUES ('$cmbObat', '$txtHarga', '$txtJumlah')";
			mysqli_query($koneksidb, $tmpSql);
		}
	}
	// ============================================================================

	# ========================================================================================================
	# JIKA TOMBOL SIMPAN TRANSAKSI DIKLIK
	if(isset($_POST['btnSimpan'])){
		# Baca variabel data from
		$txtTanggal 	= $_POST['txtTanggal'];
		$cmbSupplier	= $_POST['cmbSupplier'];
		$txtKeterangan	= $_POST['txtKeterangan'];
		
		# Validasi Kotak isi Form
		$pesanError = array();
		if (trim($txtTanggal)=="") {
			$pesanError[] = "Data <b>Tanggal Transaksi</b> belum diisi, pilih pada kalender !";		
		}
		if (trim($cmbSupplier)=="") {
			$pesanError[] = "Data <b>Supplier</b> belum diisi, pilih pada combo !";		
		}
		
		# Periksa apakah sudah ada barang yang dimasukkan
		$tmpSql ="SELECT COUNT(*) As qty FROM tmp_pembelian";
		$tmpQry = mysqli_query($koneksidb, $tmpSql);
		$tmpData = mysqli_fetch_array($tmpQry);
		if ($tmpData['qty'] < 1) {
			$pesanError[] = "<b>DAFTAR BARANG MASIH KOSONG</b>, belum ada barang yang dimasukan, <b>minimal 1 barang</b>.";
		}
		
				
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
			// Jika jumlah error pesanError tidak ada, maka penyimpanan dilakukan. 
			// Data dari tmp dipindah ke tabel pembelian dan pembelian_item 
			$noTransaksi = autonumber("pembelian", "no_pembelian", 5, "PB");
			$mySql	= "INSERT INTO pembelian SET 
							no_pembelian='$noTransaksi', 
							tgl_pembelian='".InggrisTgl($txtTanggal)."', 
							kd_supplier='$cmbSupplier', 
							keterangan='$txtKeterangan'";
			mysqli_query($koneksidb, $mySql);
			
			# …LANJUTAN, SIMPAN DATA
			# Ambil semua data barang yang ada di TMP (keranjang)
			$tmpSql ="SELECT * FROM  tmp_pembelian ORDER BY kd_barang";
			$tmpQry = mysqli_query($koneksidb, $tmpSql);
			while ($tmpData = mysqli_fetch_array($tmpQry)) {
				// Baca data dari tabel barang dan jumlah yang dibeli dari TMP
				$dataKode 	= $tmpData['kd_barang'];
				$dataHarga	= $tmpData['harga'];
				$dataJumlah	= $tmpData['jumlah'];
				
				// MEMINDAH DATA, Masukkan semua data di atas dari tabel TMP ke tabel ITEM
				$itemSql = "INSERT INTO pembelian_item SET 
										no_pembelian='$noTransaksi', 
										kd_barang='$dataKode', 
										harga='$dataHarga', 
										jumlah='$dataJumlah'";
				mysqli_query($koneksidb, $itemSql);
				
				// Skrip Update stok
				$stokSql = "UPDATE barang SET stok = stok + $dataJumlah WHERE kd_barang ='$dataKode'";
				mysqli_query($koneksidb, $stokSql);
				
				// Skrip Update Harga Beli (Modal)
				$stokSql = "UPDATE barang SET harga_beli = $dataHarga WHERE kd_barang ='$dataKode'";
				mysqli_query($koneksidb, $stokSql);
				
			}
			
			# Kosongkan Tmp jika datanya sudah dipindah
			$hapusSql = "DELETE FROM tmp_pembelian";
			mysqli_query($koneksidb, $hapusSql);
			
			// Refresh form
			echo "<meta http-equiv='refresh' content='0; url=?page=Pembelian-Baru'>";
		}	
	}

	# VARIABEL DATA UNTUK FORM
	$KdBarang		= isset($_GET['KdBarang']) ?  $_GET['KdBarang'] : '';
	$mySql			= "SELECT kd_barang, nm_barang,harga_beli FROM barang WHERE kd_barang='$KdBarang'";
	$myQry			= mysqli_query($koneksidb, $mySql);
	$myData 		= mysqli_fetch_array($myQry);
	$nm_barang		= $myData['nm_barang'];
	$hg_barang		= $myData['harga_beli'];
	$noTransaksi 	= autonumber("pembelian", "no_pembelian", 5, "PB");
	$dataTanggal 	= isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : date('d-m-Y');
	$dataSupplier	= isset($_POST['cmbSupplier']) ? $_POST['cmbSupplier'] : '';
	$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
	$dataKategori	= isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : '';
	# Kode Obat
	if($KdBarang=="") {
		$KdBarang= isset($_POST['txtKodeBarang']) ? $_POST['txtKodeBarang'] : '';
	}
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Transaksi Pembelian Barang
			</div>
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
						<table class='table table-bordered'>
							<table class='table table-bordered'>
								<tr>
									<td align='center'>Nomor</td>
									<td align='center'>Tanggal</td>
									<td align='center'>Jam</td>
									<td align='center'>Supplier</td>
									<td align='center'>Keterangan</td>
								</tr>
								<tr>
									<td><input name="txtNomor" class='form-control' value="<?php echo $noTransaksi; ?>" readonly="readonly" disabled /></td>
									<td><input name="txtTanggal" type="text" class="tcal form-control" value="<?php echo $dataTanggal; ?>"  /></td>
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
									<td><select name="cmbSupplier" class='form-control'>
											<option value="" selected>-- PILIH SUPLIER --</option>
												<?php
											  $bacaSql = "SELECT * FROM supplier ORDER BY kd_supplier";
											  $bacaQry = mysqli_query($koneksidb, $bacaSql);
											  while ($bacaData = mysqli_fetch_array($bacaQry)) {
												if ($bacaData['kd_supplier'] == $dataSupplier) {
													$cek = " selected";
												} else { $cek=""; }
												echo "<option value='$bacaData[kd_supplier]' $cek>$bacaData[nm_supplier]</option>";
											  }
											  ?>
										</select>
									 </td>
									 <td><input name="txtKeterangan" class='form-control' value="<?php echo $dataKeterangan; ?>" /></td>
								</tr>
							</table>
							<table class='table table-bordered'>
								<tr>
								<td align='center' width='18%'>Kode</td>
								<td align='center'>Nama Barang</td>
								<td align='center' width='20%'>Harga</td>
								<td align='center' width='10%'>Jumlah</td>
								<td align='center' width='10%'>Beli</td>
								
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
									<td><input name="txtNmBarang" class='form-control'value="<?php echo $nm_barang; ?>" readonly /></td>
									<td><input name="txtHarga" class='form-control' value="<?php echo $hg_barang; ?>" readonly /></td>
									<td> 
										<input type='number' class="angkaC form-control" name="txtJumlah" size="4" maxlength="4" value="1" 
												 onblur="if (value == '') {value = '1'}" 
												 onfocus="if (value == '1') {value =''}"/>
									</td>
									<td align='center'>
										<button type="submit" name="btnTambah" value="Simpan" class="btn btn-primary">
											<span class="icon icon-cart"></span> OK</button>
									</td>
								</tr>
							</table>
						</table>
						<table class='table table-bordered'>
							<tr>
							  <th bgcolor="#CCCCCC">NO.</th>
							  <th bgcolor="#CCCCCC">KODE</th>
							  <th bgcolor="#CCCCCC">NAMA BARANG</th>
							  <th align="right" bgcolor="#CCCCCC">HARGA BELI</th>
							  <th align="right" bgcolor="#CCCCCC">JUMLAH</th>
							  <th align="right" bgcolor="#CCCCCC">SUBTOTAL</th>
							  <th align="center" bgcolor="#CCCCCC">HAPUS</th>
							</tr>
							<?php
							// deklarasi variabel
							$hargaDiskon= 0; 
							$totalBayar	= 0; 
							$jumlahbarang	= 0;
							
							// Qury menampilkan data dalam Grid TMP_Pembelian 
							$tmpSql ="SELECT barang.nm_barang, tmp.* FROM tmp_pembelian As tmp
									LEFT JOIN barang ON tmp.kd_barang = barang.kd_barang 
									ORDER BY tmp.kd_barang ";
							$tmpQry = mysqli_query($koneksidb, $tmpSql);
							$nomor=0;  
							while($tmpData = mysqli_fetch_array($tmpQry)) {
								$nomor++;
								$subSotal 	= $tmpData['harga'] * $tmpData['jumlah'];
								$totalBayar	= $totalBayar + $subSotal;
								$jumlahbarang	= $jumlahbarang + $tmpData['jumlah'];
							?>
							<tr>
							  <td><?php echo $nomor; ?></td>
							  <td><?php echo $tmpData['kd_barang']; ?></b></td>
							  <td><?php echo $tmpData['nm_barang']; ?></td>
							  <td align="right"><?php echo format_angka($tmpData['harga']); ?></td>
							  <td align="right"><?php echo format_angka($tmpData['jumlah']); ?></td>
							  <td align="right"><?php echo format_angka($subSotal); ?></td>
							  <td align='center'><a href="?page=Delete-Beli&Kode=<?php echo $tmpData['kd_barang']; ?>" target="_self"><img src="../img/icons/delete.png" width="18" title='hapus data'></a></td>
							</tr>
							<?php } ?>
							<tr>
							  <td colspan="4" align="right" bgcolor="#F5F5F5"><strong>GRAND TOTAL   (Rp.) : </strong></td>
							  <td align="right" bgcolor="#F5F5F5"><b><?php echo format_angka($jumlahbarang); ?></b></td>
							  <td align="right" bgcolor="#F5F5F5"><b><?php echo format_angka($totalBayar); ?></b></td>
							  <td bgcolor="#F5F5F5">	
								<button type="submit" name="btnSimpan" value="Simpan" class="btn btn-primary">
									<span class="fa fa-save"></span> Simpan 
								</button>
							  </td>
							</tr>
						</table>
					</div>
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
								<th>KODE</th>
								<th>NAMA BARANG</th>
								<th>HARGA BELI</th>
								<th>STOK</th>
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
										<td><a href="?page=Pembelian-Baru&amp;KdBarang=<?php echo $myData['kd_barang']; ?>" target="_self"><?php echo $myData['kd_barang']; ?></a></td>
										<td><?php echo $myData['nm_barang']; ?></td>
										<td align='right'><?php echo format_angka($myData['harga_beli']); ?></td>
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