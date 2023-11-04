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
  <div class="wrapper">
    <div class="container">
      <h2 class="page-title">Galimos kelionės</h2>
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="ticket-card">
            <div class="cover">
              <img src="https://s28.postimg.org/p916fev0t/week.jpg" alt="" />
              <div class="info">
                <div class="going">

                </div>
                <div class="tickets-left">
                  <i class="fa fa-ticket"></i> 
                </div>
              </div>
            </div>
            <div class="body">
              
              <div class="artist">
                <h6 class="info">Turkija</h6>
                <h4 class="name">Konstantinopolis</h4>
              </div>
              <div class="price">
                <div class="from">Nuo</div>
                <div class="value">
                  <b>$</b>599
                </div>
              </div>
              
              <div class="clearfix"></div>
              <div class="info">
                <p class="location">
                  <i class="fa fa-map-marker"></i> Turkija, Konstantinopolis
                </p>
                <p class="date">
                  <i class="fa fa-calendar"></i> 30 Aug, 2016
                </p>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="collapse">
              <ul class="list-unstyled">
                <li>
                  <div class="ticket">
                    <h5>Basic Ticket<br>
                      <small>25 Tickets left</small>
                    </h5>
                  </div>
                  <div class="price">
                    <div class="value"><b>$</b>599</div>
                  </div>
                  <a href="#" class="btn btn-info btn-sm btn-buy">Buy Now!</a>
                </li>
                <li>
                  <div class="ticket">
                    <h5>Regular Ticket<br>
                    <small>15 Tickets left</small>
                  </h5>
                  </div>
                  <div class="price">
                    <div class="value"><b>$</b>799</div>
                  </div>
                  <a href="#" class="btn btn-info btn-sm btn-buy">Buy Now!</a>
                </li>
                <li>
                  <div class="ticket">
                    <h5>Premium Ticket<br>
                    <small>62 Tickets left</small>
                  </h5>
                  </div>
                  <div class="price">
                    <div class="value"><b>$</b>1,299</div>
                  </div>
                  <a href="#" class="btn btn-info btn-sm btn-buy">Buy Now!</a>
                </li>
                <li>
                  <div class="ticket">
                    <h5>VIP Ticket<br>
                    <small>6 Tickets left</small>
                  </h5>
                  </div>
                  <div class="price">
                    <div class="value"><b>$</b>1,799</div>
                  </div>
                  <a href="#" class="btn btn-info btn-sm btn-buy">Buy Now!</a>
                </li>
              </ul>
            </div>
            <div class="footer">
              <button class="btn toggle-tickets">Pirkti</button>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="ticket-card active">
            <div class="cover">
              <img src="https://s28.postimg.org/iu25iqob1/kanye.jpg" alt="" />
              <div class="info">
                <div class="going">
                  <i class="fa fa-group"></i> 
                </div>
                <div class="tickets-left">
                  <i class="fa fa-ticket"></i> 
                </div>
              </div>
            </div>
            <div class="body">
              <div class="artist">
                <h6 class="info">Italija</h6>
                <h4 class="name">Venecija</h4>
              </div>
              <div class="price">
                <div class="from">From</div>
                <div class="value">
                  <b>$</b>699
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="info">
                <p class="location">
                  <i class="fa fa-map-marker"></i> Italija, Venecija
                </p>
                <p class="date">
                  <i class="fa fa-calendar"></i> 30 Aug, 2024
                </p>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="collapse in">
              <ul class="list-unstyled">
                <li>
                  <div class="ticket">
                    <h5><br>
                      <small></small>
                    </h5>
                  </div>
                  <div class="price">
                    <div class="value"><b>$</b>699</div>
                  </div>
                  <a href="#" class="btn btn-info btn-sm btn-buy"></a>
                </li>
                <li>
                  <div class="ticket">
                    <h5><br>
                    <small></small>
                  </h5>
                  </div>
                  <div class="price">
                    <div class="value"><b>$</b>799</div>
                  </div>
                  <a href="#" class="btn btn-info btn-sm btn-buy">Buy Now!</a>
                </li>
                <li>
                  <div class="ticket">
                    <h5>Premium Ticket<br>
                    <small>62 Tickets left</small>
                  </h5>
                  </div>
                  <div class="price">
                    <div class="value"><b>$</b>1,299</div>
                  </div>
                  <a href="#" class="btn btn-info btn-sm btn-buy">Buy Now!</a>
                </li>
                <li>
                  <div class="ticket">
                    <h5>VIP Ticket<br>
                    <small>6 Tickets left</small>
                  </h5>
                  </div>
                  <div class="price">
                    <div class="value"><b>$</b>1,799</div>
                  </div>
                  <a href="#" class="btn btn-info btn-sm btn-buy">Buy Now!</a>
                </li>
              </ul>
            </div>
            <div class="footer">
              <button class="btn toggle-tickets">Pirkti</button>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="ticket-card">
            <div class="cover">
              <img src="https://s28.postimg.org/wmgkedf2l/drake.jpg" alt="" />
              <div class="info">
                <div class="going">
                  <i class="fa fa-group"></i>
                </div>
                <div class="tickets-left">
                  <i class="fa fa-ticket"></i>
                </div>
              </div>
            </div>
            <div class="body">
              <div class="artist">
                <h6 class="info">Ispanija</h6>
                <h4 class="name">Barselona</h4>
              </div>
              <div class="price">
                <div class="from">From</div>
                <div class="value">
                  <b>$</b>499
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="info">
                <p class="location">
                  <i class="fa fa-map-marker"></i> Ispanija, Barselona
                </p>
                <p class="date">
                  <i class="fa fa-calendar"></i> 20 Aug, 2016
                </p>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="collapse">
              <ul class="list-unstyled">
                <li>
                  <div class="ticket">
                    <h5><br>
                      <small></small>
                    </h5>
                  </div>
                  <div class="price">
                    <div class="value"><b>$</b>499</div>
                  </div>
                  <a href="#" class="btn btn-info btn-sm btn-buy">Buy Now!</a>
                </li>
                <li>
                  <div class="ticket">
                    <h5><br>
                    <small></small>
                  </h5>
                  </div>
                  <div class="price">
                    <div class="value"><b>$</b>799</div>
                  </div>
                  <a href="#" class="btn btn-info btn-sm btn-buy">Buy Now!</a>
                </li>
                <li>
                  <div class="ticket">
                    <h5><br>
                    <small></small>
                  </h5>
                  </div>
                  <div class="price">
                    <div class="value"><b>$</b>1,299</div>
                  </div>
                  <a href="#" class="btn btn-info btn-sm btn-buy">Buy Now!</a>
                </li>
                <li>
                  <div class="ticket">
                    <h5>VIP Ticket<br>
                    <small>6 Tickets left</small>
                  </h5>
                  </div>
                  <div class="price">
                    <div class="value"><b>$</b>1,799</div>
                  </div>
                  <a href="#" class="btn btn-info btn-sm btn-buy">Buy Now!</a>
                </li>
              </ul>
            </div>
            <div class="footer">
              <button class="btn toggle-tickets">Pirkti</button>
            </div>
          </div>
        </div>


      </div>
    </div>

    <footer>
      <h3></h3>
    </footer>
  </div>

</body>
		</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
		<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
