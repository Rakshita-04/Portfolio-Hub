<?php
include 'includes/header.php';
include 'config.php';

if (isset($_GET['delete'])) {
    $conn->query("DELETE FROM feedback WHERE id=" . $_GET['delete']);
    header("Location: feedback.php");
    exit;
}

$result = $conn->query("SELECT * FROM feedback");
?>

<link rel="stylesheet" href="assets/style.css">
<div class="container">
    <h2>📝 Client Feedback</h2>
    <a class="btn" href="add_edit_feedback.php">Add Feedback</a>
    <ul>
        <?php while ($row = $result->fetch_assoc()) {
            $name = !empty($row['name']) ? htmlspecialchars($row['name']) : '[Unnamed]';
            $message = !empty($row['message']) ? htmlspecialchars($row['message']) : '[No feedback provided]';
        ?>
            <li>
                <strong><?php echo $name; ?>:</strong><br>
                "<?php echo $message; ?>"
                <a class="btn" href="add_edit_feedback.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a class="btn" href="feedback.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this feedback?')">Delete</a>
            </li>
        <?php } ?>
    </ul>
</div>

<?php include 'includes/footer.php'; ?>
