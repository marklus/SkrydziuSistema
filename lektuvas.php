<?php
session_start();      // index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

include("include/functions.php");
?>
<!doctype html>

<link rel="stylesheet" type="text/css" href="stylesUzsakymas.css">
<link rel="icon" href="./include/icon.ico" type="image/x-icon">


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

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Your head content here -->
    <link rel="icon" href="./include/icon.ico" type="image/x-icon">

    <meta charset="UTF-8">
    <title>Lėktuvo 3D modelis</title>
    <style>
        body {
            margin: 500;
        }

        canvas {
            display: block;
        }

        #container {
        width: 50%; /* Set the width as a percentage of the window's width */
        max-width: 600px; /* Adjusted maximum width for better visibility */
        height: 600px; /* Set the height */
        margin: auto; /* Center the container */
        border: 100px solid lightblue; /* Optional: Add a border for visual reference */

    }
    </style>
</head>

<body>
    <!-- Your HTML body content -->
    <div>
    </div>
    <div id="container">
        <!-- <canvas id="rendererCanvas">lėktuviukas</canvas> -->
    </div>
<div>
    <p>Šitas lėktuvas yra labai geras, labai gerai skrenda, dar nėra nukritęs. Rekomenduojame visiems nekrentančių lėktuvų mėgėjams.</p>
</div>
    <!-- Place the Import map at the top -->
    <script type="importmap">
        {
            "imports": {
                "three": "https://unpkg.com/three@0.149.0/build/three.module.js",
                "three/addons/": "https://unpkg.com/three@0.149.0/examples/jsm/"
            }
        }
    </script>


    <!-- Your Three.js and OBJLoader-related code -->
    <script src="./js/lektuvas/module.js" type="module"></script>

</body>

</html>