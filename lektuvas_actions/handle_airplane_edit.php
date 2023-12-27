<?php
include '../connect.php'; // Include your database connection

if ($conn->connect_error) {
    die("Nepavyko prisijungti: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_airplane"])) {
    // Retrieve form data
    $registracijos_numeris = $_POST["edit_registracijos_numeris"];
    $pagaminimo_data = $_POST["edit_pagaminimo_data"];
    $isigijimo_data = $_POST["edit_isigijimo_data"];
    $wifi = $_POST["edit_wifi"];
    $id_lektuvu_modelis = $_POST["edit_id_lektuvu_modelis"];
    $id_skrydziu_imone = $_POST["edit_id_skrydziu_imone"];

    // Update the 'lektuvai' table
    $updateSql = "UPDATE lektuvai SET 
        pagaminimo_data = '$pagaminimo_data',
        isigijimo_data = '$isigijimo_data',
        wifi = '$wifi',
        id_lektuvu_modelis = '$id_lektuvu_modelis',
        id_skrydziu_imone = '$id_skrydziu_imone'
        WHERE registracijos_numeris = '$registracijos_numeris'";

    if ($conn->query($updateSql) === true) {
        // Redirect after successful update
        header('Location: ../lektuvas_list.php');
        exit();
    } else {
        // Handle update failure
        echo "Įvyko klaida redaguojant lėktuvą: " . $conn->error;
    }
} else {
    // Handle cases where the form wasn't submitted
    echo "Form not submitted";
}
?>
