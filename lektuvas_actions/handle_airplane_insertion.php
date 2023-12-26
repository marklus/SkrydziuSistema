<?php
include '../connect.php'; // Include your database connection

if ($conn->connect_error) {
    die("Nepavyko prisijungti: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_airplane"])) {
    // Retrieve form data
    $registracijos_numeris = $_POST["registracijos_numeris"];
    $pagaminimo_data = $_POST["pagaminimo_data"];
    $isigijimo_data = $_POST["isigijimo_data"];
    $wifi = $_POST["wifi"];
    $id_lektuvu_modelis = $_POST["id_lektuvu_modelis"];
    $id_skrydziu_imone = $_POST["id_skrydziu_imone"];

    // Insert into the 'lektuvai' table
    $insertSql = "INSERT INTO lektuvai (registracijos_numeris, pagaminimo_data, isigijimo_data, wifi, id_lektuvu_modelis, id_skrydziu_imone)
        VALUES ('$registracijos_numeris', '$pagaminimo_data', '$isigijimo_data', '$wifi', '$id_lektuvu_modelis', '$id_skrydziu_imone')";

    if ($conn->query($insertSql) === true) {
        // Redirect after successful insertion
        header('Location: ../lektuvas_list.php');
        exit();
    } else {
        // Handle insertion failure
        echo "Įvyko klaida pridedant naują lėktuvą: " . $conn->error;
    }
} else {
    // Handle cases where the form wasn't submitted
    echo "Form not submitted";
}
?>
