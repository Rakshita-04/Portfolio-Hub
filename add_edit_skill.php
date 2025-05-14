<?php
include 'includes/header.php';
include 'config.php';

$name = $level = "";
$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM skills WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $name = $result['name'];
    $level = $result['level'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $level = $_POST['level'];
    if ($id) {
        $stmt = $conn->prepare("UPDATE skills SET name=?, level=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $level, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO skills (name, level) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $level);
    }
    $stmt->execute();
    header("Location: skills.php");
    exit;
}
?>

<link rel="stylesheet" href="assets/style.css">
<div class="container">
    <h2><?php echo $id ? 'Edit' : 'Add'; ?> Skill</h2>
    <form method="POST">
        <label>Skill Name</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br><br>
        <label>Proficiency Level</label><br>
        <input type="text" name="level" value="<?php echo htmlspecialchars($level); ?>" required><br><br>
        <input class="btn" type="submit" value="Save">
    </form>
</div>

<?php include 'includes/footer.php'; ?>
