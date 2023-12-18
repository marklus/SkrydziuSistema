<?php




include 'connect.php';
session_start();      // index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

include("include/functions.php");
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index")) {
	header("Location:logout.php");
	exit;
}


$userid = mysqli_real_escape_string($conn, $_SESSION['userid']);

$uname = $_SESSION['user'];
$user = $_SESSION['user'];

?>
<!doctype html>

<link rel="stylesheet" type="text/css" href="stylesUzsakymas.css">


<?php
if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
{                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
	// $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']

	$_SESSION['prev'] = "index";

	include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
?>
<?php
} else {

	if (!isset($_SESSION['prev'])) inisession("full");             // nustatom sesijos kintamuju pradines reiksmes 
	else {
		if ($_SESSION['prev'] != "proclogin") inisession("part"); // nustatom pradines reiksmes formoms
	}
	// jei ankstesnis puslapis perdavė $_SESSION['message']
	echo "<div align=\"center\">";
	echo "<font size=\"4\" color=\"#ff0000\">" . $_SESSION['message'] . "<br></font>";

	echo "<table class=\"center\"><tr><td>";
	include("include/login.php");                    // prisijungimo forma
	echo "</td></tr></table></div><br>";
}

?>


<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="main.css"> -->
	<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

	<title>Pamainos</title>


</head>

