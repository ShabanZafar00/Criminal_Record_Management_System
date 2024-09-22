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
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$contactNo = isset($_POST['contactNo']) ? $_POST['contactNo'] : '';
$officerID = isset($_POST['officerID']) && $_POST['officerID'] !== '' ? $_POST['officerID'] : ''; // Check if officerID is set and not empty
$rank = isset($_POST['rank']) ? $_POST['rank'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';

// Ensure officerID is not null for officers
if ($officerID === null) {
    die("Officer ID cannot be null for officers.");
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO officer (firstName, lastName, email, password, contactNo, officerID, rank, city) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $firstName, $lastName, $email, $password, $contactNo, $officerID, $rank, $city);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
    // Redirect to a success page
    header('Location: officerlogin.html');
    exit(); // Make sure to call exit after header to stop the script execution
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
