<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('db.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Req2Cost - Project History</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="logo.png" alt="Req2Cost Logo" class="logo-img">
            <h1>Req2Cost</h1>
        </div>
        <nav>
            <a href="index.html">Home</a>
            <a href="new_project.html">New Project</a>
            <a href="catalog.html">Requirements Catalog</a>
            <a href="projects_db.php">Project History</a>
            <a href="team.html">Team Profiles</a>
        </nav>
    </header>

    <main style="padding: 40px;">
        <section class="catalog-section" style="width: 90%;">
            <h2 style="text-align: center;">Database: Saved Projects</h2>
            <p style="text-align: center;">History of all estimated RCWS projects saved in the system.</p>
            
            <?php
            // Show success message if redirected from process_project.php
            if (isset($_GET['success']) && $_GET['success'] == 1) {
                echo "<div style='background-color: #2ecc71; color: white; padding: 10px; text-align: center; border-radius: 5px; margin-bottom: 20px;'><strong>Success!</strong> Project calculated and saved securely to the database.</div>";
            }
            ?>

            <table class="req-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client / Project Name</th>
                        <th>Mapped Capabilities</th>
                        <th>Total Cost ($)</th>
                        <th>Date Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT id, client_name, capabilities, total_cost, created_at FROM projects ORDER BY id DESC";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td><strong>" . htmlspecialchars($row["client_name"]) . "</strong></td>";
                            echo "<td style='font-size: 0.9em;'>" . htmlspecialchars($row["capabilities"]) . "</td>";
                            echo "<td style='color: #27ae60; font-weight: bold;'>$" . number_format($row["total_cost"]) . "</td>";
                            echo "<td>" . $row["created_at"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align:center;'>No projects found in the database.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer style="text-align: center; padding: 20px; background-color: #2c3e50; color: white;">
        <p>Contact Support: idanchen.job@gmail.com | Developed by: Idan Chen</p>
    </footer>
</body>
</html>