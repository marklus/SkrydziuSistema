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
		//  $editId = $_GET['edit_id'];
		  //echo "<p>Edit ID: $editId</p>";

		  $editId = @$_GET['edit_id'];
		//  echo "<p>Edit ID: $editId</p>";


		
		 
		$sql = "SELECT uzsakymai.id_uzsakymas, bilietai.kaina
        FROM uzsakymai
        JOIN bilietai ON uzsakymai.id_bilietas = bilietai.id_bilietas
        WHERE uzsakymai.id_uzsakymas = '$editId';";

			$result = mysqli_query($conn, $sql);

			if ($result) {
				// Fetch associative array
				while ($row = mysqli_fetch_assoc($result)) {
					$id_uzsakymas = $row['id_uzsakymas'];
					$kaina = $row['kaina'];
			
					// Now you can use $id_uzsakymas and $kaina as needed
					//echo "ID Uzsakymas: $id_uzsakymas, Kaina: $kaina<br>";
				}
			
				// Free result set
				mysqli_free_result($result);
			} else {
				// Handle the error, e.g., echo mysqli_error($conn);
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

		<title>Skrydžiai</title>


	</head>
	<body>

					<!--accmokslui123654@proton.me-->
		<script src="https://www.paypal.com/sdk/js?client-id=AS89FaARMRYphRAg5CfdpR7hmO1-UKCjWWXjkdvfkcnglK1Gtmzj0Zwearff0_EQNR7PycuDvRhd1dKb&disable-funding=credit,card"></script>
	<!--	<script src="PayPal/index.js"></script> -->

		<div id="app" class="container-fluid h-100">
			<section class="main container-fluid h-100">
				<div class="row justify-content-center h-100">
					<div class="sidebar d-none d-lg-block d-xl-block" id="yellow">
						
						<ul class="ui-tabs-nav">					
							<li>
								
							</li>
							<li>

							</li>
							<li>
								
							</li>
							<li>
								
							</li>
						</ul>
					</div>
					<div class="content-wrapper col">
						<div class="table-wrapper">
							<div class="table-title">
								<div class="row">
									<div class="col-sm-6">
										<h2>Skrydžiai <b>  </b></h2>
									</div>
									<div class="col-sm-6">
										<a href="#addOrderModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus-circle"></i><span>Pridėti Skrydį</span></a>		
										<a href="#SearchOrderModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus-circle"></i><span>Atlikti paiešką</span></a>
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
										<th>ID</th>
										<th>Atv. vieta</th>
										<th>Išv. vieta</th>
										<th>Atv. laikas</th>
										<th>Iš. laikas</th>
										<th>Real. atv. laikas </th>
                                        <th>Real. išv. laikas </th>								
										<th>Trukmė</th>
										<th>Funkcijos</th>
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
								atvykimo_vieta, 
								id_skrydis,
								isvykimo_vieta,
								planuojamas_atvykimo_laikas,
								planuojamas_isvykimo_laikas,
								realus_atvykimo_laikas,
								realus_isvykimo_laikas,
								skrydzio_trukme
								FROM 
								skrydziai" );

								//echo "Vardas  " . $user . "<br>" ;
								}

								if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
									$result = $conn->query("SELECT 
									atvykimo_vieta, 
									id_skrydis,
									isvykimo_vieta,
									planuojamas_atvykimo_laikas,
									planuojamas_isvykimo_laikas,
									realus_atvykimo_laikas,
									realus_isvykimo_laikas,
									skrydzio_trukme
									FROM 
									skrydziai" );


								}
										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												echo "<tr>";
												echo "<td>
												<span class='custom-checkbox'>
													<input type='checkbox' class='checkbox' name='selected_items[]' value='{$row['id_skrydis']}'>
													<label for='checkbox{$row['id_skrydis']}'></label>
												</span>
											  </td>";
												echo "<td>" . $row['id_skrydis'] . "</td>";
												echo "<td>" . $row['atvykimo_vieta'] . "</td>";
												echo "<td>" . $row['isvykimo_vieta'] . "</td>";
												echo "<td>" . $row['planuojamas_atvykimo_laikas'] . "</td>";
												echo "<td>" . $row['planuojamas_isvykimo_laikas'] . "</td>";
												echo "<td>" . $row['realus_atvykimo_laikas'] . "</td>";
												echo "<td>" . $row['realus_isvykimo_laikas'] . "</td>";
												echo "<td>" . $row['skrydzio_trukme'] . "</td>";
												echo "<td>
													<a href='#redaguotiSkrydį' class='edit btn-edit' data-toggle='modal' data-id='{$row['id_skrydis']}'><i class='fas fa-pen' data-toggle='tooltip' title='Redaguoti'></i></a>
													<a href='#deleteEmployeeModal' class='delete' data-toggle='modal' data-id='{$row['id_skrydis']}'><i class='fas fa-trash' data-toggle='tooltip' title='Pašalinti'></i></a>
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
					<div id="redaguotiSkrydį" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
						<form action="skrydziai.php" method="post">
							<input type="hidden" name="edit_id" id="edit_id">
							<div class="modal-header">
							<h4 class="modal-title">Redaguoti informaciją</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">

							<div class="form-group">
								<label>Pakeisti laiką kiek truks skrydis</label>
								<input type="text" name="selected_laikas" class="form-control">
							</div>
							



							</div>
							<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Atšaukti">
							<input type="submit" class="btn btn-info" name="edit_submit" value="Pateikti">
							</div>
						</form>
						</div>
					</div>
					</div>




					<?php $phpValue = "29"; ?>

					
					<div id="phpValueContainer" data-php-value="<?php echo htmlspecialchars($kaina); ?>"></div>
					<div id="phpValueContainer1" data-php-value1="<?php echo htmlspecialchars($editId); ?>"></div>




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
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Atšaukti">
							<input type="submit" class="btn btn-info" name="add_submit" value="Pateikti">
							</div>
						</form>
						</div>
					</div>
					</div>




					<div id="addOrderModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
						<form action="skrydziai.php" method="post">
							<input type="hidden" name="edit_id" id="edit_id">
							<div class="modal-header">
							<h4 class="modal-title">Pridėti Užsakymą</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">


							<div class="form-group">
								<label>Atvykimo vieta</label>
								<input type="text" name="selected_atvykimo_vieta" class="form-control">
							</div>
							<div class="form-group">
								<label>Išvykimo vieta</label>
								<input type="text" name="selected_isvykimo_vieta" class="form-control">
							</div>

							<div class="form-group">
								<label>Atvykimo Laikas</label>
								<input type="date" name="selected_atvykimo_laikas" class="form-control">
							</div>
							<div class="form-group">
								<label>Išvykimo Laikas</label>
								<input type="date" name="selected_isvykimo_laikas" class="form-control">
							</div>
							<div class="form-group">
								<label>Realus atvykimo laikas</label>
								<input type="date" name="selected_realus_atvykimo_laikas" class="form-control">
							</div>
							<div class="form-group">
								<label>Realus išvykimo laikas</label>
								<input type="date" name="selected_realus_isvykimo_laikas" class="form-control">
							</div>

							<div class="form-group">
								<label>Trukmė</label>
								<input type="text" name="selected_trukme" class="form-control">
							</div>
							
							</div>
							<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Atšaukti">
							<input type="submit" class="btn btn-info" name="add_order_submit" value="Pateikti">
							</div>
						</form>
						</div>
					</div>
					</div>



					<div id="SearchOrderModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
						<form action="skrydziai.php" method="post">
							<div class="modal-header">
							<h4 class="modal-title">Skrydžio paieška pagal Atvykimo vietą</h4>
							
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
								if (isset($_POST["edit_id"]) && isset($_POST["selected_laikas"])) {

									$edit_id = $_POST["edit_id"];
									$selected_laikas = $_POST["selected_laikas"];


									// Update the 'busena' field in the 'uzsakymai' table
									//$updateSql = "UPDATE uzsakymai SET busena = '$selected_busena' WHERE id_uzsakymas = $edit_id";

									$updateSql = "UPDATE skrydziai 
									SET skrydzio_trukme = '$selected_laikas'
									WHERE id_skrydis = $edit_id";

									if ($conn->query($updateSql) === TRUE) {
										echo "Skrydžio pakeitimas sėkmingas";
									} else {
										echo "Įvyko klaida keičiant duomenis: " . $conn->error;
									}
								}
							} elseif (isset($_POST["delete_submit"])) {
								// Code for processing delete submission
								if (isset($_POST["delete_id"])) {
									$delete_id = $_POST["delete_id"];
									echo "Įrašas"  . $delete_id;
									// Delete the record from the 'uzsakymai' table
									$deleteSql = "DELETE FROM skrydziai WHERE id_skrydis = $delete_id";

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
								if (isset($_POST["selected_atvykimo_vieta"]) || isset($_POST["selected_isvykimo_vieta"]) || isset($_POST["selected_isvykimo_laikas"]) || isset($_POST["selected_atvykimo_laikas"]) || isset($_POST["selected_realus_atvykimo_laikas"])|| isset($_POST["selected_realus_isvykimo_laikas"]) || isset($_POST["selected_trukme"])) {

									$selected_atvykimo_vieta = $_POST["selected_atvykimo_vieta"];
									$selected_isvykimo_vieta = $_POST["selected_isvykimo_vieta"];
									$selected_atvykimo_laikas = $_POST["selected_atvykimo_laikas"];
									$selected_isvykimo_laikas = $_POST["selected_isvykimo_laikas"];
									$selected_realus_atvykimo_laikas = $_POST["selected_realus_atvykimo_laikas"];
									$selected_realus_isvykimo_laikas = $_POST["selected_realus_isvykimo_laikas"];
									$selected_trukme = $_POST["selected_trukme"];

									$insertSql = "INSERT INTO skrydziai (atvykimo_vieta, isvykimo_vieta, planuojamas_atvykimo_laikas, planuojamas_isvykimo_laikas, realus_atvykimo_laikas, realus_isvykimo_laikas, skrydzio_trukme)
									VALUES ('$selected_atvykimo_vieta', '$selected_isvykimo_vieta', '$selected_atvykimo_laikas', '$selected_isvykimo_laikas', '$selected_realus_atvykimo_laikas', '$selected_realus_isvykimo_laikas', '$selected_trukme')";
					  

									if ($conn->query($insertSql) === TRUE) {
										echo "Užsakymo talpinimas sėkmingas";
									} else {
										echo "Įvyko klaida talpinant duomenis: " . $conn->error;
									}
								}
							}


							elseif (isset($_POST["search_submit"])) {
								// Code for processing edit submission
	
								$search_word = $_POST['search_id'];

								// Fetch and display rows containing the search word
								$sql = "SELECT * FROM skrydziai WHERE atvykimo_vieta LIKE '%$search_word%'";
								$result = $conn->query($sql);
							//	echo "SQL Query: " . $sql . "<br>";
							//	echo "Number of Rows: " . $result->num_rows . "<br>";
							if ($result->num_rows > 0) {
								echo "<ul>"; // Start your unordered list
								echo "Paieškos rezultatai";
								while ($row = $result->fetch_assoc()) {

									"<li>";
									echo "ID: " . $row['id_skrydis'] . "<br>";
									echo "atvykimo_vieta: " . $row['atvykimo_vieta'] . "<br>";
									echo "isvykimo_vieta: " . $row['isvykimo_vieta'] ."<br>";
									echo "planuojamas_atvykimo_laikas: " . $row['planuojamas_atvykimo_laikas'] . "<br>";
									echo "planuojamas_isvykimo_laikas: " . $row['planuojamas_isvykimo_laikas'] . "<br>";
									echo "realus_atvykimo_laikas: " . $row['realus_atvykimo_laikas'] . "<br>";
									echo "realus_isvykimo_laikas: " . $row['realus_isvykimo_laikas'] . "<br>";
									echo "skrydzio_trukme: " . $row['skrydzio_trukme'] . "<br>";
							
									echo "<a href='#redaguotiSkrydį' class='edit btn-edit' data-toggle='modal' data-id='{$row['id_skrydis']}'><i class='fas fa-pen' data-toggle='tooltip' title='Redaguoti'></i></a>";
									echo "<a href='#deleteEmployeeModal' class='delete' data-toggle='modal' data-id='{$row['id_skrydis']}'><i class='fas fa-trash' data-toggle='tooltip' title='Pašalinti'></i></a>";
									echo "</li>";
								}
							
								echo "</ul>"; // End your unordered list
							} else {
								echo "Nebuvo rasta užsakymų tokiu pavadinimu.";
							}
							}
						}

						// Your existing code for displaying the table goes here...
						?>

					<!-- Delete Modal HTML -->
					<div id="deleteEmployeeModal" class="modal fade">
						<div class="modal-dialog">

						
							<div class="modal-content">
							<div class="modal-header">
										<h4 class="modal-title">Pašalinti užsakymą</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
								<form action="skrydziai.php" method="post">
									<input type="hidden" name="delete_id_plane" id="delete_id_plane">

									<div class="form-group">

								</div>
									<div class="modal-body">
										<p>Ar tikrai norite pašalinti užsakymą?</p>
										<p class="text-warning"><small>Užsakymo nebus galima grąžinti.</small></p>
									</div>
									<div class="modal-footer">
										<input type="button" class="btn btn-default" data-dismiss="modal" value="Atšaukti">
										<input type="submit" class="btn btn-danger" name="delete_submit" value="Pašalinti">
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- Delete Modal HTML -->

					<div id="deleteTicketModal" class="modal fade">
						<div class="modal-dialog">

						
							<div class="modal-content">
							<div class="modal-header">
										<h4 class="modal-title">Pašalinti užsakymą</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
								<form action="skrydziai.php" method="post">
									<input type="hidden" name="delete_ticket_id" id="delete_ticket_id">

	

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
		<script src="./PayPal/index.js"></script>

		<script>
    $(document).ready(function(){
        // Handler for when the edit button is clicked
        $('.btn-take').click(function(){
            // Get the data-id attribute value
            var orderId = $(this).data('id');
            
            // Redirect to uzsakymas.php with orderId as a query parameter
            window.location.href = 'skrydziai.php?edit_id=' + orderId;
        });
    });
</script>

		<?php
		// Check if the edit_id parameter is present in the URL
		if(isset($_GET['edit_id'])) {
			// Retrieve the edit_id value
			$editId = $_GET['edit_id'];

			// Now you can use $editId in your logic
			// For example, you might perform other actions or validations

			// ...

			// Redirect or display a success message
			header("skrydziai.php");
			exit();
		} else {
			// Redirect or handle the case where edit_id is not present
		//	header("uzsakymai.php");
			exit();
		}
		?>

