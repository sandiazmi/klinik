<?php
# KONTROL MENU PROGRAM
if($_GET) {
	// Jika mendapatkan variabel URL ?page
	switch($_GET['page']){				
		case '' :
			if(!file_exists ("main.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "main.php";	break;
			
		case 'Main' :
			if(!file_exists ("main.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "main.php";	break;
			
		case 'Login' :
			if(!file_exists ("login.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "login.php"; break;
			
		case 'Logout' :
			if(!file_exists ("logout.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "logout.php"; break;
			
		# 	EDIT
		case 'User-Edit' :
			if(!file_exists ("user_edit.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "user_edit.php";	 break;
		case 'Identitas-Edit' :
			if(!file_exists ("identitas_edit.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "identitas_edit.php";	 break;
			
		# 	SATUAN
		case 'Satuan-Data' :
			if(!file_exists ("satuan_data.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "satuan_data.php";	 break;
			
		# 	KATEGORI
		case 'Kategori-Data' :
			if(!file_exists ("kategori_data.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "kategori_data.php";	 break;
		
		# 	KATEGORI
		case 'Tindakan-Data' :
			if(!file_exists ("tindakan_data.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "tindakan_data.php";	 break;
			
		# 	BARANG
		case 'Barang-Data' :
			if(!file_exists ("barang_data.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "barang_data.php";	 break;
		
		case 'Rekam-Medis' :
			if(!file_exists ("rekammedis.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "rekammedis.php";	 break;
		
		# 	SUPPLIER
		case 'Supplier-Data' :
			if(!file_exists ("supplier_data.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "supplier_data.php";	 break;
			
		# 	PENJUALAN
		case 'Penjualan-Baru' :
			if(!file_exists ("penjualan_baru.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "penjualan_baru.php";	 break;
		
		case 'Delete-Jual' :
			if(!file_exists ("penjualan_baru.php")) die ("Sorry Empty Page!"); 
			include "penjualan_baru.php"; break;
			
		case 'Pencarian-Barang' :
			if(!file_exists ("cari_barang.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "cari_barang.php";	 break;
		
		# 	PENDAFTARAN PASIEN BARU
		case 'Pasien-Data' :
			if(!file_exists ("pasien_data.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "pasien_data.php";	 break;
		case 'Hapus-Pasien' :
			if(!file_exists ("pasien_hapus.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "pasien_hapus.php";	 break;
		case 'Pendaftaran-Pasien' :
			if(!file_exists ("pendaftaran_pasien.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "pendaftaran_pasien.php";	 break;
		case 'Pasien-Edit' :
			if(!file_exists ("pasien_edit.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "pasien_edit.php";	 break;
		case 'Pendaftaran' :
			if(!file_exists ("pendaftaran.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "pendaftaran.php";	 break;
		case 'Pendaftaran-Cetak' :
			if(!file_exists ("pendaftaran.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "pendaftaran.php";	 break;
		case 'Pendaftaran-Data' :
			if(!file_exists ("pendaftaran_data.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "pendaftaran_data.php";	 break;
		case 'Rekammedis-Data' :
			if(!file_exists ("rekammedis_data.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "rekammedis_data.php";	 break;
		
		# 	PENDAFTARAN PASIEN
		case 'Rawat-Baru' :
			if(!file_exists ("rawat_baru.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "rawat_baru.php";	 break;
		case 'Delete-Rawat' :
			if(!file_exists ("rawat_baru.php")) die ("Sorry Empty Page!"); 
			include "rawat_baru.php"; break;
		
		# 	PEMBAYARAN PASIEN
		case 'Pembayaran' :
			if(!file_exists ("pembayaran.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "pembayaran.php";	 break;
		case 'Delete-Pembayaran' :
			if(!file_exists ("pembayaran.php")) die ("Sorry Empty Page!"); 
			include "pembayaran.php"; break;
			
		# 	PEMBELIAN
		case 'Pembelian-Baru' :
			if(!file_exists ("pembelian_baru.php")) die ("Maaf Halaman Belum Tersedia"); 
			include "pembelian_baru.php";	 break;
		
		case 'Delete-Beli' :
			if(!file_exists ("pembelian_baru.php")) die ("Sorry Empty Page!"); 
			include "pembelian_baru.php"; break;
			
		# LAPORAN PEMBELIAN BARANG
			case 'Laporan-Pembelian-Periode' :
				if(!file_exists ("laporan_pembelian_periode.php")) die ("Sorry Empty Page!"); 
				include "laporan_pembelian_periode.php"; break;
				
			case 'Laporan-Pembelian-Supplier' :
				if(!file_exists ("laporan_pembelian_supplier.php")) die ("Sorry Empty Page!"); 
				include "laporan_pembelian_supplier.php"; break;
				
			# LAPORAN PENJUALAN BARANG
			case 'Laporan-Penjualan' :
				if(!file_exists ("laporan_penjualan.php")) die ("Sorry Empty Page!"); 
				include "laporan_penjualan.php"; break;
				
			case 'Laporan-Penjualan-Periode' :
				if(!file_exists ("laporan_penjualan_periode.php")) die ("Sorry Empty Page!"); 
				include "laporan_penjualan_periode.php"; break;
			
			# LAPORAN PENDAFTARAN
			case 'Laporan-Pendaftaran' :
				if(!file_exists ("laporan_pendaftaran_periode.php")) die ("Sorry Empty Page!"); 
				include "laporan_pendaftaran_periode.php"; break;
			case 'Laporan-Pendaftaran-Rawat' :
				if(!file_exists ("laporan_pendaftaran_rawat.php")) die ("Sorry Empty Page!"); 
				include "laporan_pendaftaran_rawat.php"; break;
			case 'Rawat-Nota' :
				if(!file_exists ("rawat_nota.php")) die ("Sorry Empty Page!"); 
				include "rawat_nota.php"; break;
			case 'Tagihan' :
				if(!file_exists ("tagihan.php")) die ("Sorry Empty Page!"); 
				include "tagihan.php"; break;
			
			# DOKUMENTASI
			case 'Dokumentasi' :
				if(!file_exists ("dokumentasi.php")) die ("Sorry Empty Page!"); 
				include "dokumentasi.php"; break;
		
	}
}
else {
	// Jika tidak mendapatkan variabel URL : ?page
	if(!file_exists ("main.php")) die ("Maaf Halaman Belum Tersedia"); 
	include "main.php";	
}
?>