<?php
$casID = $_GET['casID'];

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

// Prepare and bind
$stmt = $conn->prepare("SELECT * FROM crime WHERE casID = ?");
$stmt->bind_param("s", $casID);

// Execute statement
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<tr>
            <th>Case ID</th><th>Criminal Name</th><th>Criminal CNIC</th><th>Victim Name</th><th>Victim CNIC</th><th>Tool of Crime</th><th>Investigator ID</th><th>Judge ID</th><th>Judge Name</th><th>Court ID</th><th>Date</th><th>Status</th><th>Punishment</th><th>Witness</th><th>Criminal Address</th>
          </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['casID']) . "</td>
                <td>" . htmlspecialchars($row['criminal_name']) . "</td>
                <td>" . htmlspecialchars($row['criminal_cnic']) . "</td>
                <td>" . htmlspecialchars($row['victim_name']) . "</td>
                <td>" . htmlspecialchars($row['victim_cnic']) . "</td>
                <td>" . htmlspecialchars($row['tool']) . "</td>
                <td>" . htmlspecialchars($row['investigator_id']) . "</td>
                <td>" . htmlspecialchars($row['judge_id']) . "</td>
                <td>" . htmlspecialchars($row['judge_name']) . "</td>
                <td>" . htmlspecialchars($row['court_id']) . "</td>
                <td>" . htmlspecialchars($row['date']) . "</td>
                <td>" . htmlspecialchars($row['status']) . "</td>
                <td>" . htmlspecialchars($row['punishment']) . "</td>
                <td>" . htmlspecialchars($row['witness']) . "</td>
                <td>" . htmlspecialchars($row['crime_address']) . "</td>
              </tr>";
    }
} else {
    echo "Error: Not Found";
}

// Close connection
$stmt->close();
$conn->close();
?>
