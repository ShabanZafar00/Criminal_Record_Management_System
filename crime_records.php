<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "criminal_record_management";

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

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO crime (casID, criminal_name, criminal_cnic, victim_name, victim_cnic, tool, investigator_id, judge_id, judge_name, court_id, date, status, punishment, witness, crime_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssssssss", $casID, $criminal_name, $criminal_cnic, $victim_name, $victim_cnic, $tool, $investigator_id, $judge_id, $judge_name, $court_id, $date, $status, $punishment, $witness, $crime_address);

// Execute the statement
if ($stmt->execute()) {
    header('Location: view_records.html');
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
