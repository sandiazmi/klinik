<?php
# Konek ke Web Server Lokal
$myHost	= "localhost";
$myUser	= "root";
$myPass	= "";
$myDbs	= "klinik_pro"; // nama database, disesuaikan dengan database di MySQL

# Konek ke Web Server Lokal
$koneksidb	= mysqli_connect($myHost, $myUser, $myPass, $myDbs);
if (!$koneksidb) {
	die("Koneksi dengan database gagal: " . mysql_connect_errno() .
		" - " . mysql_connect_error());
}
