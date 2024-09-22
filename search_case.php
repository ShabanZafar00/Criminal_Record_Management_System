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

// Retrieve the Case ID from the POST request
$casID = isset($_POST['casID']) ? $_POST['casID'] : '';

if ($casID == '') {
    echo "<p style='color:red;'>Please enter a valid Case ID.</p>";
    exit();
}

// Prepare and execute the query to fetch the record
$stmt = $conn->prepare("SELECT * FROM crime WHERE casID = ?");
$stmt->bind_param("s", $casID);
$stmt->execute();
$result = $stmt->get_result();

// Check if the case exists
if ($result->num_rows > 0) {
    // Fetch the record details
    $row = $result->fetch_assoc();

    // Display the record in a table format with horizontal layout adjustments
    echo "
     <div style='overflow-x: auto; max-width: 100vw;'>
        <table style='width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px;'>
            <thead>
                <tr style='background-color: #602121; color: white;'>
                    <th style='padding: 5px; border: 1px solid #ddd;'>Case ID</th>
                    <th style='padding: 5px; border: 1px solid #ddd;'>Criminal Name</th>
                    <th style='padding: 5px; border: 1px solid #ddd;'>Criminal CNIC</th>
                    <th style='padding: 5px; border: 1px solid #ddd;'>Victim Name</th>
                    <th style='padding: 5px; border: 1px solid #ddd;'>Victim CNIC</th>
                    <th style='padding: 5px; border: 1px solid #ddd;'>Tool of Crime</th>
                    <th style='padding: 5px; border: 1px solid #ddd;'>Investigator ID</th>
                    <th style='padding: 5px; border: 1px solid #ddd;'>Judge ID</th>
                    <th style='padding: 5px; border: 1px solid #ddd;'>Judge Name</th>
                    <th style='padding: 5px; border: 1px solid #ddd;'>Court ID</th>
                    <th style='padding: 5px; border: 1px solid #ddd;'>Date</th>
                    <th style='padding: 5px; border: 1px solid #ddd;'>Status</th>
                    <th style='padding: 5px; border: 1px solid #ddd;'>Punishment</th>
                    <th style='padding: 5px; border: 1px solid #ddd;'>Witness</th>
                    <th style='padding: 5px; border: 1px solid #ddd;'>Crime Address</th>
                    <th style='padding: 5px; border: 1px solid #ddd;'>Crime</th>
                </tr>
            </thead>
            <tbody>
                <tr style='color: white;'>
                    <td style='padding: 5px; border: 1px solid #ddd;'>{$row['casID']}</td>
                    <td style='padding: 5px; border: 1px solid #ddd;'>{$row['criminal_name']}</td>
                    <td style='padding: 5px; border: 1px solid #ddd;'>{$row['criminal_cnic']}</td>
                    <td style='padding: 5px; border: 1px solid #ddd;'>{$row['victim_name']}</td>
                    <td style='padding: 5px; border: 1px solid #ddd;'>{$row['victim_cnic']}</td>
                    <td style='padding: 5px; border: 1px solid #ddd;'>{$row['tool']}</td>
                    <td style='padding: 5px; border: 1px solid #ddd;'>{$row['investigator_id']}</td>
                    <td style='padding: 5px; border: 1px solid #ddd;'>{$row['judge_id']}</td>
                    <td style='padding: 5px; border: 1px solid #ddd;'>{$row['judge_name']}</td>
                    <td style='padding: 5px; border: 1px solid #ddd;'>{$row['court_id']}</td>
                    <td style='padding: 5px; border: 1px solid #ddd;'>{$row['date']}</td>
                    <td style='padding: 5px; border: 1px solid #ddd;'>{$row['status']}</td>
                    <td style='padding: 5px; border: 1px solid #ddd;'>{$row['punishment']}</td>
                    <td style='padding: 5px; border: 1px solid #ddd;'>{$row['witness']}</td>
                    <td style='padding: 5px; border: 1px solid #ddd;'>{$row['crime_address']}</td>
                    <td style='padding: 5px; border: 1px solid #ddd;'>{$row['crime']}</td>
                </tr>
            </tbody>
        </table>
    </div>";

} else {
    // Case ID not found
    echo "<p style='color:red;'>No record found for Case ID: " . htmlspecialchars($casID) . "</p>";
}

$stmt->close();
$conn->close();
?>
