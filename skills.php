<?php
include 'includes/header.php';
include 'config.php';

if (isset($_GET['delete'])) {
    $conn->query("DELETE FROM skills WHERE id=" . $_GET['delete']);
    header("Location: skills.php");
    exit;
}

$result = $conn->query("SELECT * FROM skills");
?>

<link rel="stylesheet" href="assets/style.css">
<div class="container">
    <h2>🛠️ Skills</h2>
    <a class="btn" href="add_edit_skill.php">Add Skill</a>
    <ul>
        <?php while ($row = $result->fetch_assoc()) {
            $name = $row['name'] ?? '[Unnamed Skill]';
            $level = $row['level'] ?? '';
        ?>
            <li>
                <strong><?php echo htmlspecialchars($name); ?></strong> — <?php echo htmlspecialchars($level); ?>
                <a class="btn" href="add_edit_skill.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a class="btn" href="skills.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this skill?')">Delete</a>
            </li>
        <?php } ?>
    </ul>
</div>

<?php include 'includes/footer.php'; ?>
