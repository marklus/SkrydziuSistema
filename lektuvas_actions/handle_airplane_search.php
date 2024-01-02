<?php
include '../connect.php'; // Include your database connection

if ($conn->connect_error) {
    die("Nepavyko prisijungti: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search_airplane"])) {
    // Retrieve search query
    $search_query = $_POST["search_query"];

    // Perform search across multiple fields in the 'lektuvai' table
    $searchSql = "SELECT * FROM lektuvai WHERE 
        registracijos_numeris LIKE '%$search_query%' OR
        pagaminimo_data LIKE '%$search_query%' OR
        isigijimo_data LIKE '%$search_query%' OR
        id_lektuvu_modelis LIKE '%$search_query%' OR
        id_skrydziu_imone LIKE '%$search_query%'";

    $result = $conn->query($searchSql);

    if ($result) {
        // Fetch and display search results
        while ($row = $result->fetch_assoc()) {
            // Display search results here
            // Example: echo $row['registracijos_numeris'];
        }
    } else {
        // Handle search failure
        echo "Įvyko klaida vykdant paiešką: " . $conn->error;
    }
} else {
    // Handle cases where the search form wasn't submitted
    echo "Search form not submitted";
}
?>
