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
        <p style="text-align:left; color: white;"><br>
        <div class="user-box">
            <input class ="user-box" name="user" type="text" value="<?php echo $_SESSION['name_login'];  ?>"/><br>
            <?php echo $_SESSION['name_error']; 
			?>
            <label>Vartotojo vardas:</label>
         </div>  
        </p>

        <div class="user-box">
        <p style="text-align:left;  color: white;"><br>
            <input class ="user-box" name="pass" type="password" value="<?php echo $_SESSION['pass_login']; ?>"/><br>
            <?php echo $_SESSION['pass_error']; 
			?>
            <label>Vartotojo slaptazodis:</label>
        </div>  
        </p>  

        <style>
  .button-container {
    text-align: left;
    color: white;
  }

  .button-container a {
    text-decoration: none;
    color: white;
    margin-right: 10px;
  }

  .button {
    background-color: #007bff;
    color: white;
    padding: 5px 10px;
    border: none;
    cursor: pointer;
    margin-right: 10px;
  }

  .button a {
    text-decoration: none;
    color: white;
  }
</style>



        <p style="text-align:left;  color: white;">
            <input type="submit" name="login" class="button" value="Prisijungti"/>   
            <input type="submit" name="problem" class="button" value="Pamiršote slaptažodį?"/>   
        </p>
        <p>
 <?php
			if ($uregister != "admin") { echo "<a href=\"register.php\">Registracija</a>";}
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"guest.php\">Svečias</a>";
?>
        </p>     
    </form>


