<?php
// Turn on error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connect to Database
require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get the client name from the form
    $clientName = $conn->real_escape_string($_POST['clientName']);
    
    $totalCost = 0;
    $architectureBlocks = array();
    
    // The "Engine": Mapping Client Requirements to Costs & Architecture Blocks
    $engineeringMap = [
        "BIT" => ["cost" => 5000, "block" => "BIT Module"],
        "FIZ" => ["cost" => 12000, "block" => "Elevation Control Logic"],
        "FPZ" => ["cost" => 15000, "block" => "Platform Mapping DB"],
        "Auto Track" => ["cost" => 25000, "block" => "Optical Camera + Tracker"],
        "ATR" => ["cost" => 45000, "block" => "FLIR + Algorithmic Computer"],
        "BDA" => ["cost" => 35000, "block" => "LRF + Ballistic Calc"],
        "Auto Boresight" => ["cost" => 85000, "block" => "Advanced Servo + Boresight Optics"],
        // CLASSIFIED BLOCKS
        "Search Radar" => ["cost" => 250000, "block" => "AESA RADAR + Targeting Link"],
        "Auto Fire" => ["cost" => 400000, "block" => "Lethal AI Engagement Processor"]
    ];

    // Check which boxes the user ticked, and build the system
    if (isset($_POST['requirements']) && is_array($_POST['requirements'])) {
        foreach ($_POST['requirements'] as $req) {
            if (array_key_exists($req, $engineeringMap)) {
                $totalCost += $engineeringMap[$req]["cost"];
                $architectureBlocks[] = $engineeringMap[$req]["block"];
            }
        }
    }

    // Format the blocks into a readable string (e.g. "BIT Module | Platform Mapping DB")
    $capabilitiesString = empty($architectureBlocks) ? "Basic Frame (No Software Blocks)" : implode(" | ", $architectureBlocks);
    $capabilitiesString = $conn->real_escape_string($capabilitiesString);

    // Insert the final calculated data into MySQL
    $sql = "INSERT INTO projects (client_name, capabilities, total_cost) VALUES ('$clientName', '$capabilitiesString', $totalCost)";

    if ($conn->query($sql) === TRUE) {
        // Success! Send the user straight to the DB page to see the result
        header("Location: projects_db.php?success=1");
        exit();
    } else {
        echo "<h2 style='color:red;'>Database Error:</h2><p>" . $conn->error . "</p>";
    }
} else {
    // If someone visits this URL directly without submitting a form, kick them back
    header("Location: new_project.html");
    exit();
}

$conn->close();
?>