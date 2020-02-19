<!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
	
	<!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	
	<!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('table.display').DataTable();
		} );
	</script>
	<script type="text/javascript">
		$(document).ready(function (){
			$("#dataTables-example").on("click", ".satuan_ubah", function() {
				var m = $(this).attr("id");
				$.ajax({
					url: "satuan_edit.php",
					type: "GET",
					data : {kd_satuan: m,},
					success: function (ajaxData){
						$("#SatuanEdit").html(ajaxData);
						$("#SatuanEdit").modal("show",{backdrop: "true"});
					}
				});
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function (){
			$("#dataTables-example").on("click", ".satuan_hapus", function() {
				var m = $(this).attr("id");
				$.ajax({
					url: "satuan_hapus.php",
					type: "GET",
					data : {kd_satuan: m,},
					success: function (ajaxData){
						$("#SatuanHapus").html(ajaxData);
						$("#SatuanHapus").modal('show',{backdrop: 'true'});
					}
				});
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function (){
			$("#dataTables-example").on("click", ".kategori_ubah", function() {
				var m = $(this).attr("id");
				$.ajax({
					url: "kategori_edit.php",
					type: "GET",
					data : {kd_kategori: m,},
					success: function (ajaxData){
						$("#KategoriEdit").html(ajaxData);
						$("#KategoriEdit").modal("show",{backdrop: "true"});
					}
				});
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function (){
			$("#dataTables-example").on("click", ".kategori_hapus", function() {
				var m = $(this).attr("id");
				$.ajax({
					url: "kategori_hapus.php",
					type: "GET",
					data : {kd_kategori: m,},
					success: function (ajaxData){
						$("#KategoriHapus").html(ajaxData);
						$("#KategoriHapus").modal('show',{backdrop: 'true'});
					}
				});
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function (){
			$("#dataTables-example").on("click", ".tindakan_ubah", function() {
				var m = $(this).attr("id");
				$.ajax({
					url: "tindakan_edit.php",
					type: "GET",
					data : {kd_tindakan: m,},
					success: function (ajaxData){
						$("#TindakanEdit").html(ajaxData);
						$("#TindakanEdit").modal("show",{backdrop: "true"});
					}
				});
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function (){
			$("#dataTables-example").on("click", ".tindakan_hapus", function() {
				var m = $(this).attr("id");
				$.ajax({
					url: "tindakan_hapus.php",
					type: "GET",
					data : {kd_tindakan: m,},
					success: function (ajaxData){
						$("#TindakanHapus").html(ajaxData);
						$("#TindakanHapus").modal('show',{backdrop: 'true'});
					}
				});
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function (){
			$("#dataTables-example").on("click", ".supplier_ubah", function() {
				var m = $(this).attr("id");
				$.ajax({
					url: "supplier_edit.php",
					type: "GET",
					data : {kd_supplier: m,},
					success: function (ajaxData){
						$("#SupplierEdit").html(ajaxData);
						$("#SupplierEdit").modal("show",{backdrop: "true"});
					}
				});
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function (){
			$("#dataTables-example").on("click", ".supplier_hapus", function() {
				var m = $(this).attr("id");
				$.ajax({
					url: "supplier_hapus.php",
					type: "GET",
					data : {kd_supplier: m,},
					success: function (ajaxData){
						$("#SupplierHapus").html(ajaxData);
						$("#SupplierHapus").modal('show',{backdrop: 'true'});
					}
				});
			});
		});
	</script>
	<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#employee-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"pasien-grid-data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		</script>
		<script type="text/javascript">
			$(document).ready(function (){
				$("#dataTables-example").on("click", ".barang_ubah", function() {
					var m = $(this).attr("id");
					$.ajax({
						url: "barang_edit.php",
						type: "GET",
						data : {kd_barang: m,},
						success: function (ajaxData){
							$("#BarangEdit").html(ajaxData);
							$("#BarangEdit").modal("show",{backdrop: "true"});
						}
					});
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function (){
				$("#dataTables-example").on("click", ".barang_hapus", function() {
					var m = $(this).attr("id");
					$.ajax({
						url: "barang_hapus.php",
						type: "GET",
						data : {kd_barang: m,},
						success: function (ajaxData){
							$("#BarangHapus").html(ajaxData);
							$("#BarangHapus").modal('show',{backdrop: 'true'});
						}
					});
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function (){
				$("#dataTables-example").on("click", ".rekam_ubah", function() {
					var m = $(this).attr("id");
					$.ajax({
						url: "rekam_edit.php",
						type: "GET",
						data : {rm: m,},
						success: function (ajaxData){
							$("#RekamEdit").html(ajaxData);
							$("#RekamEdit").modal("show",{backdrop: "true"});
						}
					});
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function (){
				$("#dataTables-example").on("click", ".rekam", function() {
					var m = $(this).attr("id");
					$.ajax({
						url: "rekam.php",
						type: "GET",
						data : {rm: m,},
						success: function (ajaxData){
							$("#RekamLihat").html(ajaxData);
							$("#RekamLihat").modal("show",{backdrop: "true"});
						}
					});
				});
			});
		</script>