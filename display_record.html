<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Criminal Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Fallback color */
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
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid white;
        }
        th {
            background-color: rgba(0, 0, 0, 0.7); /* Darker background for header */
        }
        td form {
            display: inline;
        }
        .round-button {
            border-radius: 20px; /* Adjust border-radius for roundness */
            padding: 8px 15px;
            border: none;
            background-color: #4CAF50; /* Green background */
            color: white;
            cursor: pointer;
        }
        .round-button:hover {
            background-color: #45a049; /* Darker green on hover */
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
            <th>Actions</th>
        </tr>
        <?php
        // Fetch records
        $conn = new mysqli($servername, $username, $password, $dbname);
        $result = $conn->query("SELECT * FROM crime");
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