<body>

	<div id="app" class="container-fluid h-100">
		<section class="main container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="sidebar d-none d-lg-block d-xl-block" id="yellow">

					<ul class="ui-tabs-nav">
						<li>
							Pastas</a>
						</li>
						<li>
							<a class="ui-tabs-anchor">
								<a class="ui-tabs-anchor">
									<i class="fa fa-angle-right"></i>
									Sąrąšas
								</a>
						</li>
						<li>
							<a class="ui-tabs-anchor">Pamainos</a>
						</li>
						<li>
							<a class="ui-tabs-anchor">Darbuotojai</a>
						</li>
					</ul>
				</div>
				<div class="content-wrapper col">
					<div class="table-wrapper">
						<div class="table-title">
							<div class="row">
								<div class="col-sm-6">
									<h2>Pamainos <b> </b></h2>
								</div>
								<div class="col-sm-6">
									<a href="#addTicketModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus-circle"></i><span>Pridėti pamainą</span></a>
									<a href="#deleteTicketModal" class="btn btn-danger" data-toggle="modal"><i class="fas fa-minus-circle"></i><span>Pašalinti pamainą</span></a>
									<a href="#SearchOrderModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus-circle"></i><span>Atlikti paiešką</span></a>
								</div>
							</div>
						</div>
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>
										<span class="custom-checkbox">
											<input type="checkbox" id="selectAll">
											<label for="selectAll"></label>
										</span>
									</th>
									<th>Priskirtas darbuotojo ID</th>
									<th>Skrydzio ID</th>
									<th>Pradžios laikas</th>
									<th>Pabaigos laikas</th>
									<th>Statusas</th>
								</tr>
							</thead>
							<tbody>

								<?php

								$pradzios_laikas = "pradzios_laikas";
								$pabaigos_laikas = "pabaigos_laikas";
								$darbuotojo_id = "darbuotojo_id";
								$statusas = "statusas";
								$id_pamaina = "id_pamaina";
								$skrydzio_id = "skrydzio_id";

								$sql = "SELECT
								id_pamaina,
								pradzios_laikas, 
								pabaigos_laikas,
								darbuotojo_id,
								statusas,
								skrydzio_id
								FROM 
								pamainos";

								$result = mysqli_query($conn, $sql);

								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										echo "<tr>";
										echo "<td>
											<span class='custom-checkbox'>
											<input type='checkbox' class='checkbox' name='selected_items[]' value='{$row['id_pamaina']}'>
											<label for='checkbox{$row['id_pamaina']}'></label>
											</span>
		  								</td>";
										echo "<td>" . $row['darbuotojo_id'] . "</td>";
										echo "<td>" . $row['skrydzio_id'] . "</td>";
										echo "<td>" . $row['pradzios_laikas'] . "</td>";
										echo "<td>" . $row['pabaigos_laikas'] . "</td>";
										echo "<td>" . $row['statusas'] . "</td>";
										echo "<td>
											<a href='#redaguotiUžsakymą' class='edit' data-toggle='modal' data-id='{$row['id_pamaina']}'><i class='fas fa-pen' data-toggle='tooltip' title='Redaguoti'></i></a>
											<a href='#deleteEmployeeModal' class='delete' data-toggle='modal' data-id='{$row['id_pamaina']}'><i class='fas fa-trash' data-toggle='tooltip' title='Pašalinti'></i></a>
										</td>";
										echo "</tr>";
									}
								} else {
									echo "<tr><td colspan='6'>0 results</td></tr>";
								}

								//$conn->close();
								?>

						</table>
						<div class="clearfix">
							<div class="hint-text">Numeris nuo <b>5</b> iki <b>25</b> </div>
							<ul class="pagination">
								<li class="page-item disabled"><a href="#">Atgal</a></li>
								<li class="page-item"><a href="#" class="page-link">1</a></li>
								<li class="page-item"><a href="#" class="page-link">2</a></li>
								<li class="page-item active"><a href="#" class="page-link">3</a></li>
								<li class="page-item"><a href="#" class="page-link">4</a></li>
								<li class="page-item"><a href="#" class="page-link">5</a></li>
								<li class="page-item"><a href="#" class="page-link">Paskutinis</a></li>
							</ul>
						</div>
					</div>
				</div>

				<!-- Edit Modal HTML -->
				<div id="redaguotiUžsakymą" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<form method="post" action="" id="editForm">
								<div class="modal-header">
									<h4 class="modal-title">Redaguoti pamainą</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<!-- Add an ID field to store the selected user's ID -->
									<input type="hidden" id="edit_id" name="id" name="pamaina_id">

									<div class="form-group">
										<label for="pareigos">Darbuotojo id</label>
										<select id="edit_darbuotojo_id" name="darbuotojo_id" class="form-control" required>
										<?php
										// Check connection
										if ($conn->connect_error) {
											die("Connection failed: " . $conn->connect_error);
										}

										// Query to fetch data from the darbuotojai table
										$sql = "SELECT id_darbuotojas FROM darbuotojai";
										$result = $conn->query($sql);

										// Check if there are rows in the result
										if ($result->num_rows > 0) {
											// Output data of each row
											while ($row = $result->fetch_assoc()) {
												// Output an option element for each id_darbuotojas
												echo '<option value="' . $row['id_darbuotojas'] . '">' . $row['id_darbuotojas'] . '</option>';
											}
										} else {
											echo '<option value="">No data available</option>';
										}

										// Close the database connection
										//$conn->close();
										?>
										</select>
									</div>
									<div class="form-group">
										<label for="pradziosLaikas">Pradžios laikas</label>
										<input type="date" id="edit_pradzios_laikas" name="pradzios_laikas" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="pabaigosLaikas">Pabaigos laikas</label>
										<input type="date" id="edit_pabaigos_laikas" name="pabaigos_laikas" class="form-control" required>
									</div>
									<div class="form-group">
                                        <label>Statusas</label>
                                            <select id="edit_statusas" name="statusas" value="Neaktyvi" class="form-control" required>
                                                <option value="Neaktyvi">Neaktyvi</option>
                                                <option value="Aktyvi">Aktyvi</option>
                                                <option value="Baigta">Baigta</option>
                                                <option value="Atšaukta">Atšaukta</option>
                                            </select>
                                        </div>
								</div>
								<div class="modal-footer">
									<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
									<input type="submit" class="btn btn-success" name="edit_submit" value="Update">
								</div>
							</form>
						</div>
					</div>
				</div>

				<script>
					$(document).ready(function () {
						$('.edit').click(function () {
							var id = $(this).data('id');
							// Fetch data using AJAX and populate the form fields
							$.ajax({
								url: 'pamainaEditRetriever.php', // Replace with your PHP script to fetch user data
								type: 'POST',
								data: {id: id},
								dataType: 'json',
								success: function (data) {
									// Populate the form fields with fetched data
									$('#edit_id').val(data.id_pamaina);
									$('#edit_pradzios_laikas').val(data.pradzios_laikas);
									$('#edit_pabaigos_laikas').val(data.pabaigos_laikas);
									$('#edit_statusas').val(data.statusas);
									$('#edit_darbuotojo_id').val(data.darbuotojo_id);

									// Show the edit modal
									$('#redaguotiUžsakymą').modal('show');
								},
								error: function () {
									alert('Error fetching user data');
								}
							});
						});
					});
				</script>

				<!-- Add modal HTML-->
				<div id="addTicketModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<form method="post" action="">
								<div class="modal-header">
									<h4 class="modal-title">Pridėti naują</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label for="pareigos">Darbuotojo id</label>
										<select id="darbuotojo_id" name="darbuotojo_id" class="form-control" required>
											<?php
											// Check connection
											if ($conn->connect_error) {
												die("Connection failed: " . $conn->connect_error);
											}

											// Query to fetch data from the darbuotojai table
											$sql = "SELECT id_darbuotojas FROM darbuotojai";
											$result = $conn->query($sql);

											// Check if there are rows in the result
											if ($result->num_rows > 0) {
												// Output data of each row
												while ($row = $result->fetch_assoc()) {
													// Output an option element for each id_darbuotojas
													echo '<option value="' . $row['id_darbuotojas'] . '">' . $row['id_darbuotojas'] . '</option>';
												}
											} else {
												echo '<option value="">No data available</option>';
											}

											// Close the database connection
											//$conn->close();
											?>
										</select>
									</div>

									<div class="form-group">
										<label for="pareigoss">Skrydžio ID</label>
										<select id="skrydzio_id" name="skrydzio_id" class="form-control" required>
											<?php
											// Check connection
											if ($conn->connect_error) {
												die("Connection failed: " . $conn->connect_error);
											}

											// Query to fetch data from the skrydziai table
											$sql = "SELECT id_skrydis FROM skrydziai";
											$result = $conn->query($sql);

											// Check if there are rows in the result
											if ($result->num_rows > 0) {
												// Output data of each row
												while ($row = $result->fetch_assoc()) {
													// Output an option element for each id_skrydis
													echo '<option value="' . $row['id_skrydis'] . '">' . $row['id_skrydis'] . '</option>';
												}
											} else {
												echo '<option value="">No data available</option>';
											}

											// Close the database connection
											//$conn->close();
											?>
										</select>
									</div>


									<div class="form-group">
										<label for="pradziosLaikas">Pradžios laikas</label>
										<input type="date" id="pradzios_laikas" name="pradzios_laikas" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="pabaigosLaikas">Pabaigos laikas</label>
										<input type="date" id="pabaigos_laikas" name="pabaigos_laikas" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Statusas</label>
										<select id="statusas" name="statusas" class="form-control" required>
											<option value="Neaktyvi">Neaktyvi</option>
											<option value="Aktyvi">Aktyvi</option>
											<option value="Baigta">Baigta</option>
											<option value="Atšaukta">Atšaukta</option>
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
									<input type="submit" class="btn btn-success" name="add_submit" value="Add">
								</div>
							</form>
						</div>
					</div>
				</div>

				<div id="SearchOrderModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
						<form action="pamaina.php" method="post">
							<div class="modal-header">
							<h4 class="modal-title">Pamainos paieška pagal skrydžio ID</h4>
							
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">

							<input type="text" name="search_id" id="search_id" placeholder="Rašyti čia">
							

							</div>
							<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Atšaukti">
							<input type="submit" class="btn btn-info" name="search_submit" value="Pateikti">
							</div>
						</form>
						</div>
					</div>
					</div>

				<?php
				include 'connect.php';

				if ($_SERVER["REQUEST_METHOD"] == "POST") {

					if (isset($_POST["add_submit"]))
					{
						// Check if the form was submitted and the submit button is clicked

						// Get values from the form
						$darbuotojo_id = $_POST["darbuotojo_id"];
						$pradzios_laikas = $_POST["pradzios_laikas"];
						$pabaigos_laikas = $_POST["pabaigos_laikas"];
						$statusas = $_POST["statusas"];
						$skrydzio_id = $_POST["skrydzio_id"];

						// Insert the values into the 'darbuotojai' table
						$insertSql = "INSERT INTO pamainos (pradzios_laikas, pabaigos_laikas, darbuotojo_id, statusas, skrydzio_id)
									VALUES ('$pradzios_laikas', '$pabaigos_laikas', '$darbuotojo_id', '$statusas', '$skrydzio_id')";

						if ($conn->query($insertSql) === TRUE) {
							echo "Nauja pamaina pridėtas sėkmingai.";

						} else {
							echo "Įvyko klaida pridedant naują pamainą: " . $conn->error;
						}
					}
					else if (isset($_POST["delete_submit"]))
					{
						if (isset($_POST["delete_id"])) {
							$delete_id = $_POST["delete_id"];

							// Delete the record from the 'uzsakymai' table
							$deleteSql = "DELETE FROM pamainos WHERE id_pamaina = $delete_id";

							if ($conn->query($deleteSql) === TRUE) {
								echo "Įrašas sėkmingai pašalintas";
							} else {
								echo "Įvyko klaida naikinant duomenis:: " . $conn->error;
							}
						}
					}
					else if (isset($_POST["edit_submit"])) {

						$edit_id = $_POST["id"];


						// Get values from the form
						$edit_pradzios_laikas = $_POST["pradzios_laikas"];
						$edit_pabaigos_laikas = $_POST["pabaigos_laikas"];
						$edit_darbuotojo_id = $_POST["darbuotojo_id"];
						$edit_statusas = $_POST["statusas"];

						// Construct and execute the update query
						$updateSql = "UPDATE pamainos SET 
							pradzios_laikas = '$edit_pradzios_laikas',
							pabaigos_laikas = '$edit_pabaigos_laikas',
							darbuotojo_id = '$edit_darbuotojo_id',
							statusas = '$edit_statusas'
							WHERE id_pamaina = $edit_id";

						if ($conn->query($updateSql) === TRUE) {
							echo "Pamainos duomenys atnaujinti sėkmingai.";
							}
						}
					elseif (isset($_POST["search_submit"])) {
						// Code for processing edit submission

						$search_word = $_POST['search_id'];

						// Fetch and display rows containing the search word
						$sql = "SELECT * FROM pamainos WHERE skrydzio_id LIKE '%$search_word%'";
						$result = $conn->query($sql);
						//	echo "SQL Query: " . $sql . "<br>";
						//	echo "Number of Rows: " . $result->num_rows . "<br>";
						if ($result->num_rows > 0) {
							echo "<ul>"; // Start your unordered list
							echo "Paieškos rezultatai";
							while ($row = $result->fetch_assoc()) {
								echo "<li>";
								echo "Pamainos ID: " . $row['id_pamaina'] . "<br>";
								echo "Skrydžio ID: " . $row['skrydzio_id'] . "<br>";
								echo "Darbuotojo ID: " . $row['darbuotojo_id'] . "<br>";
								echo "Pradžios laikas: " . $row['pradzios_laikas'] . "<br>";
								echo "Pabaigos laikas: " . $row['pabaigos_laikas'] . "<br>";
								echo "Statusas: " . $row['statusas'] . "<br>";
					
								echo "<a href='#redaguotiUžsakymą' class='edit btn-edit' data-toggle='modal' data-id='{$row['id_pamaina']}'><i class='fas fa-pen' data-toggle='tooltip' title='Redaguoti'></i></a>";
								echo "<a href='#deleteEmployeeModal' class='delete' data-toggle='modal' data-id='{$row['id_pamaina']}'><i class='fas fa-trash' data-toggle='tooltip' title='Pašalinti'></i></a>";
								echo "<a href='#' class='btn-take' data-id='{$row['id_pamaina']}'><i class='fas fa-trash' data-toggle='tooltip' title='Paimti'></i></a>";
					
								echo "</li>";
						}
						echo "</ul>"; // End your unordered list
					}
				}
				else {
					echo "Nebuvo rasta užsakymų tokiu pavadinimu.";
				}
			}
					
				

				// Your existing code for displaying the table goes here...
				?>

				<script>
					$(document).ready(function() {
						$('.edit').click(function() {
							var id = $(this).data('id');
							$('#edit_id').val(id);
						});
					});

					$(document).ready(function() {
						$('.delete').click(function() {
							var id = $(this).data('id');
							$('#delete_id').val(id);
						});
					});
				</script>


				<!-- Delete Modal HTML -->
				<div id="deleteEmployeeModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<form action="pamaina.php" method="post">
								<input type="hidden" name="delete_id" id="delete_id">
								<div class="modal-header">
									<h4 class="modal-title">Pašalinti pamainą</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<p>Ar tikrai norite pašalinti pamainą?</p>
									<p class="text-warning"><small>Pamainos nebus galima grąžinti.</small></p>
								</div>
								<div class="modal-footer">
									<input type="button" class="btn btn-default" data-dismiss="modal" value="Atšaukti">
									<input type="submit" class="btn btn-danger" name="delete_submit" value="Pašalinti">
								</div>
							</form>
						</div>
					</div>
				</div>


				<div id="deleteTicketModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<form action="pamaina.php" method="post">
								<input type="hidden" name="delete_id" id="delete_id">
								<div class="modal-header">
									<h4 class="modal-title">Pašalinti pamainą</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<p>Ar tikrai norite pašalinti pamainą?</p>
									<p class="text-warning"><small>Pamainos nebus galima grąžinti.</small></p>
								</div>
								<div class="modal-footer">
									<input type="button" class="btn btn-default" data-dismiss="modal" value="Atšaukti">
									<input type="submit" class="btn btn-danger" name="delete_ticket_submit" value="Pašalinti">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
	<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>