<?php
include 'includes/header.php';
include 'config.php';

$result = $conn->query("SELECT * FROM availability LIMIT 1");
$row = $result->fetch_assoc();
?>

<link rel="stylesheet" href="assets/style.css">
<div class="container">
    <h2>🟢 Availability Status</h2>
    <form method="POST" action="availability.php">
        <label>
            <input type="radio" name="status" value="Available" <?php if ($row['status'] == 'Available') echo 'checked'; ?>> Available
        </label><br>
        <label>
            <input type="radio" name="status" value="Not Available" <?php if ($row['status'] == 'Not Available') echo 'checked'; ?>> Not Available
        </label><br><br>
        <input class="btn" type="submit" name="submit" value="Update Status">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $status = $_POST['status'];
        $conn->query("UPDATE availability SET status='$status'");
        echo "<p class='summary-page'>Status updated successfully!</p>";
    }
    ?>
</div>

<?php include 'includes/footer.php'; ?>
