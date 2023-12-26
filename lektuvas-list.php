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
?>


<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!--    <link rel="stylesheet" href="main.css">-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

    <title>Mūsų lėktuvai</title>


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
                                Sąrąšas
                            </a>
                    </li>
                    <li>
                        <a class="ui-tabs-anchor">Bilietai</a>
                    </li>
                    <li>
                        <a class="ui-tabs-anchor">Lėktuvai</a>
                    </li>
                </ul>
            </div>


            <div class="content-wrapper col">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Lėktuvai <b> </b></h2>
                            </div>
                            <div class="col-sm-6">
                                <a href="#addAirplaneModal" class="btn btn-success" data-toggle="modal"><i
                                            class="fas fa-plus-circle"></i><span>Pridėti</span></a>
                                <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i
                                            class="fas fa-minus-circle"></i><span>Pašalinti</span></a>
                                <input type="text" class="form-control" placeholder="Paieška">
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>Nepamirštamoms kelionėms galite rinktis bet kokius jūsų įgeidžius tenkinančią transporto priemonę!
                            Turite mėgstamiausią skrydžių įmonę? Būtent *tas* lėktuvo modelis jums suteikė trokštamą komfortą?
                            Išsirinkite geriausią!
                        </p>
                    </div>


                    <?php
                    //**************************************************************************************************
                    //LĖKTUVŲ SĄRAŠAS
                    //**************************************************************************************************


                    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);


                    $sql = "SELECT * FROM lektuvai"; // Update this query based on your table structure
                    $result = mysqli_query($db, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
echo '<table class="table table-striped table-hover>';
                        echo '<thead>';
                        echo '<tr>';

                        echo '<th>';
                        echo '<span class="custom-checkbox">';
                        echo '<input type="checkbox" id="selectAll">';
                        echo '<label for="selectAll"></label>';
                        echo '</span>';

                        echo ' Pasirinkti visus ';

                        echo '</th>';

                        echo '<th>';
                        echo '</th>';

                        echo '<th>Registracijos Numeris</th>'; // Registration Number
                        echo '<th>Gamybos Data</th>'; // Manufacture Date
                        echo '<th>Įsigijimo Data</th>'; // Acquisition Date
                        echo '<th>WiFi</th>'; // WiFi
                        echo '<th>Veiksmai</th>'; // Actions

                        echo '</tr>';
                        echo '</thead>';

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>';
                            echo '<span class="custom-checkbox">';
                            echo '<input type="checkbox" id="checkbox' . $row['registracijos_numeris'] . '" name="options[]" value="' . $row['registracijos_numeris'] . '">';
                            echo '<label for="checkbox' . $row['registracijos_numeris'] . '"></label>';
                            echo '</span>';
                            echo '</td>';
                            echo '<td>' . $row['registracijos_numeris'] . '</td>';
                            echo '<td>' . $row['pagaminimo_data'] . '</td>';
                            echo '<td>' . $row['isigijimo_data'] . '</td>';
                            echo '<td>' . ($row['wifi'] ? 'Yes' : 'No') . '</td>';
                            // Add additional columns here if needed
/*                            <input type="hidden" id="edit_registracijos_numeris" name="edit_registracijos_numeris" value="<?php echo $registracijos_numeris; ?>">*/

                            echo '<td>';
                            echo '<a href="#editAirplaneModal" class="edit" data-toggle="modal"><i class="fas fa-pen" data-toggle="tooltip" title="Redaguoti"></i></a>';
                            echo '<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="fas fa-trash" data-toggle="tooltip" title="Pašalinti"></i></a>';
                            echo '<a href="lektuvas.php?id=' . $row['registracijos_numeris'] . '">LĖKTUVO PERŽIŪRA</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    } else {
                        // Handle case when there are no airplanes in the database
                        echo '<tr><td colspan="7">No airplanes found</td></tr>';
                    }
                    ?>


                    <div class="clearfix">
                        <div class="hint-text">Numeris nuo <b>5</b> iki <b>25</b></div>
                        <ul class="pagination">
                            <li class="page-item disabled"><a href="#">Atgal</a></li>
                            <li class="page-item"><a href="#" class="page-link">1</a></li>
                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                            <li class="page-item"><a href="#" class="page-link">3</a></li>
                            <li class="page-item"><a href="#" class="page-link">4</a></li>
                            <li class="page-item"><a href="#" class="page-link">5</a></li>
                            <li class="page-item"><a href="#" class="page-link">Paskutinis</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- Edit Modal HTML  cia galima prideti uzsakyma-->
            <div id="addAirplaneModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="">
                            <div class="modal-header">
                                <h4 class="modal-title">Pridėti naują lėktuvą</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="registracijos_numeris">Registracijos Numeris</label>
                                    <input type="text" id="registracijos_numeris" name="registracijos_numeris"
                                           class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="pagaminimo_data">Gamybos Data</label>
                                    <input type="date" id="pagaminimo_data" name="pagaminimo_data" class="form-control"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="isigijimo_data">Įsigijimo Data</label>
                                    <input type="date" id="isigijimo_data" name="isigijimo_data" class="form-control"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="wifi">Wi-Fi Prieinamas</label>
                                    <select id="wifi" name="wifi" class="form-control" required>
                                        <option value="1">Taip</option>
                                        <option value="0">Ne</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_lektuvu_modelis">Lėktuvo Modelio ID</label>
                                    <input type="text" id="id_lektuvu_modelis" name="id_lektuvu_modelis"
                                           class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_skrydziu_imone">Skrydžių Įmonės ID</label>
                                    <input type="text" id="id_skrydziu_imone" name="id_skrydziu_imone"
                                           class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Atšaukti">
                                <input type="submit" class="btn btn-success" name="add_airplane" value="Pridėti">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            //**************************************************************************************************
            //MODALAI
            //**************************************************************************************************

            include 'connect.php';
            if ($conn->connect_error) {
                die("Nepavyko prisijungti: " . $conn->connect_error);
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["add_airplane"])) {
                    //**************************************************************************************************
                    //PRIDĖJIMAS
                    //**************************************************************************************************


                    // Check if the form was submitted and the submit button is clicked

                    // Get values from the form
                    $registracijos_numeris = $_POST["registracijos_numeris"];
                    $pagaminimo_data = $_POST["pagaminimo_data"];
                    $isigijimo_data = $_POST["isigijimo_data"];
                    $wifi = $_POST["wifi"];
                    $id_lektuvu_modelis = $_POST["id_lektuvu_modelis"];
                    $id_skrydziu_imone = $_POST["id_skrydziu_imone"];

                    // Insert the values into the 'lektuvai' table
                    $insertSql = "INSERT INTO lektuvai (registracijos_numeris, pagaminimo_data, isigijimo_data, wifi, id_lektuvu_modelis, id_skrydziu_imone)
                        VALUES ('$registracijos_numeris', '$pagaminimo_data', '$isigijimo_data', '$wifi', '$id_lektuvu_modelis', '$id_skrydziu_imone')";

                    echo "<div class='content-box'>";
                    if ($conn->query($insertSql) === true) {
                        echo "Naujas lėktuvas pridėtas sėkmingai.";
                    } else {
                        echo "Įvyko klaida pridedant naują lėktuvą: " . $conn->error;
                    }

                    echo "</div>";
                }
                if (isset($_POST["edit_airplane"])) {
                    //**************************************************************************************************
                    //REDAGAVIMAS
                    //**************************************************************************************************

                    if (isset($_POST["edit_airplane"])) {
                        // Get the registracijos_numeris from the submitted form
                        $airplane_id = $_POST["edit_registracijos_numeris"];

                        $pagaminimo_data = $_POST["pagaminimo_data"];
                        $isigijimo_data = $_POST["isigijimo_data"];
                        $wifi = $_POST["wifi"];
                        $id_lektuvu_modelis = $_POST["id_lektuvu_modelis"];
                        $id_skrydziu_imone = $_POST["id_skrydziu_imone"];


                        $updateSql = "UPDATE lektuvai SET 
                        pagaminimo_data = '$pagaminimo_data',
                        isigijimo_data = '$isigijimo_data',
                        wifi = '$wifi',
                        id_lektuvu_modelis = '$id_lektuvu_modelis',
                        id_skrydziu_imone = '$id_skrydziu_imone'
                        WHERE id = $airplane_id";
                    }
                }
            }

            ?>


            <!-- Edit Modal HTML -->
            <div id="editAirplaneModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="">
                            <div class="modal-header">
                                <h4 class="modal-title">Redaguoti lėktuvą</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                                </button>
                            </div>
                            <div class="modal-body">
                                <!--                                    <div class="form-group">-->
                                <!--                                        <label for="edit_registracijos_numeris">Registracijos Numeris</label>-->
                                <!--                                        <input type="text" id="edit_registracijos_numeris" name="edit_registracijos_numeris" class="form-control" required>-->
                                <!--                                    </div>-->
                                <div class="form-group">
                                    <label for="edit_pagaminimo_data">Gamybos Data</label>
                                    <input type="date" id="edit_pagaminimo_data" name="edit_pagaminimo_data"
                                           class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_isigijimo_data">Įsigijimo Data</label>
                                    <input type="date" id="edit_isigijimo_data" name="edit_isigijimo_data"
                                           class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_wifi">Wi-Fi Prieinamas</label>
                                    <select id="edit_wifi" name="edit_wifi" class="form-control" required>
                                        <option value="1">Taip</option>
                                        <option value="0">Ne</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit_id_lektuvu_modelis">Lėktuvo Modelio ID</label>
                                    <input type="text" id="edit_id_lektuvu_modelis" name="edit_id_lektuvu_modelis"
                                           class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_id_skrydziu_imone">Skrydžių Įmonės ID</label>
                                    <input type="text" id="edit_id_skrydziu_imone" name="edit_id_skrydziu_imone"
                                           class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Atšaukti">
                                <input type="submit" class="btn btn-success" name="edit_airplane" value="Redaguoti">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            // Your PHP logic for handling the form submission and database operations goes here...
            ?>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css"/>