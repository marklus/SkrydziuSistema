<?php 
// useredit.php 
// vartotojas gali pasikeisti slaptažodį ar email
// formos reikšmes tikrins procuseredit.php. Esant klaidų pakartotinai rodant formą rodomos ir klaidos

session_start();
// sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "procuseredit")  && ($_SESSION['prev'] != "useredit")))
{header("Location: logout.php");exit;
}
if ($_SESSION['prev'] == "index")								  
	{$_SESSION['mail_login'] = $_SESSION['umail'];
	$_SESSION['passn_error'] = "";      // papildomi kintamieji naujam password įsiminti
	$_SESSION['passn_login'] = ""; }  //visos kitos turetų būti tuščios
$_SESSION['prev'] = "useredit"; 
include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
?>

 <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
            <title>Registracija</title>
            <link rel="stylesheet" type="text/css" href="stylesUzsakymas.css">

                    	    <!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link rel="stylesheet" href="main.css">
		<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

    </head>
        
        <body>   
            <table class="center"><tr><td> <img src="#"> </td></tr><tr><td>           
                <div align="center">   <font size="4" color="#ff0000"><?php echo $_SESSION['message']; ?><br></font>  
					
      <table bgcolor=#C3FDB8>
        <tr><td>
		<form action="procuseredit.php" method="POST" class="login">             
        <center style="font-size:18pt;"><b>Paskyros redagavimas</b></center><br>
		<center style="font-size:14pt;"><b>Vartotojas: <?php echo $_SESSION['user'];  ?></b></center>
        
        <p style="text-align:left;">Dabartinis slaptažodis:<br>
            <input class ="s1" name="pass" type="password" value="<?php echo $_SESSION['pass_login']; ?>"><br>
            <?php echo $_SESSION['pass_error']; ?>
        </p>
			
		<p style="text-align:left;">Naujas slaptažodis:<br>
            <input class ="s1" name="passn" type="password" value="<?php echo $_SESSION['passn_login']; ?>"><br>
            <?php echo $_SESSION['passn_error']; ?>
        </p>	
			
		<p style="text-align:left;">E-paštas:<br>
			<input class ="s1" name="email" type="text" value="<?php echo $_SESSION['mail_login']; ?>"><br>
			<?php echo $_SESSION['mail_error']; ?>
        </p> 
			
        <p style="text-align:left;">
            <input type="submit" name="login" value="Atnaujinti"/>     
        </p>  
        </form>
        </td></tr>
	 </table>
  </div>
  </td></tr>
  </table>           
 </body>
</html>
	


