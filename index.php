<?php
session_start();

error_reporting(5);
if ($_GET['isi'] == 'menengah') {
	$_SESSION['isi'] = 'menengah';
} elseif ($_GET['isi'] == 'lanjut') {
	$_SESSION['isi'] = 'lanjut';
} else {
	$_SESSION['isi'] = 'dasar';
}
$isi = $_SESSION['isi'];
// var_dump($_SESSION['isi']);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>CRUD Operation using PHP/MySQLi with DataTable and PDF Generator using TCPDF</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<style>
		.height10 {
			height: 10px;
		}

		.mtop10 {
			margin-top: 10px;
		}

		.modal-label {
			position: relative;
			top: 7px
		}
	</style>
</head>

<body>
	<!-- ---------------------Header------------------------ -->
	<nav class="header">
		<div class="nav-left">
			<img src="image/logoug.png" alt="" class="logo">
		</div>
		<div class="nav-center">
				<p>Universitas Gunadarma</p>
		</div>
		<div class="nav-right">

		</div>
	</nav>
	<!-- ---------------------Sidebar------------------------ -->
	<div class="sidebar">
		<div class="shortcut-links">
			<a href="index.php?isi=dasar"><img src="images/home1.png" alt="">
				<p>Psikologi Dasar</p>
			</a>
			<a href="index.php?isi=menengah"><img src="images/home1.png" alt="">
				<p>Psikologi Menengah</p>
			</a>
			<a href="index.php?isi=lanjut"><img src="images/home1.png" alt="">
				<p>Psikologi Lanjut</p>
			</a>
		</div>
	</div>
	<!-- -------------------Main Data---------------------- -->
	<div class="container">
		<h1 class="page-header text-center">Data Barang Inventaris</h1>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="row">
					<?php
					if (isset($_SESSION['error'])) {
						echo
						"
					<div class='alert alert-danger text-center'>
						<button class='close'>&times;</button>
						" . $_SESSION['error'] . "
					</div>
					";
						unset($_SESSION['error']);
					}
					if (isset($_SESSION['success'])) {
						echo
						"
					<div class='alert alert-success text-center'>
						<button class='close'>&times;</button>
						" . $_SESSION['success'] . "
					</div>
					";
						unset($_SESSION['success']);
					}
					?>
				</div>
				<div class="row">
					<a href="#addnew" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> New</a>
					<a href="print_pdf.php" class="btn btn-success pull-right"><span class="glyphicon glyphicon-print"></span> PDF</a>
				</div>
				<div class="height10">
				</div>
				<div class="row">
					<table id="myTable" class="table table-bordered table-striped">
						<thead>
							<th>No</th>
							<th>Nama Barang</th>
							<th>Jumlah</th>
							<th>Keterangan</th>
							<th>Aktivitas</th>
						</thead>
						<tbody>
							<?php
							include_once('connection.php');
							$sql = "SELECT * FROM $isi";

							//use for MySQLi-OOP
							$query = $conn->query($sql);
							$i = 1;
							while ($row = $query->fetch_assoc()) {
								echo
								"<tr>
									<td>$i</td>
									<td>" . $row['nama'] . "</td>
									<td>" . $row['jumlah'] . "</td>
									<td>" . $row['ket'] . "</td>
									<td>
										<a href='#edit_" . $row['id'] . "' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Edit</a>
										<a href='#delete_" . $row['id'] . "' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Delete</a>
									</td>
								</tr>";
								include('edit_delete_modal.php');
								$i++;
							}

							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php include('add_modal.php') ?>

	<script src="script.js"></script>
	<script src="jquery/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="datatable/jquery.dataTables.min.js"></script>
	<script src="datatable/dataTable.bootstrap.min.js"></script>
	<!-- generate datatable on our table -->
	<script>
		$(document).ready(function() {
			//inialize datatable
			$('#myTable').DataTable();

			//hide alert
			$(document).on('click', '.close', function() {
				$('.alert').hide();
			})
		});
	</script>
</body>

</html>