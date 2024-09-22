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

// Retrieve form data
$casID = isset($_POST['casID']) ? $_POST['casID'] : '';
$criminal_name = isset($_POST['criminal_name']) ? $_POST['criminal_name'] : '';
$criminal_cnic = isset($_POST['criminal_cnic']) ? $_POST['criminal_cnic'] : '';
$victim_name = isset($_POST['victim_name']) ? $_POST['victim_name'] : '';
$victim_cnic = isset($_POST['victim_cnic']) ? $_POST['victim_cnic'] : '';
$tool = isset($_POST['tool']) ? $_POST['tool'] : '';
$investigator_id = isset($_POST['investigator_id']) ? $_POST['investigator_id'] : '';
$judge_id = isset($_POST['judge_id']) ? $_POST['judge_id'] : '';
$judge_name = isset($_POST['judge_name']) ? $_POST['judge_name'] : '';
$court_id = isset($_POST['court_id']) ? $_POST['court_id'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';
$punishment = isset($_POST['punishment']) ? $_POST['punishment'] : '';
$witness = isset($_POST['witness']) ? $_POST['witness'] : '';
$crime_address = isset($_POST['crime_address']) ? $_POST['crime_address'] : '';
$crime = isset($_POST['crime']) ? $_POST['crime'] : '';

// Check if case ID already exists
$casIDCheckStmt = $conn->prepare("SELECT casID FROM crime WHERE casID = ?");
$casIDCheckStmt->bind_param("s", $casID);
$casIDCheckStmt->execute();
$casIDCheckStmt->store_result();

if ($casIDCheckStmt->num_rows > 0) {
    echo "Error: Case ID already exists.";
    $casIDCheckStmt->close();
    $conn->close();
    exit();
}
$casIDCheckStmt->close();

// Prepare and bind the insert statement
$stmt = $conn->prepare("INSERT INTO crime (casID, criminal_name, criminal_cnic, victim_name, victim_cnic, tool, investigator_id, judge_id, judge_name, court_id, date, status, punishment, witness, crime_address, crime) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssssssss", $casID, $criminal_name, $criminal_cnic, $victim_name, $victim_cnic, $tool, $investigator_id, $judge_id, $judge_name, $court_id, $date, $status, $punishment, $witness, $crime_address, $crime);

// Execute the statement and check if the record was added successfully
if ($stmt->execute()) {
    echo "New record added successfully.";
} else {
    echo "Error adding record: " . $stmt->error;
}

$stmt->close();

// Re-open the connection to fetch and display all records
$result = $conn->query("SELECT * FROM crime");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Criminal Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            background-image: url('Judges-Appointment-image.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        h1 {
            text-align: center;
            color: white;
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
    </style>
</head>
<body>
    <h1>All Criminal Records</h1>
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
            <th>Crime</th>
            <th>Actions</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "<td>
                <form action='delete_record.php' method='POST'>
                    <input type='hidden' name='casID' value='{$row['casID']}'>
                    <input type='submit' class='round-button' value='Delete'>
                </form>
                <form action='update_record.php' method='GET'>
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
