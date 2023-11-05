<?php
session_start();      // index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

include("include/functions.php");
?>
<!doctype html>

<link rel="stylesheet" type="text/css" href="stylesLektuvas.css">


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

    <title>Skrydžių sistema | Lėktuvai</title>




</head>
<body>
<div id="app" class="container-fluid h-100">

    <section class="main container-fluid h-100">
        <div class="row justify-content-center h-100">



            <div class="content-wrapper col">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Mūsų lėktuvai <b>  </b></h2>
                            </div>
                            <div class="col-sm-6">
                                <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus-circle"></i><span>Pridėti</span></a>
                                <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="fas fa-minus-circle"></i><span>Pašalinti</span></a>
                                <input type="text" class="form-control" placeholder="Paieška">
                            </div>
                        </div>
                    </div>
                                <div>
                                    <p  class="basic-paragraph" >Nepamirštamoms kelionėms galite rinktis bet kokius jūsų įgeidžius tenkinančią transporto priemonę!
                                        Turite mėgstamiausią skrydžių įmonę? Būtent *tas* lėktuvo modelis jums suteikė trokštamą komfortą?
                                        Išsirinkite geriausią!
                                    </p>
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
                                <h4 class="modal-title">Redaguoti informaciją</h4>
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
                                    <label>Statusas</label>
                                    <input type="text" value="W-13 Piso 1" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Vieta</label>
                                    <input type="text" value="W-13 Piso 1" class="form-control" required>
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

    </section>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
