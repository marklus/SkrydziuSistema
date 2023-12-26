<?php
include '../include/nustatymai.php';
//error_reporting(E_ALL);
//ini_set('display_errors', 1);


// Check if the form has been submitted and airplane ID is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_registracijos_numeris'])) {
    // Establish a connection to your database (replace DB_SERVER, DB_USER, DB_PASS, and DB_NAME with your actual database credentials)
    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    // Get the airplane ID from the form submission
    $registracijos_numeris = $_POST['delete_registracijos_numeris'];

    // Sanitize the airplane ID to prevent SQL injection
    $registracijos_numeris = mysqli_real_escape_string($db, $registracijos_numeris);

    // Construct the SQL DELETE query
    $sql = "DELETE FROM lektuvai WHERE registracijos_numeris = '$registracijos_numeris'";

    // Execute the DELETE query
    if (mysqli_query($db, $sql)) {
        // Deletion successful
        echo "Airplane deleted successfully";

        header('Location: ../lektuvas_list.php');
    } else {
        // Error in deletion
        echo "Error deleting airplane: " . mysqli_error($db);
    }

    // Close the database connection
    mysqli_close($db);
} else {
    // If there's an invalid request or airplane ID is not set
    echo "Invalid request or airplane registration number not set";
}
?>
