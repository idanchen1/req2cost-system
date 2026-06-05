<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "sql305.byethost5.com";
$username = "b5_41945493";
$password = "idanch3n";
$dbname = "b5_41945493_req2cost";

echo "<h2>System Diagnostic Test</h2>";

echo "<h3>Step 1: Testing Connection to MySQL Server...</h3>";
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("<span style='color:red; font-weight:bold;'>FAILED: Connection to server failed!</span><br>Error: " . $conn->connect_error . "<br><br><b>Reason:</b> The password 'idanch3n' or the username is INCORRECT for this specific MySQL server.");
}
echo "<span style='color:green; font-weight:bold;'>SUCCESS: Connected to MySQL Server! Password and Username are correct.</span><br><br>";

echo "<h3>Step 2: Testing Database Existence...</h3>";
if (!$conn->select_db($dbname)) {
    die("<span style='color:red; font-weight:bold;'>FAILED: Selecting database failed!</span><br>Error: " . $conn->error . "<br><br><b>Reason:</b> The password is correct, BUT the database '$dbname' does not exist. You need to create it in the cPanel.");
}
echo "<span style='color:green; font-weight:bold;'>SUCCESS: Database '$dbname' found!</span><br><br>";

echo "<h3>Step 3: Checking for 'projects' table...</h3>";
$result = $conn->query("SHOW TABLES LIKE 'projects'");
if ($result->num_rows > 0) {
    echo "<span style='color:green; font-weight:bold;'>SUCCESS: Table 'projects' exists! Everything is perfect.</span>";
} else {
    echo "<span style='color:red; font-weight:bold;'>FAILED: Table 'projects' does NOT exist.</span><br><b>Reason:</b> You need to run the CREATE TABLE SQL query in phpMyAdmin.";
}

$conn->close();
?>