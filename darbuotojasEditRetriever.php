<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $sql = "SELECT * FROM darbuotojai WHERE id_darbuotojas = '$id'";
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
    $edit_vardas = mysqli_real_escape_string($conn, $_POST['vardas']);
    $edit_pavarde = mysqli_real_escape_string($conn, $_POST['pavarde']);
    $edit_gimimo_data = mysqli_real_escape_string($conn, $_POST['gimimo_data']);
    $edit_elektroninis_pastas = mysqli_real_escape_string($conn, $_POST['elektroninis_pastas']);
    $edit_pareigos = mysqli_real_escape_string($conn, $_POST['pareigos']);

    $updateSql = "UPDATE darbuotojai SET 
        vardas = '$edit_vardas',
        pavarde = '$edit_pavarde',
        gimimo_data = '$edit_gimimo_data',
        elektroninis_pastas = '$edit_elektroninis_pastas',
        pareigos = '$edit_pareigos'
        WHERE id_darbuotojas = $edit_id";

    if ($conn->query($updateSql) === TRUE) {
        echo json_encode(['success' => 'Darbuotojo duomenys atnaujinti sėkmingai.']);
    } else {
        echo json_encode(['error' => 'Įvyko klaida atnaujinant darbuotojo duomenis: ' . $conn->error]);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>
