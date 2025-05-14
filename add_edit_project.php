<?php
include 'includes/header.php';
include 'config.php';

$name = $description = "";
$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM projects WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $name = $result['name'];
    $description = $result['description'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    if ($id) {
        $stmt = $conn->prepare("UPDATE projects SET name=?, description=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $description, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO projects (name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $description);
    }
    $stmt->execute();
    header("Location: projects.php");
    exit;
}
?>

<link rel="stylesheet" href="assets/style.css">
<div class="container">
    <h2><?php echo $id ? 'Edit' : 'Add'; ?> Project</h2>
    <form method="POST">
        <label>Project Name</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br><br>
        <label>Description</label><br>
        <textarea name="description" required><?php echo htmlspecialchars($description); ?></textarea><br><br>
        <input class="btn" type="submit" value="Save">
    </form>
</div>

<?php include 'includes/footer.php'; ?>
