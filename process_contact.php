<?php
// Turn on error reporting for debugging (prevents blank 500 errors)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the DB connection
require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Safely get variables from form
    $name = isset($_POST['senderName']) ? $conn->real_escape_string($_POST['senderName']) : 'Unknown';
    $email = isset($_POST['senderEmail']) ? $conn->real_escape_string($_POST['senderEmail']) : 'Unknown';
    $message = isset($_POST['message']) ? $conn->real_escape_string($_POST['message']) : 'No message';
    
    $department = isset($_POST['department']) ? $_POST['department'] : 'General';
    $priority = isset($_POST['priority']) ? $_POST['priority'] : 'Normal';
    $copyMe = isset($_POST['copyMe']) ? "Yes" : "No";

    // Insert into MySQL
    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        
        // Mail Function
        $to = "idanchen.job@gmail.com";
        $subject = "New $priority Priority Contact - $department Dept";
        
        $mailBody = "You have received a new message from $name.\n\n";
        $mailBody .= "Email: $email\n";
        $mailBody .= "Department: $department\n";
        $mailBody .= "Priority: $priority\n";
        $mailBody .= "Requested Copy: $copyMe\n\n";
        $mailBody .= "Message:\n$message";
        
        $headers = "From: noreply@req2cost.com";
        
        // We use @ to suppress server-level mail warnings on free hosting
        @mail($to, $subject, $mailBody, $headers);
        
        // Output success UI
        echo "<!DOCTYPE html><html><head><link rel='stylesheet' href='style.css'></head><body style='text-align:center; padding:50px; font-family:Arial;'>";
        echo "<h2 style='color:#27ae60;'>Message Sent and Saved Successfully!</h2>";
        echo "<p>Thank you, $name. The data is saved and an email has been dispatched.</p><br>";
        echo "<a href='idan_chen.html' class='btn' style='text-decoration:none; padding: 10px 20px; background-color: #2c3e50; color: white; border-radius: 5px;'>Return to Profile</a>";
        echo "</body></html>";

    } else {
        echo "<h2 style='color:red;'>Database Error:</h2><p>" . $conn->error . "</p>";
    }
} else {
    echo "<h2>Error: No data was submitted.</h2>";
}
$conn->close();
?>