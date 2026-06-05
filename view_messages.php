<?php
// Require the DB connection file
require_once('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Contact Messages - Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <h1>Req2Cost - Admin Panel</h1>
        </div>
        <nav>
            <a href="index.html">Back to Home</a>
        </nav>
    </header>

    <main style="padding: 40px; text-align: center;">
        <h2>Database Records: Contact Messages</h2>
        <table class="req-table" style="margin: 0 auto; width: 80%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date Received</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Select query to view the table
                $sql = "SELECT id, name, email, message, submission_date FROM contacts ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["message"] . "</td>";
                        echo "<td>" . $row["submission_date"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>0 results found in the database.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>