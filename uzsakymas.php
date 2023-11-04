<?php
    session_start();      // index.php
	// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
	// jei neprisijungęs - prisijungimo forma per include("login.php");
	// toje formoje daugiau galimybių...
	
	include("include/functions.php"); 
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

		<title>Gestión Hotelera</title>


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
									Pabellones
								</a>
							</li>
							<li>
								<a class="ui-tabs-anchor">Bilietai</a>
							</li>
							<li>
								<a class="ui-tabs-anchor">Užsakymai</a>
							</li>
							<li>
								<a class="ui-tabs-anchor">Áreas</a>
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
										<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus-circle"></i><span>Pridėti</span></a>
										<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="fas fa-minus-circle"></i><span>Pašalinti</span></a>						
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
										<th>Nr</th>
										<th>Pavadinimas</th>
										<th>Kur</th>
										<th>Statusas</th>
										<th>Veiksmai</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<span class="custom-checkbox">
												<input type="checkbox" id="checkbox1" name="options[]" value="1">
												<label for="checkbox1"></label>
											</span>
										</td>
										<td>W-13 Piso 1</td>
										<td>Pastas A</td>
										<td>16</td>
										<td>Activo</td>
										<td>
											<a href="#redaguotiUžsakymą" class="edit" data-toggle="modal"><i class="fas fa-pen" data-toggle="tooltip" title="Redaguoti"></i></a>
											<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="fas fa-trash" data-toggle="tooltip" title="Pašalinti"></i></a>
										</td>
									</tr>
									<tr>
										<td>
											<span class="custom-checkbox">
												<input type="checkbox" id="checkbox1" name="options[]" value="1">
												<label for="checkbox1"></label>
											</span>
										</td>
										<td>W-13 Piso 1</td>
										<td>Pastas A</td>
										<td>16</td>
										<td>Activo</td>
										<td>
											<a href="#redaguotiUžsakymą" class="edit" data-toggle="modal"><i class="fas fa-pen" data-toggle="tooltip" title="Editar"></i></a>
											<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="fas fa-trash" data-toggle="tooltip" title="Eliminar"></i></a>
										</td>
									</tr>
									<tr>
										<td>
											<span class="custom-checkbox">
												<input type="checkbox" id="checkbox1" name="options[]" value="1">
												<label for="checkbox1"></label>
											</span>
										</td>
										<td>W-13 Piso 1</td>
										<td>Pastas A</td>
										<td>16</td>
										<td>Activo</td>
										<td>
											<a href="#redaguotiUžsakymą" class="edit" data-toggle="modal"><i class="fas fa-pen" data-toggle="tooltip" title="Editar"></i></a>
											<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="fas fa-trash" data-toggle="tooltip" title="Eliminar"></i></a>
										</td>
									</tr>
									<tr>
									<td>
										<span class="custom-checkbox">
											<input type="checkbox" id="checkbox1" name="options[]" value="1">
											<label for="checkbox1"></label>
										</span>
										</td>
										<td>W-13 Piso 1</td>
										<td>Pastas A</td>
										<td>16</td>
										<td>Activo</td>
										<td>
											<a href="#redaguotiUžsakymą" class="edit" data-toggle="modal"><i class="fas fa-pen" data-toggle="tooltip" title="Editar"></i></a>
											<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="fas fa-trash" data-toggle="tooltip" title="Eliminar"></i></a>
										</td>
									</tr>				
									<tr>
										<td>
											<span class="custom-checkbox">
												<input type="checkbox" id="checkbox1" name="options[]" value="1">
												<label for="checkbox1"></label>
											</span>
										</td>
										<td>W-13 Piso 1</td>
										<td>Pastas A</td>
										<td>16</td>
										<td>Activo</td>
										<td>
											<a href="#redaguotiUžsakymą" class="edit" data-toggle="modal"><i class="fas fa-pen" data-toggle="tooltip" title="Editar"></i></a>
											<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="fas fa-trash" data-toggle="tooltip" title="Eliminar"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="clearfix">
								<div class="hint-text">Mostrando <b>5</b> de <b>25</b> registros</div>
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
										<h4 class="modal-title">Nuevo Pabellón</h4>
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
								<form>
									<div class="modal-header">						
										<h4 class="modal-title">Editar Pabellón</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">					
										<div class="form-group">
											<label>Nr</label>
											<input type="text" value="W-13 Piso 1" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Pastas</label>
											<input type="email" value="Pastas A" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Otros Campos</label>
											<textarea class="form-control" required></textarea>
										</div>
									</div>
									<div class="modal-footer">
										<input type="button" class="btn btn-default" data-dismiss="modal" value="Atsaukti">
										<input type="submit" class="btn btn-info" value="Pateikti">
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- Delete Modal HTML -->
					<div id="deleteEmployeeModal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form>
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
										<input type="submit" class="btn btn-danger" value="Pašalinti">
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
		<script>
			$(document).ready(function(){
				// Activate tooltip
				$('[data-toggle="tooltip"]').tooltip();
				
				// Select/Deselect checkboxes
				var checkbox = $('table tbody input[type="checkbox"]');
				$("#selectAll").click(function(){
					if(this.checked){
						checkbox.each(function(){
							this.checked = true;                        
						});
					} else{
						checkbox.each(function(){
							this.checked = false;                        
						});
					} 
				});
				checkbox.click(function(){
					if(!this.checked){
						$("#selectAll").prop("checked", false);
					}
				});
			});
			$('.navbar-nav>li>a:not(.dropdown-toggle), .navbar-nav>li>div>a').on('click', function(){
				$('.navbar-collapse').collapse('hide');
			});
			$('#inputCheckIn').datepicker({
            	uiLibrary: 'bootstrap4'
        	});
			$('#inputCheckOut').datepicker({
            	uiLibrary: 'bootstrap4'
        	});	
		</script>
	</body>
</html>
