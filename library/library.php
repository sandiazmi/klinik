<?php
# Pengaturan tanggal komputer
date_default_timezone_set("Asia/Jakarta");

# Fungsi membuat kode pasien otomatis
function autoid($tabel, $kolom, $field, $lebar=0, $awalan=''){
		$koneksiDb = mysqli_connect("localhost", "root", "", "klinik_pro");		
		$query="select $kolom from $tabel where SUBSTRING($field,1,1)='$awalan' order by $kolom desc limit 1";
		$hasil=mysqli_query($koneksiDb,$query);
		$jumlahrecord = mysqli_num_rows($hasil);
		if($jumlahrecord == 0)
			$nomor=1;
		else{
			$row=mysqli_fetch_array($hasil);
			$nomor=intval(substr($row[0],strlen($awalan)))+1;
		}
		if($lebar>0)
			$angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
		else
			$angka = $awalan.$nomor;
		return $angka;
	}

# Fungsi membuat nomor antrian
	function nomorAntrian($tanggal) {
		//$tanggal dalam format Y-m-d
		$antriKe= 0;
		$koneksiDb = mysqli_connect("localhost", "root", "", "klinik_pro");
		$mySql	= "SELECT count(*) as jum_antri FROM pendaftaran WHERE tgl_janji='$tanggal' ORDER BY nomor_antri";
		$myQry 	= mysqli_query($koneksiDb, $mySql);
		$myData = mysqli_fetch_array($myQry);
		if(mysqli_num_rows($myQry) >=1) {
			$antriKe	= $myData['jum_antri'] + 1;
		}
		else {
			$antriKe	= 1;
		}
		
		return $antriKe;
	}

# Fungsi untuk membuat kode automatis
function autonumber($tabel, $kolom, $lebar=0, $awalan=''){
	$koneksiDb = mysqli_connect("localhost", "root", "", "klinik_pro");		
	$query="select $kolom from $tabel order by $kolom desc limit 1";
	$hasil=mysqli_query($koneksiDb,$query);
	$jumlahrecord = mysqli_num_rows($hasil);
	if($jumlahrecord == 0)
		$nomor=1;
	else{
		$row=mysqli_fetch_array($hasil);
		$nomor=intval(substr($row[0],strlen($awalan)))+1;
	}
	if($lebar>0)
		$angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
	else
		$angka = $awalan.$nomor;
	return $angka;
}

function autorm($tabel, $kolom, $field, $lebar=0, $awalan=''){
	$koneksiDb = mysqli_connect("localhost", "root", "", "klinik_pro");		
	$query="select $kolom from $tabel where $field='$awalan' order by $kolom desc limit 1";
	$hasil=mysqli_query($koneksiDb,$query);
	$jumlahrecord = mysqli_num_rows($hasil);
	if($jumlahrecord == 0)
		$nomor=1;
	else{
		$row=mysqli_fetch_array($hasil);
		$nomor=intval(substr($row[0],strlen($awalan)))+1;
	}
	if($lebar>0)
		$angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
	else
		$angka = $awalan.$nomor;
	return $angka;
}

# Fungsi untuk membalik tanggal dari format Indo (d-m-Y) -> English (Y-m-d)
function InggrisTgl($tanggal){
	$tgl=substr($tanggal,0,2);
	$bln=substr($tanggal,3,2);
	$thn=substr($tanggal,6,4);
	$tanggal="$thn-$bln-$tgl";
	return $tanggal;
}

# Fungsi untuk membalik tanggal dari format English (Y-m-d) -> Indo (d-m-Y)
function CardTgl($tanggal){
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal="$tgl $bln $thn";
	return $tanggal;
}

function IndonesiaTgl($tanggal){
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal="$tgl-$bln-$thn";
	return $tanggal;
}

function IndonesiaYear($tahun){
	$thn=substr($tahun,0,4);
	$tahun="$thn";
	return $tahun;
}

# Fungsi untuk membalik tanggal dari format English (Y-m-d) -> Indo (d-m-Y)
function Indonesia2Tgl($tanggal){
	$namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
					 "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
					 
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal ="$tgl ".$namaBln[$bln]." $thn";
	return $tanggal;
}

function hitungHari($myDate1, $myDate2){
        $myDate1 = strtotime($myDate1);
        $myDate2 = strtotime($myDate2);
 
        return ($myDate2 - $myDate1)/ (24 *3600);
}

# Fungsi untuk membuat format rupiah pada angka (uang)
function format_angka($angka) {
	$hasil =  number_format($angka,0, ",",".");
	return $hasil;
}

# Fungsi untuk format tanggal, dipakai plugins Callendar
function form_tanggal($nama,$value=''){
	echo" <input type='text' name='$nama' id='$nama' size='11' maxlength='20' value='$value'/>&nbsp;
	<img src='images/calendar-add-icon.png' align='top' style='cursor:pointer; margin-top:7px;' alt='kalender'onclick=\"displayCalendar(document.getElementById('$nama'),'dd-mm-yyyy',this)\"/>			
	";
}

function angkaTerbilang($x){
  $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return angkaTerbilang($x - 10) . " Belas";
  elseif ($x < 100)
    return angkaTerbilang($x / 10) . " Puluh" . angkaTerbilang($x % 10);
  elseif ($x < 200)
    return " Seratus" . angkaTerbilang($x - 100);
  elseif ($x < 1000)
    return angkaTerbilang($x / 100) . " Ratus" . angkaTerbilang($x % 100);
  elseif ($x < 2000)
    return " Seribu" . angkaTerbilang($x - 1000);
  elseif ($x < 1000000)
    return angkaTerbilang($x / 1000) . " Ribu" . angkaTerbilang($x % 1000);
  elseif ($x < 1000000000)
    return angkaTerbilang($x / 1000000) . " Juta" . angkaTerbilang($x % 1000000);
}

$tanggal=date("Y-m-d H:i:s");

//fungsi untuk Logout otomatis
function login_validate() {
	//ukuran waktu dalam detik
	$timer=10;
	//untuk menambah masa validasi
	$_SESSION["expires_by"] = time() + $timer;
}

function login_check() {
	//berfungsi untuk mengambil nilai dari session yang pertama
	$exp_time = $_SESSION["expires_by"];
	
	//jika waktu sistem lebih kecil dari nilai waktu session
	if (time() < $exp_time) {
		//panggil fungsi dan tambah waktu session
		login_validate();
		return true; 
	}else{
		//jika waktu session lebih kecil dari waktu session atau lewat batas
		//maka akan dilakukan unset session
		unset($_SESSION["expires_by"]);
		return false; 
	}
}

function antiinjeksi($text){
	global $mysqli;
	$safetext = $mysqli->real_escape_string(stripslashes(strip_tags(htmlspecialchars($text,ENT_QUOTES))));
	return $safetext;
}

?>