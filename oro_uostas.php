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

	<title>Oro uostai</title>


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
					</ul>
				</div>
				<div class="content-wrapper col">
					<div class="table-wrapper">
						<div class="table-title">
							<div class="row">
								<div class="col-sm-6">
									<h2>Oro uostai <b> </b></h2>
								</div>
								<div class="col-sm-6">
									<a href="#addTicketModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus-circle"></i><span>Pridėti oro uostą</span></a>
									<a href="#deleteTicketModal" class="btn btn-danger" data-toggle="modal"><i class="fas fa-minus-circle"></i><span>Pašalinti oro uostą</span></a>
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
									<th>Pavadinimas</th>
									<th>IATA kodas</th>
									<th>Miestas</th>
									<th>Oro sąlygos</th>
									<th>Reitingas</th>
									<th>Adresas</th>
								</tr>
							</thead>
							<tbody>

								<?php

								$pavadinimas = "pavadinimas";
								$iata_oro_uosto_kodas = "iata_oro_uosto_kodas";
								$reitingas = "reitingas";
								$adresas = "adresas";
								$id_miestass = "id_miestas";

								$sql = "SELECT
								id_miestas,
								pavadinimas, 
								iata_oro_uosto_kodas,
								reitingas,
								adresas
								FROM 
								oro_uostai";

								$result = mysqli_query($conn, $sql);

								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										echo "<tr>";
										echo "<td>
											<span class='custom-checkbox'>
											<input type='checkbox' class='checkbox' name='selected_items[]' value='{$row['iata_oro_uosto_kodas']}'>
											<label for='checkbox{$row['iata_oro_uosto_kodas']}'></label>
											</span>
		  								</td>";
										echo "<td>" . $row['pavadinimas'] . "</td>";
										echo "<td>" . $row['iata_oro_uosto_kodas'] . "</td>";
										#get miestas name from the miestai table from the id_miestas
										$idMiestas = $row['id_miestas'];
										$sqlMiestasName = "SELECT pavadinimas FROM miestai WHERE ID_miestas = $idMiestas";
										$resultMiestasName = $conn->query($sqlMiestasName);
										$miestasName = $resultMiestasName->fetch_assoc()['pavadinimas'];
										echo "<td>" . $miestasName . "</td>";
										echo "<td><a href='#' class='getWeather' data-miestas='$miestasName'>Oro sąlygos</a></td>";
										echo "<td>" . $row['reitingas'] .  " / 5</td>";
										echo "<td>" . $row['adresas'] . "</td>";
										echo "<td>
											<a href='#redaguotiOroUosta' class='edit' data-toggle='modal' data-id='{$row['iata_oro_uosto_kodas']}'><i class='fas fa-pen' data-toggle='tooltip' title='Redaguoti'></i></a>
											<a href='#deleteEmployeeModal' class='delete' data-toggle='modal' data-id='{$row['iata_oro_uosto_kodas']}'><i class='fas fa-trash' data-toggle='tooltip' title='Pašalinti'></i></a>
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
				<div id="redaguotiOroUosta" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<form method="post" action="" id="editForm">
								<div class="modal-header">
									<h4 class="modal-title">Redaguoti oro uostą</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<!-- Add an ID field to store the selected user's ID -->
									<input type="hidden" id="edit_id" name="id" name="iata_oro_uosto_kodas">

									<div class="form-group">
										<label for="iata">IATA kodas</label>
										<input type="text" id="edit_iata_oro_uosto_kodas" name="iata_oro_uosto_kodas" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="iata">Miestas</label>
										<select id="edit_miestas" name="id_miestas" class="form-control" required>
										<?php
										// Check connection
										if ($conn->connect_error) {
											die("Connection failed: " . $conn->connect_error);
										}

										// Query to fetch data from the oro_uostai table
										$sqlMiestai = "SELECT ID_miestas, pavadinimas FROM miestai";
										$resultMiestai = $conn->query($sqlMiestai);

										// Check if there are rows in the result
										if ($resultMiestai->num_rows > 0) {
											// Output data of each row
											while ($rowMiestai = $resultMiestai->fetch_assoc()) {
												// Output an option element for each miesto pavadinimas
												echo '<option value="' . $rowMiestai['ID_miestas'] . '">' . $rowMiestai['pavadinimas'] . '</option>';
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
										<label for="Pavadinimas">Pavadinimas</label>
										<input type="text" id="edit_pavadinimas" name="pavadinimas" class="form-control" required>
									</div>
									
									<div class="form-group">
										<label for="reitingas">Reitingas</label>
										<input type="text" id="edit_reitingas" name="reitingas" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="adresas">Adresas</label>
										<input type="text" id="edit_adresas" name="adresas" class="form-control" required>
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
								url: 'oro_uostasEditRetriever.php', // Replace with your PHP script to fetch user data
								type: 'POST',
								data: {id: id},
								dataType: 'json',
								success: function (data) {
									// Populate the form fields with fetched data
									$('#edit_iata_oro_uosto_kodas').val(data.iata_oro_uosto_kodas);
									$('#edit_pavadinimas').val(data.pavadinimas);
									$('#edit_miestas').val(data.id_miestas);
									$('#edit_reitingas').val(data.reitingas);
									$('#edit_adresas').val(data.adresas);

									// Show the edit modal
									$('#redaguotiOroUosta').modal('show');
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
										<label for="iata">IATA kodas</label>
										<input type="text" id="iata_oro_uosto_kodas" name="iata_oro_uosto_kodas" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="miestas">Miestas</label>
										<select id="id_miestas" name="id_miestas" class="form-control" required>
											<?php
											// Check connection
											if ($conn->connect_error) {
												die("Connection failed: " . $conn->connect_error);
											}

											// Query to fetch data from the oro_uostai table
											$sql = "SELECT ID_miestas, pavadinimas FROM miestai";
											$result = $conn->query($sqlMiestai);

											// Check if there are rows in the result
											if ($result->num_rows > 0) {
												// Output data of each row
												while ($row = $result->fetch_assoc()) {
													// Output an option element for each iata_oro_uosto_kodas
													echo '<option value="' . $row['ID_miestas'] . '">' . $row['pavadinimas'] . '</option>';
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
										<label for="Pavadinimas">Pavadinimas</label>
										<input type="text" id="pavadinimas" name="pavadinimas" class="form-control" required>
									</div>
									
									<div class="form-group">
										<label for="reitingas">Reitingas</label>
										<input type="text" id="reitingas" name="reitingas" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="adresas">Adresas</label>
										<input type="text" id="adresas" name="adresas" class="form-control" required>
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
						<form action="oro_uostas.php" method="post">
							<div class="modal-header">
							<h4 class="modal-title">Oro uosto paieška pagal jo pavadinimą</h4>
							
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
						$iata_oro_uosto_kodas = $_POST["iata_oro_uosto_kodas"];
						$pavadinimas = $_POST["pavadinimas"];
						$id_miestas = $_POST["id_miestas"];
						$reitingas = $_POST["reitingas"];
						$adresas = $_POST["adresas"];

						// Insert the values into the 'darbuotojai' table
						$insertSql = "INSERT INTO oro_uostai (pavadinimas, iata_oro_uosto_kodas, reitingas, adresas, id_miestas)
									VALUES ('$pavadinimas', '$iata_oro_uosto_kodas', '$reitingas', '$adresas', '$id_miestas')";

						if ($conn->query($insertSql) === TRUE) {
							echo "Naujas oro uostas pridėtas sėkmingai.";

						} else {
							echo "Įvyko klaida pridedant naują oro uostą: " . $conn->error;
						}
					}
					else if (isset($_POST["delete_submit"]))
					{
						if (isset($_POST["delete_id"])) {
							$delete_id = $_POST["delete_id"];
					
							// Delete the record from the 'oro_uostai' table
							$deleteSql = "DELETE FROM oro_uostai WHERE iata_oro_uosto_kodas = '$delete_id'";
					
							if ($conn->query($deleteSql) === TRUE) {
								echo "Įrašas sėkmingai pašalintas";
							} else {
								echo "Įvyko klaida naikinant duomenis: " . $conn->error;
							}
						}
					}
					else if (isset($_POST["edit_submit"])) {

						$edit_id = $_POST["id"];


						// Get values from the form
						$edit_iata_oro_uosto_kodas = $_POST["iata_oro_uosto_kodas"];
						$edit_miestas = $_POST["id_miestas"];
						$edit_pavadinimas = $_POST["pavadinimas"];
						$edit_reitingas = $_POST["reitingas"];
						$edit_adresas = $_POST["adresas"];

						// Construct and execute the update query
						$updateSql = "UPDATE oro_uostai SET 
							iata_oro_uosto_kodas = '$edit_iata_oro_uosto_kodas',
							pavadinimas = '$edit_pavadinimas',
							reitingas = '$edit_reitingas',
							adresas = '$edit_adresas',
							id_miestas = '$edit_miestas'
							WHERE iata_oro_uosto_kodas = '$edit_id'";

						if ($conn->query($updateSql) === TRUE) {
							echo "Oro uosto duomenys atnaujinti sėkmingai.";
							}
						}
					
					elseif (isset($_POST["search_submit"])) {
							// Code for processing edit submission
	
							$search_word = $_POST['search_id'];
	
							// Fetch and display rows containing the search word
							$sql = "SELECT * FROM oro_uostai WHERE pavadinimas LIKE '%$search_word%'";
							$result = $conn->query($sql);
							//	echo "SQL Query: " . $sql . "<br>";
							//	echo "Number of Rows: " . $result->num_rows . "<br>";
							if ($result->num_rows > 0) {
								echo "<ul>"; // Start your unordered list
								echo "Paieškos rezultatai";
								while ($row = $result->fetch_assoc()) {
									echo "<li>";
									echo "Pavadinimas: " . $row['pavadinimas'] . "<br>";
									echo "IATA kodas: " . $row['iata_oro_uosto_kodas'] . "<br>";
									#get miestas name from the miestai table from the id_miestas
									$idMiestas = $row['id_miestas'];
									$sqlMiestasName = "SELECT pavadinimas FROM miestai WHERE ID_miestas = $idMiestas";
									$resultMiestasName = $conn->query($sqlMiestasName);
									$miestasName = $resultMiestasName->fetch_assoc()['pavadinimas'];
									echo "Miestas: " . $miestasName . "<br>";
									echo "<a href='#' class='getWeather' data-miestas='$miestasName'>Oro sąlygos</a>" . "<br>";
									echo "Reitingas: " . $row['reitingas'] . " / 5<br>";
									echo "Adresas: " . $row['adresas'] . "<br>";
						
									echo "<a href='#redaguotiOroUosta' class='edit btn-edit' data-toggle='modal' data-id='{$row['iata_oro_uosto_kodas']}'><i class='fas fa-pen' data-toggle='tooltip' title='Redaguoti'></i></a>";
									echo "<a href='#deleteEmployeeModal' class='delete' data-toggle='modal' data-id='{$row['iata_oro_uosto_kodas']}'><i class='fas fa-trash' data-toggle='tooltip' title='Pašalinti'></i></a>";
						
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
					$(document).ready(function () {
						$('.getWeather').click(function () {
							var miestas = $(this).data('miestas');
							// Use your OpenWeatherMap API key here
							var apiKey = 'a468775fe8d20e9161c198848d13526d';

							// Make an AJAX request to fetch weather information
							$.ajax({
								url: `https://api.openweathermap.org/data/2.5/weather?q=${miestas}&appid=${apiKey}&units=metric&lang=lt`,
								type: 'GET',
								dataType: 'json',
								success: function (data) {
									$('#weatherModal .modal-title').html(`Orų informacija - ${miestas}`);

									// Display weather information in the modal
									var weatherContent = `<p>Temperatūra: ${data.main.temp} &#8451;</p>`;
									var feelsLike = data.main.feels_like;
									weatherContent += `<p>Jaučiamoji temperatūra: ${feelsLike} &#8451;</p>`;
									var cloudiness = data.clouds.all;
									var humidity = data.main.humidity;
									weatherContent += `<p>Drėgnumas: ${humidity}%</p>`;
									weatherContent += `<p>Debesuotumas: ${cloudiness}%</p>`;
									var windSpeed = data.wind.speed;
									weatherContent += `<p>Vėjo greitis: ${windSpeed} m/s</p>`;
									$('#weatherContent').html(weatherContent);

									// Show the weather modal
									$('#weatherModal').modal('show');
								},
								error: function () {
									alert('Error fetching weather data');
								}
							});
						});
					});
				</script>

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
							<form action="oro_uostas.php" method="post">
								<input type="hidden" name="delete_id" id="delete_id">
								<div class="modal-header">
									<h4 class="modal-title">Pašalinti oro uostą</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<p>Ar tikrai norite pašalinti oro uostą?</p>
									<p class="text-warning"><small>Oro uosto nebus galima grąžinti.</small></p>
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
							<form action="oro_uostas.php" method="post">
								<input type="hidden" name="delete_id" id="delete_id">
								<div class="modal-header">
									<h4 class="modal-title">Pašalinti oro uostą</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<p>Ar tikrai norite pašalinti oro uostą?</p>
									<p class="text-warning"><small>Oro uosto nebus galima grąžinti.</small></p>
								</div>
								<div class="modal-footer">
									<input type="button" class="btn btn-default" data-dismiss="modal" value="Atšaukti">
									<input type="submit" class="btn btn-danger" name="delete_ticket_submit" value="Pašalinti">
								</div>
							</form>
						</div>
					</div>
				</div>

				<div id="weatherModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Orų informacija</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">
								<div id="weatherContent"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
	<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>