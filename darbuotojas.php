<?php

use PHPMailer\PHPMailer\PHPMailer;
use PhpMailer\PhpMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'Email/Exception.php';
require 'Email/PHPMailer.php';
require 'Email/SMTP.php';

function getOriginalValues($conn, $id)
{
    $sql = "SELECT * FROM darbuotojai WHERE id_darbuotojas = $id";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return false;
}

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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="main.css"> -->
	<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

	<title>Darbuotojai</title>


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
									<h2>Darbuotojai <b> </b></h2>
								</div>
								<div class="col-sm-6">
									<a href="#addTicketModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus-circle"></i><span>Pridėti darbuotoją</span></a>
									<a href="#deleteTicketModal" class="btn btn-danger" data-toggle="modal"><i class="fas fa-minus-circle"></i><span>Pašalinti darbuotoją</span></a>
									<input type="text" class="form-control" placeholder="Paieška">
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
									<th>ID</th>
									<th>Vardas</th>
									<th>Pavardė</th>
									<th>Gimimo data</th>
									<th>Paštas</th>
									<th>Pareigos</th>
								</tr>
							</thead>
							<tbody>

								<?php

								$id_darbuotojas = "id_darbuotojas";
								$vardas = "vardas";
								$pavarde = "pavarde";
								$gimimo_data = "gimimo_data";
								$elektroninis_pastas = "elektroninis_pastas";
								$pareigos = "pareigos";
								$newBusena = "aktyvus";

								$sql = "SELECT 
								id_darbuotojas, 
								vardas,
								pavarde,
								gimimo_data,
								elektroninis_pastas,
								pareigos
								FROM 
								darbuotojai";

								$result = mysqli_query($conn, $sql);

								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										echo "<tr>";
										echo "<td>
											<span class='custom-checkbox'>
											<input type='checkbox' class='checkbox' name='selected_items[]' value='{$row['id_darbuotojas']}'>
											<label for='checkbox{$row['id_darbuotojas']}'></label>
											</span>
		  								</td>";
										echo "<td>" . $row['id_darbuotojas'] . "</td>";
										echo "<td>" . $row['vardas'] . "</td>";
										echo "<td>" . $row['pavarde'] . "</td>";
										echo "<td>" . $row['gimimo_data'] . "</td>";
										echo "<td>" . $row['elektroninis_pastas'] . "</td>";
										echo "<td>" . $row['pareigos'] . "</td>";
										echo "<td>
											<a href='#redaguotiUžsakymą' class='edit' data-toggle='modal' data-id='{$row['id_darbuotojas']}'><i class='fas fa-pen' data-toggle='tooltip' title='Redaguoti'></i></a>
											<a href='#deleteEmployeeModal' class='delete' data-toggle='modal' data-id='{$row['id_darbuotojas']}'><i class='fas fa-trash' data-toggle='tooltip' title='Pašalinti'></i></a>
										</td>";
										echo "</tr>";
									}
								} else {
									echo "<tr><td colspan='6'>0 results</td></tr>";
								}

								$conn->close();
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
									<h4 class="modal-title">Redaguoti darbuotoją</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<!-- Add an ID field to store the selected user's ID -->
									<input type="hidden" id="edit_id" name="id" name="darbuotojas_id">

									<div class="form-group">
										<label>Vardas</label>
										<input type="text" id="edit_vardas" name="vardas" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Pavardė</label>
										<input type="text" id="edit_pavarde" name="pavarde" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="gimimoData">Gimimo data</label>
										<input type="date" id="edit_gimimo_data" name="gimimo_data" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="pastas">Paštas</label>
										<input type="email" id="edit_elektroninis_pastas" name="elektroninis_pastas" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="pareigos">Pareigos</label>
										<select id="edit_pareigos" name="pareigos" class="form-control" required>
											<option value="pilotas">Pilotas</option>
											<option value="palydovas">Palydovas</option>
											<option value="mechanikas">Mechanikas</option>
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
								url: 'darbuotojasEditRetriever.php', // Replace with your PHP script to fetch user data
								type: 'POST',
								data: {id: id},
								dataType: 'json',
								success: function (data) {
									// Populate the form fields with fetched data
									$('#edit_id').val(data.id_darbuotojas);
									$('#edit_vardas').val(data.vardas);
									$('#edit_pavarde').val(data.pavarde);
									$('#edit_gimimo_data').val(data.gimimo_data);
									$('#edit_elektroninis_pastas').val(data.elektroninis_pastas);
									$('#edit_pareigos').val(data.pareigos);

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
										<label>Vardas</label>
										<input type="text" name="vardas" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Pavardė</label>
										<input type="text" name="pavarde" class="form-control" required>
									</div>
									<div class="form-group">
    									<label for="gimimoData">Gimimo data</label>
    									<input type="date" id="gimimo_data" name="gimimo_data" class="form-control" required>
									</div>
									<div class="form-group">
    									<label for="pastas">Paštas</label>
    									<input type="email" id="elektroninis_pastas" name="elektroninis_pastas" class="form-control" required>
									</div>
									<div class="form-group">
    									<label for="pareigos">Pareigos</label>
    										<select id="pareigos" name="pareigos" class="form-control" required>
        										<option value="pilotas">Pilotas</option>
        										<option value="palydovas">Palydovas</option>
        										<option value="mechanikas">Mechanikas</option>
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

				<?php
				include 'connect.php';

				if ($_SERVER["REQUEST_METHOD"] == "POST") {

					if (isset($_POST["add_submit"]))
					{
						// Check if the form was submitted and the submit button is clicked

						// Get values from the form
						$vardas = $_POST["vardas"];
						$pavarde = $_POST["pavarde"];
						$gimimoData = $_POST["gimimo_data"];
						$pastas = $_POST["elektroninis_pastas"];
						$pareigos = $_POST["pareigos"];

						// Insert the values into the 'darbuotojai' table
						$insertSql = "INSERT INTO darbuotojai (vardas, pavarde, gimimo_data, elektroninis_pastas, pareigos)
									VALUES ('$vardas', '$pavarde', '$gimimoData', '$pastas', '$pareigos')";

						if ($conn->query($insertSql) === TRUE) {
							echo "Naujas darbuotojas pridėtas sėkmingai.";
						} else {
							echo "Įvyko klaida pridedant naują darbuotoją: " . $conn->error;
						}
					}
					else if (isset($_POST["delete_submit"]))
					{
						if (isset($_POST["delete_id"])) {
							$delete_id = $_POST["delete_id"];
							$originalValues = getOriginalValues($conn, $delete_id);

							// Delete the record from the 'uzsakymai' table
							$deleteSql = "DELETE FROM darbuotojai WHERE id_darbuotojas = $delete_id";

							$mail = new PHPMailer;

								// Connection settingai
								$mail->isSMTP();
								$mail->Host = 'smtp-mail.outlook.com'; // Max 300 žinučių per dieną, max 100 skirtingų gavėjų
								$mail->SMTPAuth = true;
								$mail->Username = 'vartvald2023@outlook.com'; // outlooko username
								$mail->Password = 'xwe449#123!@';   // acc pass
								$mail->Port = 587;  // šitas visada same
								$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // outlookui tls

								// Siuntėjas
								$mail->setFrom('vartvald2023@outlook.com', 'vartvald2023');

								// Gavėjas, pakeist į darbuotojų ar savo testinį paštą, bus spam folderi
								$mail->addAddress($originalValues['elektroninis_pastas']);

								// Antraštė
								$mail->isHTML(true);
								$mail->Subject = 'Jusu paskyra buvo istrinta.';

								// Žinutė
								$bodyContent = '<b>Jusu paskyra buvo istrinta administratoriaus is skrydžiu sistemos</b>';
								$mail->Body = $bodyContent;

								// Print status
								if ($mail->send()) {
									echo 'Message sent';
								} else {
									echo 'Message sending failed ' . $mail->ErrorInfo;
								}

							if ($conn->query($deleteSql) === TRUE) {
								echo "Įrašas sėkmingai pašalintas";
							} else {
								echo "Įvyko klaida naikinant duomenis:: " . $conn->error;
							}
						}
					}
					else if (isset($_POST["edit_submit"])) {

						$edit_id = $_POST["id"];

						// Retrieve original values
						$originalValues = getOriginalValues($conn, $edit_id);

						// Get values from the form
						$edit_vardas = $_POST["vardas"];
						$edit_pavarde = $_POST["pavarde"];
						$edit_gimimo_data = $_POST["gimimo_data"];
						$edit_pastas = $_POST["elektroninis_pastas"];
						$edit_pareigos = $_POST["pareigos"];

						// Construct and execute the update query
						$updateSql = "UPDATE darbuotojai SET 
							vardas = '$edit_vardas',
							pavarde = '$edit_pavarde',
							gimimo_data = '$edit_gimimo_data',
							elektroninis_pastas = '$edit_pastas',
							pareigos = '$edit_pareigos'
							WHERE id_darbuotojas = $edit_id";

						$changesDetected = false;
						if ($conn->query($updateSql) === TRUE) {
							// Initialize the email message
							$emailMessage = "Your information has been updated. Changes:\n";

							// Compare and append changes to the email message
							foreach ($originalValues as $field => $value) {
								// Exclude the 'id_darbuotojas' field from the comparison
								if ($field !== 'id_darbuotojas' && $_POST[$field] != $value) {
									$emailMessage .= "Field '$field' changed from '$value' to '{$_POST[$field]}'\n";
									$changesDetected = true;  // Set the flag to true if changes are detected
								}
							}

							if ($changesDetected == true)
							{
								$mail = new PHPMailer;

								// Connection settingai
								$mail->isSMTP();
								$mail->Host = 'smtp-mail.outlook.com'; // Max 300 žinučių per dieną, max 100 skirtingų gavėjų
								$mail->SMTPAuth = true;
								$mail->Username = 'vartvald2023@outlook.com'; // outlooko username
								$mail->Password = 'xwe449#123!@';   // acc pass
								$mail->Port = 587;  // šitas visada same
								$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // outlookui tls

								// Siuntėjas
								$mail->setFrom('vartvald2023@outlook.com', 'vartvald2023');

								// Gavėjas, pakeist į darbuotojų ar savo testinį paštą, bus spam folderi
								$mail->addAddress($originalValues['elektroninis_pastas']);

								// Antraštė
								$mail->isHTML(true);
								$mail->Subject = 'Atnaujinta informacija';

								// Žinutė
								$mail->Body = $emailMessage;

								// Print status
								if ($mail->send()) {
									echo 'Message sent';
								} else {
									echo 'Message sending failed ' . $mail->ErrorInfo;
								}

							echo "Darbuotojo duomenys atnaujinti sėkmingai ir pranešimas išsiųstas paštu.";
							}

							
						} else {
							echo "Įvyko klaida atnaujinant darbuotojo duomenis: " . $conn->error;
						}
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
							<form action="darbuotojas.php" method="post">
								<input type="hidden" name="delete_id" id="delete_id">
								<div class="modal-header">
									<h4 class="modal-title">Pašalinti darbuotoją</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<p>Ar tikrai norite pašalinti darbuotoją?</p>
									<p class="text-warning"><small>Darbuotojo nebus galima grąžinti.</small></p>
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
							<form action="darbuotojas.php" method="post">
								<input type="hidden" name="delete_id" id="delete_id">
								<div class="modal-header">
									<h4 class="modal-title">Pašalinti darbuotoją</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<p>Ar tikrai norite pašalinti darbuotoją?</p>
									<p class="text-warning"><small>darbuotojo nebus galima grąžinti.</small></p>
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