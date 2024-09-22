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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['casID'])) {
    $casID = $_GET['casID'];

    // Fetch the record to update
    $stmt = $conn->prepare("SELECT * FROM crime WHERE casID = ?");
    $stmt->bind_param("s", $casID);
    $stmt->execute();
    $result = $stmt->get_result();
    $record = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated data
    $casID = $_POST['casID'];
    $criminal_name = $_POST['criminal_name'];
    $criminal_cnic = $_POST['criminal_cnic'];
    $victim_name = $_POST['victim_name'];
    $victim_cnic = $_POST['victim_cnic'];
    $tool = $_POST['tool'];
    $investigator_id = $_POST['investigator_id'];
    $judge_id = $_POST['judge_id'];
    $judge_name = $_POST['judge_name'];
    $court_id = $_POST['court_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $punishment = $_POST['punishment'];
    $witness = $_POST['witness'];
    $crime_address = $_POST['crime_address'];
    $crime = $_POST['crime'];

    // Update the record in the database
    $stmt = $conn->prepare("UPDATE crime SET criminal_name = ?, criminal_cnic = ?, victim_name = ?, victim_cnic = ?, tool = ?, investigator_id = ?, judge_id = ?, judge_name = ?, court_id = ?, date = ?, status = ?, punishment = ?, witness = ?, crime_address = ?, crime = ? WHERE casID = ?");
    $stmt->bind_param("ssssssssssssssss", $criminal_name, $criminal_cnic, $victim_name, $victim_cnic, $tool, $investigator_id, $judge_id, $judge_name, $court_id, $date, $status, $punishment, $witness, $crime_address,$crime, $casID);

    if ($stmt->execute()) {
        header("Location: view_records.php"); // Redirect to main page after updating the record
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="update.css"> <!-- Link to the external CSS file -->
</head>
<body>
    <div class="signup_page">
        <div class="content">
            <h1>Update Criminal Record</h1>
            <form action="update_record.php" method="POST">
                <input type="hidden" name="casID" value="<?php echo htmlspecialchars($record['casID']); ?>">
                <!-- Input fields pre-filled with existing record data -->
                <label>Criminal Name: <input type="text" class="rounded-input" name="criminal_name" value="<?php echo htmlspecialchars($record['criminal_name']); ?>" required></label><br>
                <label>Criminal CNIC: <input type="text" class="rounded-input" name="criminal_cnic" value="<?php echo htmlspecialchars($record['criminal_cnic']); ?>" required></label><br>
                <label>Victim Name: <input type="text" class="rounded-input" name="victim_name" value="<?php echo htmlspecialchars($record['victim_name']); ?>" required></label><br>
                <label>Victim CNIC: <input type="text" class="rounded-input" name="victim_cnic" value="<?php echo htmlspecialchars($record['victim_cnic']); ?>" required></label><br>
                <label>Tool of Crime: <input type="text" class="rounded-input" name="tool" value="<?php echo htmlspecialchars($record['tool']); ?>"></label><br>
                <label>Investigator ID: <input type="text" class="rounded-input" name="investigator_id" value="<?php echo htmlspecialchars($record['investigator_id']); ?>"></label><br>
                <label>Judge ID: <input type="text" class="rounded-input" name="judge_id" value="<?php echo htmlspecialchars($record['judge_id']); ?>"></label><br>
                <label>Judge Name: <input type="text" class="rounded-input" name="judge_name" value="<?php echo htmlspecialchars($record['judge_name']); ?>"></label><br>
                <label>Court ID: <input type="text" class="rounded-input" name="court_id" value="<?php echo htmlspecialchars($record['court_id']); ?>"></label><br>
                <label>Date: <input type="date" class="rounded-input" name="date" value="<?php echo htmlspecialchars($record['date']); ?>"></label><br>
                <label>Status: <input type="text" class="rounded-input" name="status" value="<?php echo htmlspecialchars($record['status']); ?>"></label><br>
                <label>Punishment: <input type="text" class="rounded-input" name="punishment" value="<?php echo htmlspecialchars($record['punishment']); ?>"></label><br>
                <label>Witness: <input type="text" class="rounded-input" name="witness" value="<?php echo htmlspecialchars($record['witness']); ?>"></label><br>
                <label>Crime Address: <input type="text" class="rounded-input" name="crime_address" value="<?php echo htmlspecialchars($record['crime_address']); ?>"></label><br>
                <label>Crime: <input type="text" class="rounded-input" name="crime" value="<?php echo htmlspecialchars($record['crime']); ?>"></label><br>
                <div class="large-button">
                    <input type="submit" value="Update Record">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
