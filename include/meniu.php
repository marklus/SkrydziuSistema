<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 

        echo "<tr><td>";
        echo "</td></tr><tr><td>";
        if ($_SESSION['user'] != "guest") echo "[<a href=\"useredit.php\">Redaguoti paskyrą</a>] &nbsp;&nbsp;";
        echo "[<a href=\"operacija1.php\">Demo operacija1</a>] &nbsp;&nbsp;";
        echo "[<a href=\"uzsakymas.php\">Užsakymai</a>] &nbsp;&nbsp;";
        echo "[<a href=\"operacija2.php\">Demo operacija2</a>] &nbsp;&nbsp;";
     //Trečia operacija galima tik aukštesnių userlevel vartotojams , čia >=5:
        if ($userlevel >=5 ) {
            echo "[<a href=\"operacija3.php\">Demo operacija3</a>] &nbsp;&nbsp;";
       		}   
        //Administratoriaus sąsaja rodoma tik administratoriui
        if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
            echo "[<a href=\"admin.php\">Administratoriaus sąsaja</a>] &nbsp;&nbsp;";
        }
        echo "[<a href=\"logout.php\">Atsijungti</a>]";
      echo "</td></tr></table>";
?>       
<link rel="stylesheet" type="text/css" href="stylesUzsakymas.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div>
					<img class="navbar-brand-logo" src="https://i.imgur.com/ipQpPYY.jpg">
					<a class="navbar-brand" href="index.php">Visi Užsakymai</a>
				</div>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="index.php" ><i class="fa fa-tachometer-alt"></i>
								Pagrindinis <span class="sr-only"></span></a>
						</li>
						<li class="nav-item">
                        <?php     //Administratoriaus sąsaja rodoma tik administratoriui
                            if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
                                echo '<a class="nav-link" href="admin.php"><i class="fa fa-calendar-plus"></i>Administratoriaus sąsaja <span class="sr-only"></span></a>';
                            }?>  
						</li>
						<!-- <li class="nav-item">
							<a class="nav-link" href="#" ><i class="fa fa-calendar-plus"></i>
								Nueva reserva <span class="sr-only"></span></a>
						</li> -->
						<li class="nav-item">
							<a class="nav-link" href="#" ><i class="fa fa-list-alt"></i>
								Reservas <span class="sr-only"></span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#" ><i class="fa fa-chart-line"></i>
								Informes <span class="sr-only"></span></a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="useredit.php"><i class="fa fa-sliders-h"></i>
								Redaguoti paskyrą <span class="sr-only"></span></a>
						</li>
					</ul>
					<ul class="navbar-nav">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img class="navbar-company-switcher-logo" src="https://i.imgur.com/ipQpPYY.jpg">
								Antucoya Minerals
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item" href="#">
									<img class="navbar-company-switcher-logo" src="https://i.imgur.com/ipQpPYY.jpg">
									Pastas B
								</a>
								<a class="dropdown-item" href="#">
									<img class="navbar-company-switcher-logo" src="https://i.imgur.com/ipQpPYY.jpg">
									Pastas C
								</a>
							</div>
						</li>						
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php   echo "Prisijungęs vartotojas: <b>".$user."</b>     Rolė: <b>".$role."</b> <br>";?>    
								<i class="fas fa-user-circle"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item" href="login.html">Atsijungti</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

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