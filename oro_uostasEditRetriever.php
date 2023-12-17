<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $sql = "SELECT * FROM oro_uostai WHERE iata_oro_uosto_kodas = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'User not found']);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_id'])) {
    // Handle the submission of edited data
    $edit_id = mysqli_real_escape_string($conn, $_POST['iata_oro_uosto_kodas']);
    $edit_pavadinimas = mysqli_real_escape_string($conn, $_POST['pavadinimas']);
    $edit_miestas = mysqli_real_escape_string($conn, $_POST['id_miestas']);
    $edit_reitingas = mysqli_real_escape_string($conn, $_POST['reitingas']);
    $edit_adresas = mysqli_real_escape_string($conn, $_POST['adresas']);

    $updateSql = "UPDATE oro_uostai SET 
        pavadinimas = '$edit_pavadinimas',
        id_miestas = '$edit_miestas',
        reitingas = '$edit_reitingas',
        adresas = '$edit_adresas',
        WHERE iata_oro_uosto_kodas = $edit_id";

    if ($conn->query($updateSql) === TRUE) {
        echo json_encode(['success' => 'Oro uosto duomenys atnaujinti sėkmingai.']);
    } else {
        echo json_encode(['error' => 'Įvyko klaida atnaujinant oro uosto duomenis: ' . $conn->error]);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>