<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "criminal_record_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$contactNo = isset($_POST['contactNo']) ? $_POST['contactNo'] : '';

$emailCheckStmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
$emailCheckStmt->bind_param("s", $email);
$emailCheckStmt->execute();
$emailCheckStmt->store_result();

if ($emailCheckStmt->num_rows > 0) {
    echo "Error: Email already exists.";
    $emailCheckStmt->close();
    $conn->close();
    exit();
}
$emailCheckStmt->close();

$stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password, contactNo) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $firstName, $lastName, $email, $password, $contactNo);

if ($stmt->execute()) {
    echo "New record created successfully";
    // Redirect to a success page
    header('Location: login.html');
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
