<?php
include 'connect.php';
    session_start();      // index.php
	// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
	// jei neprisijungęs - prisijungimo forma per include("login.php");
	// toje formoje daugiau galimybių...
	
	include("include/functions.php"); 
	if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
	{ header("Location:logout.php");exit;}


	$userid = mysqli_real_escape_string($conn, $_SESSION['userid']);

	$uname=$_SESSION['user'];
	$user=$_SESSION['user'];
	
    ?>
<!doctype html>

<link rel="stylesheet" type="text/css" href="stylesUzsakymas.css">


<?php        
    if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
    {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
                                       // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']
		
		$_SESSION['prev']="index"; 
        
        include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
?>
      <?php
          }                
          else {   			 
              
              if (!isset($_SESSION['prev'])) inisession("full");             // nustatom sesijos kintamuju pradines reiksmes 
              else {if ($_SESSION['prev'] != "proclogin") inisession("part"); // nustatom pradines reiksmes formoms
                   }  
   			  // jei ankstesnis puslapis perdavė $_SESSION['message']
				echo "<div align=\"center\">";echo "<font size=\"4\" color=\"#ff0000\">".$_SESSION['message'] . "<br></font>";          
		
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
		<link rel="stylesheet" href="main.css">
		<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

		<title>Užsakymai</title>


	</head>
	<body>

					<!--accmokslui123654@proton.me-->
		<script src="https://www.paypal.com/sdk/js?client-id=AS89FaARMRYphRAg5CfdpR7hmO1-UKCjWWXjkdvfkcnglK1Gtmzj0Zwearff0_EQNR7PycuDvRhd1dKb&disable-funding=credit,card"></script>
		<script src="PayPal/index.js"></script>

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
								<a class="ui-tabs-anchor">Bilietai</a>
							</li>
							<li>
								<a class="ui-tabs-anchor">Užsakymai</a>
							</li>
						</ul>
					</div>
					<div class="content-wrapper col">
						<div class="table-wrapper">
							<div class="table-title">
								<div class="row">
									<div class="col-sm-6">
										<h2>Užsakymai <b>  </b></h2>
									</div>
									<div class="col-sm-6">
										<a href="#addOrderModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus-circle"></i><span>Pridėti Užsakymą</span></a>
										<a href="#addTicketModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus-circle"></i><span>Pridėti Bilietą</span></a>
										<a href="#deleteTicketModal" class="btn btn-danger" data-toggle="modal"><i class="fas fa-minus-circle"></i><span>Pašalinti Bilietą</span></a>					
										<input type="text" class="form-control" placeholder="Paieška">  
									</div>
								</div>
							</div>
<!--<div class="col-sm-6">
    <div class="col-sm-8" id="paypal-payment-button" style="width: 150px; height: 40px;"></div>
</div>-->
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>
											<span class="custom-checkbox">
												<input type="checkbox" id="selectAll">
												<label for="selectAll"></label>
											</span>
										</th>
										<th>Nr.</th>
										<th>Pavadinimas</th>
										<th>Užsakovas</th>
										<th>Bilieto ID</th>
										<th>Data</th>
										<th>Būsena</th>
										<th>Veiksmai</th>
									</tr>
								</thead>
								<tbody>

									<?php

									$id_uzsakymas = "id_uzsakymas";
									$newBusena = "aktyvus";
									$sukurimo_data = date("Y-m-d");

		  						/////////////////////////////////////// Pasalinti veliau
									//$insertSql = "INSERT INTO uzsakymai ( busena, sukurimo_data) VALUES ('$newBusena', '$sukurimo_data')";
		  						//////////////////////////////////////
									//if ($conn->query($insertSql) === TRUE) {
									//	echo "New record added successfully";
								//	} else {
								//		echo "Error: " . $insertSql . "<br>" . $conn->error;
								//	}

								if ($userlevel == $user_roles[DEFAULT_LEVEL] ) {

								$result = $conn->query("SELECT 
								id_uzsakymas, 
								busena,
								sukurimo_data,
								uzsakovo_name,
								pavadinimas,
								id_bilietas
								FROM 
								uzsakymai
								WHERE uzsakymai.uzsakovo_name = '$user'" );

								//echo "Vardas  " . $user . "<br>" ;
								}

								if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
										$sql = "SELECT 
										id_uzsakymas, 
										busena,
										sukurimo_data,
										id_bilietas,
										pavadinimas,
										uzsakovo_name
										FROM 
										uzsakymai";

										$result = mysqli_query($conn, $sql);
								}
										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												echo "<tr>";
												echo "<td>
												<span class='custom-checkbox'>
													<input type='checkbox' class='checkbox' name='selected_items[]' value='{$row['id_uzsakymas']}'>
													<label for='checkbox{$row['id_uzsakymas']}'></label>
												</span>
											  </td>";
												echo "<td>" . $row['id_uzsakymas'] . "</td>";
												echo "<td>" . $row['pavadinimas'] . "</td>";
												echo "<td>" . $row['uzsakovo_name'] . "</td>";
												echo "<td>" . $row['id_bilietas'] . "</td>";
												echo "<td>" . $row['sukurimo_data'] . "</td>";
												echo "<td>" . $row['busena'] . "</td>";
												//echo "<td>" . $row['Statusas'] . "</td>";
												echo "<td>
													<a href='#redaguotiUžsakymą' class='edit' data-toggle='modal' data-id='{$row['id_uzsakymas']}'><i class='fas fa-pen' data-toggle='tooltip' title='Redaguoti'></i></a>
													<a href='#deleteEmployeeModal' class='delete' data-toggle='modal' data-id='{$row['id_uzsakymas']}'><i class='fas fa-trash' data-toggle='tooltip' title='Pašalinti'></i></a>
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
					<!-- Edit Modal HTML  cia galima prideti uzsakyma-->
					<div id="addEmployeeModal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form>
									<div class="modal-header">						
										<h4 class="modal-title">Pridėti naują</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">					
										<div class="form-group">
											<label>Nr</label>
											<input type="text" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Pastas</label>
											<input type="email" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Komentaras</label>
											<textarea class="form-control" required></textarea>
										</div>
									</div>
									<div class="modal-footer">
										<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
										<input type="submit" class="btn btn-success" value="Add">
									</div>
								</form>
								
							</div>
						</div>
					</div>
					<!-- Edit Modal HTML -->
					<div id="redaguotiUžsakymą" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
						<form action="uzsakymas.php" method="post">
							<input type="hidden" name="edit_id" id="edit_id">
							<div class="modal-header">
							<h4 class="modal-title">Redaguoti informaciją</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">
							<div class="form-group">
								<label>Busena</label>
								<input type="text" name="selected_busena" class="form-control">
							</div>
							<div class="form-group">
								<label>Pavadinimas</label>
								<input type="text" name="selected_pavadinimas" class="form-control">
							</div>
							
							<div class="form-group">
									<label>Bilieto Id</label>
									<select name="selected_bilietoId" class="form-control">
										<?php
										include 'connect.php';
										// Check connection
										if ($conn->connect_error) {
											die("Nepavyko prisijungti: " . $conn->connect_error);
										}

										// Assuming 'bilietai' is your table name and 'id_bilietas' is the column you want to retrieve
										$sql = "SELECT id_bilietas FROM bilietai";
										$result = $conn->query($sql);

										// Loop through the results to populate the dropdown
										while ($row = $result->fetch_assoc()) {
											$selected = ($row['id_bilietas'] == $selected_bilietoId) ? 'selected' : '';
											echo "<option value='{$row['id_bilietas']}' $selected>{$row['id_bilietas']}</option>";
										}

										// Close the database connection
										$conn->close();
										?>
									</select>
								</div>



							<div class="form-group">
								<label>Spauskite norėdami apmokėti užsakymą</label>
								<div id="paypal-payment-button"> </div>
							</div>
							</div>
							<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Atsaukti">
							<input type="submit" class="btn btn-info" name="edit_submit" value="Pateikti">
							</div>
						</form>
						</div>
					</div>
					</div>


					<div id="addTicketModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
						<form action="uzsakymas.php" method="post">
							<input type="hidden" name="edit_id" id="edit_id">
							<div class="modal-header">
							<h4 class="modal-title">Pridėti bilietą</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">
							<div class="form-group">
								<label>Kaina</label>
								<input type="text" name="selected_kaina" class="form-control">
							</div>
						<!--	<div class="form-group">
								<label>Skrydžio Id</label>
								<input type="text" name="selected_skrydisId" class="form-control">
							</div> -->
								<div class="form-group">
									<label>Skrydžio Id</label>
									<select name="selected_skrydisId" class="form-control">
										<?php
										include 'connect.php';
										// Check connection
										if ($conn->connect_error) {
											die("Nepavyko prisijungti: " . $conn->connect_error);
										}

										// Assuming 'skrydziai' is your table name and 'id_skrydis' is the column you want to retrieve
										$sql = "SELECT id_skrydis FROM skrydziai";
										$result = $conn->query($sql);

										// Loop through the results to populate the dropdown
										while ($row = $result->fetch_assoc()) {
											$selected = ($row['id_skrydis'] == $selected_skrydisId) ? 'selected' : '';
											echo "<option value='{$row['id_skrydis']}' $selected>{$row['id_skrydis']}</option>";
										}

										// Close the database connection
										$conn->close();
										?>
									</select>
								</div>


							<div class="form-group">
								<label>Vartai</label>
								<input type="text" name="selected_vartai" class="form-control">
							</div>
							</div>
							<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Atsaukti">
							<input type="submit" class="btn btn-info" name="add_submit" value="Pateikti">
							</div>
						</form>
						</div>
					</div>
					</div>




					<div id="addOrderModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
						<form action="uzsakymas.php" method="post">
							<input type="hidden" name="edit_id" id="edit_id">
							<div class="modal-header">
							<h4 class="modal-title">Pridėti Užsakymą</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">

							<div class="form-group">
								<label>Užsakovas</label>
								<input type="text" name="selected_uzsakovas" class="form-control">
							</div>
							<div class="form-group">
								<label>Pavadinimas</label>
								<input type="text" name="selected_pavadinimas" class="form-control">
							</div>
							<div class="form-group">
								<label>Data</label>
								<input type="date" name="selected_data" class="form-control">
							</div>
							
						<!--	<div class="form-group">
								<label>Skrydžio Id</label>
								<input type="text" name="selected_skrydisId" class="form-control">
							</div> -->
								<div class="form-group">
									<label>Bilieto Id</label>
									<select name="selected_bilietasId" class="form-control">
										<?php
										include 'connect.php';
										// Check connection
										if ($conn->connect_error) {
											die("Nepavyko prisijungti: " . $conn->connect_error);
										}

										// Assuming 'skrydziai' is your table name and 'id_skrydis' is the column you want to retrieve
										$sql = "SELECT id_bilietas FROM bilietai";
										$result = $conn->query($sql);

										// Loop through the results to populate the dropdown
										while ($row = $result->fetch_assoc()) {
											$selected = ($row['id_bilietas'] == $selected_bilietasId) ? 'selected' : '';
											echo "<option value='{$row['id_bilietas']}' $selected>{$row['id_bilietas']}</option>";
										}

										// Close the database connection
										$conn->close();
										?>
									</select>
								</div>


							<div class="form-group">
								<label>Busena</label>
								<input type="text" name="selected_busena" class="form-control">
							</div>
							</div>
							<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Atsaukti">
							<input type="submit" class="btn btn-info" name="add_order_submit" value="Pateikti">
							</div>
						</form>
						</div>
					</div>
					</div>


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
										

										<?php
						include 'connect.php';

						if ($_SERVER["REQUEST_METHOD"] == "POST") {
							if (isset($_POST["edit_submit"])) {
								// Code for processing edit submission
								if (isset($_POST["edit_id"]) && (isset($_POST["selected_busena"]) || isset($_POST["selected_bilietasId"])|| isset($_POST["selected_bilietasId"]))) {

									$edit_id = $_POST["edit_id"];
									$selected_busena = $_POST["selected_busena"];
									$selected_pavadinimas = $_POST["selected_pavadinimas"];
									$selected_bilietoId = $_POST["selected_bilietoId"];

									// Update the 'busena' field in the 'uzsakymai' table
									//$updateSql = "UPDATE uzsakymai SET busena = '$selected_busena' WHERE id_uzsakymas = $edit_id";

									$updateSql = "UPDATE uzsakymai 
									SET busena = '$selected_busena', pavadinimas = '$selected_pavadinimas', id_bilietas = '$selected_bilietoId'
									WHERE id_uzsakymas = $edit_id";

									if ($conn->query($updateSql) === TRUE) {
										echo "Pakeitimas sėkmingas";
									} else {
										echo "Įvyko klaida keičiant duomenis: " . $conn->error;
									}
								}
							} elseif (isset($_POST["delete_submit"])) {
								// Code for processing delete submission
								if (isset($_POST["delete_id"])) {
									$delete_id = $_POST["delete_id"];

									// Delete the record from the 'uzsakymai' table
									$deleteSql = "DELETE FROM uzsakymai WHERE id_uzsakymas = $delete_id";

									if ($conn->query($deleteSql) === TRUE) {
										echo "Įrašas sėkmingai pašalintas";
									} else {
										echo "Įvyko klaida naikinant duomenis:: " . $conn->error;
									}
								}
							}

							elseif (isset($_POST["delete_ticket_submit"])) {
								// Code for processing delete submission
								if (isset($_POST["selected_bilietasId"])) {
									$selected_bilietasId = $_POST["selected_bilietasId"];

									// Delete the record from the 'uzsakymai' table
									$deleteSql = "DELETE FROM bilietai WHERE id_bilietas = $selected_bilietasId";

									if ($conn->query($deleteSql) === TRUE) {
										echo "Įrašas sėkmingai pašalintas";
									} else {
										echo "Įvyko klaida naikinant duomenis:: " . $conn->error;
									}
								}
							}

							elseif (isset($_POST["add_submit"])) {
								// Code for processing edit submission
								if (isset($_POST["selected_kaina"]) || isset($_POST["selected_skrydisId"]) || isset($_POST["selected_vartai"])) {

									$selected_kaina = $_POST["selected_kaina"];
									$selected_skrydisId = $_POST["selected_skrydisId"];
									$selected_vartai = $_POST["selected_vartai"];

									// Update the 'busena' field in the 'uzsakymai' table
									//$updateSql = "UPDATE uzsakymai SET busena = '$selected_busena' WHERE id_uzsakymas = $edit_id";

									$insertSql = "INSERT INTO bilietai (kaina, skrydis_id, vartai)
									VALUES ('$selected_kaina', '$selected_skrydisId', '$selected_vartai')";
					  

									if ($conn->query($insertSql) === TRUE) {
										echo "Bilieto talpinimas sėkmingas";
									} else {
										echo "Įvyko klaida talpinant duomenis: " . $conn->error;
									}
								}
							}

							elseif (isset($_POST["add_order_submit"])) {
								// Code for processing edit submission
								if (isset($_POST["selected_pavadinimas"]) || isset($_POST["selected_data"]) || isset($_POST["selected_bilietasId"]) || isset($_POST["selected_busena"]) || isset($_POST["selected_uzsakovas"])) {

									$selected_uzsakovas = $_POST["selected_uzsakovas"];
									$selected_pavadinimas = $_POST["selected_pavadinimas"];
									$selected_data = $_POST["selected_data"];
									$selected_bilietasId = $_POST["selected_bilietasId"];
									$selected_busena = $_POST["selected_busena"];

									$insertSql = "INSERT INTO uzsakymai (pavadinimas, uzsakovo_name, sukurimo_data, id_bilietas, busena)
									VALUES ('$selected_pavadinimas', '$selected_uzsakovas', '$selected_data', '$selected_bilietasId', '$selected_busena')";
					  

									if ($conn->query($insertSql) === TRUE) {
										echo "Užsakymo talpinimas sėkmingas";
									} else {
										echo "Įvyko klaida talpinant duomenis: " . $conn->error;
									}
								}
							}
						}

						// Your existing code for displaying the table goes here...
						?>



					<!-- Delete Modal HTML -->
					<!-- Delete Modal HTML -->
					<div id="deleteTicketModal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form action="uzsakymas.php" method="post">
									<input type="hidden" name="delete_ticket_id" id="delete_ticket_id">

									<div class="form-group">
									<label>Bilieto Id</label>
									<select name="selected_bilietasId" class="form-control">
										<?php
										include 'connect.php';
										// Check connection
										if ($conn->connect_error) {
											die("Nepavyko prisijungti: " . $conn->connect_error);
										}

										// Assuming 'skrydziai' is your table name and 'id_skrydis' is the column you want to retrieve
										$sql = "SELECT id_bilietas FROM bilietai";
										$result = $conn->query($sql);

										// Loop through the results to populate the dropdown
										while ($row = $result->fetch_assoc()) {
											$selected = ($row['id_bilietas'] == $selected_bilietasId) ? 'selected' : '';
											echo "<option value='{$row['id_bilietas']}' $selected>{$row['id_bilietas']}</option>";
										}

										// Close the database connection
										$conn->close();
										?>
									</select>

								</div>
									<div class="modal-header">
										<h4 class="modal-title">Pašalinti užsakymą</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<p>Ar tikrai norite pašalinti užsakymą?</p>
										<p class="text-warning"><small>Užsakymo nebus galima grąžinti.</small></p>
									</div>
									<div class="modal-footer">
										<input type="button" class="btn btn-default" data-dismiss="modal" value="Atšaukti">
										<input type="submit" class="btn btn-danger" name="delete_ticket_submit" value="Pašalinti">
									</div>
								</form>
							</div>
						</div>
					</div>


					<div id="deleteTicketModal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form action="uzsakymas.php" method="post">
									<input type="hidden" name="delete_ticket_id" id="delete_ticket_id">
									<div class="modal-header">
										<h4 class="modal-title">Pašalinti bilietą</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<p>Ar tikrai norite pašalinti bilietą?</p>
										<p class="text-warning"><small>bilieto nebus galima grąžinti.</small></p>
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



				<!-- <div style="height: 100px; background-color: rgba(255,0,0,0.1);">
					<div class="h-25 d-inline-block" style="width: 120px; background-color: rgba(0,0,255,.1)">Height 25%</div>
					<div class="h-50 d-inline-block" style="width: 120px; background-color: rgba(0,0,255,.1)">Height 50%</div>
					<div class="h-75 d-inline-block" style="width: 120px; background-color: rgba(0,0,255,.1)">Height 75%</div>
					<div class="h-100 d-inline-block" style="width: 120px; background-color: rgba(0,0,255,.1)">Height 100%</div>
				</div>				 -->
				<!-- <div class="title-bar-wrap d-table w-100">
					<div class="page-title-wrapper d-table-cell align-top m-0 pt-2 pb-3 pl-2 pr-1">
						<div class="title float-left font-weight-normal">Dashboard</div>
					</div>
				</div>
				<div class="content-wrapper">
					<div class="content-box">
					<div class="content-box-title">
						<h3>Buscar reserva</h3>
						<i class="logo fas fa-search mr-2"></i>
					</div>
					<div class="col-md-10 mx-auto">
							<form class="clearfix">
								<div class="form-group row">
									<div class="col-sm-6">
										<label for="selectCamp">Pastas</label>
										<select class="form-control" id="selectCamp">
											<option>Pastas A</option>
											<option>Pastas B</option>
											<option>Pastas C</option>
										</select>
									</div>
									<div class="col-sm-6">
										<label for="selectModule">Modulo</label>
										<select class="form-control" id="selectModule">
											<option>Modulo A</option>
											<option>Modulo B</option>
											<option>Modulo C</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-6">
										<label for="selectRoomType">Tipo de habitacion</label>
										<select class="form-control" id="selectRoomType">
											<option>Tipo 1</option>
											<option>Tipo 2</option>
										</select>
									</div>
									<div class="col-sm-6">
										<label for="selectRoom">Habitacion</label>
										<select class="form-control" id="selectRoom">
											<option>Habitacion 1</option>
											<option>Habitacion 2</option>
											<option>Habitacion 3</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-6">
										<label for="selectRoomStatus">Estado</label>
										<select class="form-control" id="selectRoomStatus">
											<option>Disponible</option>
											<option>Ocupada</option>
										</select>
									</div>
									<div class="col-sm-3">
										<label for="inputCheckIn">Check In</label>
										<input type="text" class="form-control" id="inputCheckIn"/>
									</div>
									<div class="col-sm-3">
										<label for="inputCheckOut">Check Out</label>
										<input type="text" class="form-control" id="inputCheckOut"/>
									</div>
								</div>
								<button type="button" class="btn btn-primary px-4 float-right">Buscar</button>
							</form>
						</div>
					</div>
				</div> -->
			</section>
		</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
		<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
		<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>


