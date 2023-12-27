<?php

session_start();      // lektuvas.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

include("include/functions.php");


if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
{                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
    // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']

    $_SESSION['prev'] = "index";

    include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
    ?>
    <?php
} else {
    if (!isset($_SESSION['prev'])) {
        inisession("full");
    }             // nustatom sesijos kintamuju pradines reiksmes
    else {
        if ($_SESSION['prev'] != "proclogin") {
            inisession("part");
        } // nustatom pradines reiksmes formoms
    }
    // jei ankstesnis puslapis perdavė $_SESSION['message']
    echo "<div align=\"center\">";
    echo "<font size=\"4\" color=\"#ff0000\">" . $_SESSION['message'] . "<br></font>";

    echo "<table class=\"center\"><tr><td>";
    include("include/login.php");                    // prisijungimo forma
    echo "</td></tr></table></div><br>";
}

//**************************************************************************************************
//AR YRA ID URL?
//**************************************************************************************************

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //**************************************************************************************************
    //AR YRA ID DB?
    //**************************************************************************************************

    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    $sql = "SELECT lektuvai.registracijos_numeris, 
                lektuvai.pagaminimo_data,
                lektuvai.isigijimo_data,
                lektuvai.wifi,
                skrydziu_imones.pavadinimas AS skrydzio_imone, 
                lektuvu_modeliai.pavadinimas AS lektuvo_modelis,
                lektuvu_gamintojai.pavadinimas AS gamintojas,
                lektuvu_modeliai.kelias_iki_3d
            FROM lektuvai
            LEFT JOIN skrydziu_imones ON lektuvai.id_skrydziu_imone = skrydziu_imones.id_skrydziu_imone
            LEFT JOIN lektuvu_modeliai ON lektuvai.id_lektuvu_modelis = lektuvu_modeliai.id_lektuvu_modelis
            LEFT JOIN lektuvu_gamintojai ON lektuvu_modeliai.id_lektuvu_gamintojas = lektuvu_gamintojai.id_lektuvu_gamintojas
            WHERE lektuvai.registracijos_numeris = ?";
$stmt = mysqli_prepare($db, $sql);

if ($stmt) {
    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "s", $id);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);
    $modelPath = null;

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Airplane with the given registration number exists

        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <link rel="icon" href="./include/icon.ico" type="image/x-icon">
            <link rel="stylesheet" type="text/css" href="./include/styles.css">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
                  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
                  crossorigin="anonymous">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
                  integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
                  crossorigin="anonymous">
            <!--    <link rel="stylesheet" href="main.css">-->
            <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
            <meta charset="UTF-8">
            <title>Lėktuvas
                <?php
                echo $id;
                ?>
            </title>

        </head>

        <body>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
<!--                <th colspan="3">Šitas lėktuvas yra labai geras, labai gerai skrenda, dar nėra nukritęs. Rekomenduojame visiems nekrentančių lėktuvų mėgėjams.</th>-->
            </tr>

            <tr>
                <th>Registracijos Numeris</th>
                <th>Gamybos Data</th>
                <th>Įsigijimo Data</th>
                <th>WiFi</th>
                <th>Modelis</th>
                <th>Įmonė</th>
            </tr>

            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['registracijos_numeris']; ?></td>
                    <td><?php echo $row['pagaminimo_data']; ?></td>
                    <td><?php echo $row['isigijimo_data']; ?></td>
                    <td><?php echo ($row['wifi'] ? 'Tiekiamas' : 'Nėra'); ?></td>
                    <td><?php echo $row['lektuvo_modelis'] . ", " . $row['gamintojas']; ?></td>
                    <td><?php echo $row['skrydzio_imone']; ?></td>
                    <?php
                    $modelPath = $row['kelias_iki_3d'];
                    ?>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

        <?php if (isset($modelPath) && !empty($modelPath)) { ?>
            <div align="center">
                <h2>Pažvelkite į šio lėktuvo modelį įdėmiau!</h2>
            </div>
            <div id="container">
                <!-- Your 3D model display code goes here -->
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
<!--            <script src="./js/lektuvas/module.js" type="module"></script>-->
<!--            <script src="--><?php //= $modelPath ?><!--" type="module"></script>-->
            <script src="./js/lektuvas/module.js?modelPath=<?php echo urlencode($modelPath); ?>" type="module"></script>


        <?php } else { ?>
            <div align="center">
                <p>Šis lėktuvo modelis sistemoje neturi 3D vaizdavimo</p>
            </div>
        <?php } ?>
        </body>

        </html>

        <?php


    } else {
        // Airplane does not exist
        echo "Airplane with registration number: $id does not exist";
    }
    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Failed to prepare the statement";
}

} else {
    echo "Neperduotas lėktuvo identifikatorius.";
}
?>



