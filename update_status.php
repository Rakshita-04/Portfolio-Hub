<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newStatus = $_POST["status"];
    $conn->query("UPDATE availability SET status='$newStatus' WHERE id=1");
    header("Location: availability.php");
    exit;
}

$currentStatus = "Unavailable";
$result = $conn->query("SELECT status FROM availability WHERE id = 1");
if ($result && $row = $result->fetch_assoc()) {
    $currentStatus = $row['status'];
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Status</title>
    <style>
        body {
            background: #f3f4f6;
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            max-width: 500px;
            margin: 60px auto;
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 12px 32px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        select {
            padding: 10px;
            font-size: 16px;
            width: 80%;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        button {
            background-color: #4f46e5;
            color: white;
            padding: 10px 20px;
            border: none;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
        }

        button:hover {
            background-color: #3730a3;
        }

        a {
            display: block;
            margin-top: 20px;
            color: #4f46e5;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Update Your Availability</h2>
    <form method="POST">
        <select name="status" required>
            <option value="Available" <?= $currentStatus == 'Available' ? 'selected' : '' ?>>✅ Available</option>
            <option value="Busy" <?= $currentStatus == 'Busy' ? 'selected' : '' ?>>⏳ Busy</option>
            <option value="Unavailable" <?= $currentStatus == 'Unavailable' ? 'selected' : '' ?>>❌ Unavailable</option>
        </select>
        <br>
        <button type="submit">Update</button>
    </form>
    <a href="availability.php">⬅️ Back to Status Page</a>
</div>

</body>
</html>
