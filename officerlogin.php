<?php
session_start();

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

// Debugging: Log the incoming POST data
error_log(print_r($_POST, true));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['officerID']) && isset($_POST['password'])) {
        $officerID = $_POST['officerID'];
        $password = $_POST['password'];

        // Debugging: Log the officerID being checked
        error_log("Checking officerID: $officerID");

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM officer WHERE officerID = ? AND password = ?");
        $stmt->bind_param("ss", $officerID, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['loggedin'] = true;
            $_SESSION['officerID'] = $officerID;
            echo json_encode(['success' => true, 'message' => 'Login successful']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
        }
        
        $stmt->close();
    }
} else {
    header('Location: login.html');
}

$conn->close();
?>
