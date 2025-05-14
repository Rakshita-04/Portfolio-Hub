<?php
include 'includes/header.php';
include 'config.php';

$name = $message = "";
$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM feedback WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $name = $result['name'];
    $message = $result['message'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $message = $_POST['message'];
    if ($id) {
        $stmt = $conn->prepare("UPDATE feedback SET name=?, message=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $message, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO feedback (name, message) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $message);
    }
    $stmt->execute();
    header("Location: feedback.php");
    exit;
}
?>

<link rel="stylesheet" href="assets/style.css">
<div class="container">
    <h2><?php echo $id ? 'Edit' : 'Add'; ?> Feedback</h2>
    <form method="POST">
        <label>Client Name</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br><br>
        <label>Feedback Message</label><br>
        <textarea name="message" required><?php echo htmlspecialchars($message); ?></textarea><br><br>
        <input class="btn" type="submit" value="Save">
    </form>
</div>

<?php include 'includes/footer.php'; ?>
