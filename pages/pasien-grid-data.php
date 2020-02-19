<?php
	include_once "../library/library.php";
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "klinik_pro";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'id_pasien', 
	1 => 'nm_pasien',
	2 => 'alamat',
	3=> 'tgllahir'
);

// getting total number records without any search
$sql = "SELECT id_pasien, nm_pasien, alamat, tgllahir ";
$sql.=" FROM pasien";
$query=mysqli_query($conn, $sql) or die("pasien-grid-data.php: get pasien");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT id_pasien, nm_pasien, alamat, tgllahir ";
$sql.=" FROM pasien WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( id_pasien LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR nm_pasien LIKE '".$requestData['search']['value']."%' ";

	$sql.=" OR alamat LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("pasien-grid-data.php: get pasien");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get pasien");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 
	$Kode = $row["id_pasien"];
	$nestedData[] = $row["id_pasien"];
	$nestedData[] = $row["nm_pasien"];
	$nestedData[] = $row["alamat"];
	$nestedData[] = '<center><a  href="?page=Pasien-Edit&amp;Kode='.$row["id_pasien"].'" target="_self" alt="Edit Data" title="Edit Data"><img src="../img/icons/edit.png" width="18" title="edit data"></a><a  href="?page=Hapus-Pasien&amp;Kode='.$row["id_pasien"].'" target="_self" alt="Hapus Data" title="hapus"><img src="../img/icons/delete.png" width="18" title="hapus"></a><a  href="?page=Rekam-Medis&amp;Kode='.$row["id_pasien"].'" target="_self" alt="Edit Data" title="Rekam medis"><img src="../img/icons/view.png" width="18" title="Rekam medis"></a>&nbsp<a  href="card.php?Kode='.$row["id_pasien"].'" target="_blank" title="Cetak Kartu Pasien"><img src="../img/icons/card.png" width="18" title="cetak kartu pasien"></a></center>';
	
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
