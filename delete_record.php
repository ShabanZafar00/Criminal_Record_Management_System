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

if (isset($_POST['casID'])) {
    $casID = $_POST['casID'];

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM crime WHERE casID = ?");
    $stmt->bind_param("s", $casID);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error: No Case ID provided for deletion.";
}

$conn->close();

// Redirect back to the main page after deletion
header("Location: view_records.php");
exit();
?>
