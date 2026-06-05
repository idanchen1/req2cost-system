<?php
// Database connection details for ByetHost
$servername = "sql101.byethost5.com";
$username = "b5_41945493";
$password = "idanch3n";
$dbname = "b5_41945493_req2cost";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>