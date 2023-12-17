<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $sql = "SELECT * FROM pamainos WHERE id_pamaina = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'User not found']);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_id'])) {
    // Handle the submission of edited data
    $edit_id = mysqli_real_escape_string($conn, $_POST['edit_id']);
    $edit_pradzios_laikas = mysqli_real_escape_string($conn, $_POST['pradzios_laikas']);
    $edit_pabaigos_laikas = mysqli_real_escape_string($conn, $_POST['pabaigos_laikas']);
    $edit_statusas = mysqli_real_escape_string($conn, $_POST['statusas']);
    $edit_darbuotojo_id = mysqli_real_escape_string($conn, $_POST['darbuotojo_id']);

    $updateSql = "UPDATE darbuotojai SET 
        pradzios_laikas = '$edit_pradzios_laikas',
        pabaigos_laikas = '$edit_pabaigos_laikas',
        statusas = '$edit_statusas',
        darbuotojo_id = '$edit_darbuotojo_id',
        WHERE id_pamaina = $edit_id";

    if ($conn->query($updateSql) === TRUE) {
        echo json_encode(['success' => 'Pamainos duomenys atnaujinti sėkmingai.']);
    } else {
        echo json_encode(['error' => 'Įvyko klaida atnaujinant pamainos duomenis: ' . $conn->error]);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>