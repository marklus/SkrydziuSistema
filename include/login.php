<?php 
// login.php - tai prisijungimo forma, index.php puslapio dalis 
// formos reikšmes tikrins proclogin.php. Esant klaidų pakartotinai rodant formą rodomos klaidos
// formos laukų reikšmės ir klaidų pranešimai grįžta per sesijos kintamuosius
// taip pat iš čia išeina priminti slaptažodžio.
// perėjimas į registraciją rodomas jei nustatyta $uregister kad galima pačiam registruotis

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
$_SESSION['prev'] = "login";
include("include/nustatymai.php");
?>

		<form action="proclogin.php" method="POST" class="login-box">            
        <center style="font-size:18pt; color: white;"><b>Prisijungimas</b></center>
        <p style="text-align:left; color: white;">Vartotojo vardas:<br>
            <input class ="user-box" name="user" type="text" value="<?php echo $_SESSION['name_login'];  ?>"/><br>
            <?php echo $_SESSION['name_error']; 
			?>
        </p>
        <p style="text-align:left;  color: white;">Slaptažodis:<br>
            <input class ="user-box" name="pass" type="password" value="<?php echo $_SESSION['pass_login']; ?>"/><br>
            <?php echo $_SESSION['pass_error']; 
			?>
        </p>  
        <p style="text-align:left;  color: white;">
            <input type="submit" name="login" value="Prisijungti"/>   
            <input type="submit" name="problem" value="Pamiršote slaptažodį?"/>   
        </p>
        <p>
 <?php
			if ($uregister != "admin") { echo "<a href=\"register.php\">Registracija</a>";}
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"guest.php\">Svečias</a>";
?>
        </p>     
    </form>


