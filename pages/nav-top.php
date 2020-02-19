<div class="navbar-header" style='background-color:purple; width:100%;'>
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" style='width:100%; color:white; text-align:center;' href="menu.php"><b>SISTEM INFORMASI KLINIK</b></a>
</div>
<!-- /.navbar-header -->

<!-- /.navbar-top-links -->
<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav" id="side-menu">
			<li class="sidebar-search">
				<div class="input-group custom-search-form">
					<?php
						$Kode	= isset($_POST['txtKode']);
					?>
					<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
						<input name="txtKode" type="text" class="form-control" placeholder="Search...">
					</form>
					<span class="input-group-btn">
						<a  href="#" data-target="#pasien" data-toggle="modal" class="btn btn-default"><i class="fa fa-search"></i></a>
						
					</span>
				</div>
				<!-- /input-group -->
			</li>
			<li>
				<a href="menu.php"><i class="fa fa-home fa-fw"></i> Home</a>
			</li>
			<li>
				<a href="#"><i class="fa fa-wrench fa-fw"></i> Pengaturan<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="?page=User-Edit">Edit Profile</a>
					</li>
					<li>
						<a href="?page=Identitas-Edit">Identitas Klinik</a>
					</li>
					<li>
						<a href="?page=Satuan-Data">Satuan Barang</a>
					</li>
					<li>
						<a href="?page=Kategori-Data">Kategori Barang</a>
					</li>
					<li>
						<a href="?page=Tindakan-Data">Tindakan</a>
					</li>
				</ul>
				<!-- /.nav-second-level -->
			</li>
			<li>
				<a href="#"><i class="fa fa-table fa-fw"></i> Master<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="?page=Pasien-Data">Data Pasien</a>
					</li>
					<li>
						<a href="?page=Supplier-Data">Data Supplier</a>
					</li>
					<li>
						<a href="?page=Barang-Data">Data Barang</a>
					</li>
				</ul>
				<!-- /.nav-second-level -->
			</li>
			<li>
				<a href="#"><i class="fa fa-shopping-cart fa-fw"></i> Transaksi Apotik<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="?page=Pembelian-Baru">Pembelian Barang</a>
					</li>
					<li>
						<a href="?page=Penjualan-Baru">Penjualan Barang</a>
					</li>
				</ul>
				<!-- /.nav-second-level -->
			</li>
			<li>
				<a href="#"><i class="fa fa-user-md fa-fw"></i> Transaksi Klinik<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="?page=Laporan-Pendaftaran">Pendaftaran Pasien</a>
					</li>
					<li>
						<a href="?page=Laporan-Pendaftaran-Rawat">Rawat Jalan</a>
					</li>
				</ul>
				<!-- /.nav-second-level -->
			</li>
			<li>
				<a href="#"><i class="fa fa-print fa-fw"></i> Laporan Apotik<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="#">Data Pendaftaran</a>
					</li>
					<li>
						<a href="#">Pengobatan Pasien</a>
					</li>
				</ul>
				<!-- /.nav-second-level -->
			</li>
			<li>
				<a href="#"><i class="fa fa-print fa-fw"></i> Laporan Klinik<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="#">Data Pendaftaran</a>
					</li>
					<li>
						<a href="#">Pengobatan Pasien</a>
					</li>
				</ul>
				<!-- /.nav-second-level -->
			</li>
			<li>
				<a href="?page=Logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
			</li>
			
		</ul>
	</div>
	<!-- /.sidebar-collapse -->
</div>
