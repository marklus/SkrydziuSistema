<?php
// connect.php 
$server = 'localhost';
$username = 'stud';
$password = 'stud';
$database = 'vartvald';
$conn = mysqli_connect($server, $username, $password, $database);
// Check connection 
if (!$conn) {
    exit('Error: could not establish database connection');
}
// Select database 
if (!mysqli_select_db($conn, $database)) {
    exit('Error: could not select the database');
}
?>