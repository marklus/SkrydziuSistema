<?php
include '../connect.php';
//error_reporting(E_ALL);
//ini_set('display_errors', 1);


// Check if the form has been submitted and airplane ID is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_registracijos_numeris'])) {
    // Establish a connection to your database (replace DB_SERVER, DB_USER, DB_PASS, and DB_NAME with your actual database credentials)
    $db = mysqli_connect($server, $username, $password, $database);

    // Get the airplane ID from the form submission
    $registracijos_numeris = $_POST['delete_registracijos_numeris'];

    // Sanitize the airplane ID to prevent SQL injection
    $registracijos_numeris = mysqli_real_escape_string($db, $registracijos_numeris);


    // Construct the SQL DELETE query for vietos_lektuve table
    $deleteVietosLektuve = "DELETE FROM vietos_lektuve WHERE id_lektuvo = '$registracijos_numeris'";

    // Execute the DELETE query for vietos_lektuve table
    if (mysqli_query($db, $deleteVietosLektuve)) {
        // Deletion of related records successful

        // Now, proceed to delete the airplane record
        $deleteAirplane = "DELETE FROM lektuvai WHERE registracijos_numeris = '$registracijos_numeris'";

        // Execute the DELETE query for airplane record
        if (mysqli_query($db, $deleteAirplane)) {
            // Deletion successful
            echo "Airplane deleted successfully";
            header('Location: ../lektuvas_list.php');
        } else {
            // Error in airplane deletion
            echo "Error deleting airplane: " . mysqli_error($db);
        }
    } else {
        // Error in deletion of related records
        echo "Error deleting related records: " . mysqli_error($db);
    }

    // Close the database connection
    mysqli_close($db);
} else {
    // If there's an invalid request or airplane ID is not set
    echo "Invalid request or airplane registration number not set";
}
?>
