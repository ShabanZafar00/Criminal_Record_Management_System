<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "criminal_record_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all records from the crime table
$result = $conn->query("SELECT * FROM crime");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criminal Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            min-height: 100vh;
            width: 100%;
            flex-direction: column;
            align-items: center;
            background-image: url('Judges-Appointment-image.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white;
        }
        h1 {
            text-align: center;
            padding-top: 20px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            border: 3px solid white;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid white;
        }
        th {
            background-color: rgba(0, 0, 0, 0.7);
        }
        .round-button {
            border-radius: 20px;
            padding: 8px 15px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        .round-button:hover {
            background-color: #45a049;
        }
        .add-button {
            margin: 20px;
            display: block;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Criminal Records</h1>

    <!-- Button to Add a New Record -->
    <div class="add-button">
        <a href="add_record.html">
            <button class="round-button">Add New Record</button>
        </a>
    </div>

    <table>
        <tr>
            <th>Case ID</th>
            <th>Criminal Name</th>
            <th>Criminal CNIC</th>
            <th>Victim Name</th>
            <th>Victim CNIC</th>
            <th>Tool of Crime</th>
            <th>Investigator ID</th>
            <th>Judge ID</th>
            <th>Judge Name</th>
            <th>Court ID</th>
            <th>Date</th>
            <th>Status</th>
            <th>Punishment</th>
            <th>Witness</th>
            <th>Crime Address</th>
            <th>Actions</th>
        </tr>
        <?php
        // Display each record in the table
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "<td>
                <form action='delete_record.php' method='POST' style='display:inline;'>
                    <input type='hidden' name='casID' value='{$row['casID']}'>
                    <input type='submit' class='round-button' value='Delete'>
                </form>
                <form action='update_record.php' method='GET' style='display:inline;'>
                    <input type='hidden' name='casID' value='{$row['casID']}'>
                    <input type='submit' class='round-button' value='Update'>
                </form>
            </td>";
            echo "</tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
