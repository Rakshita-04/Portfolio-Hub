<?php
include 'includes/header.php';
include 'config.php';

// Delete project if requested
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM projects WHERE id=$id");
    header("Location: projects.php");
    exit;
}

$result = $conn->query("SELECT * FROM projects");
?>

<link rel="stylesheet" href="assets/style.css">
<div class="container">
    <h2>📁 Projects</h2>
    <a class="btn" href="add_edit_project.php">Add New Project</a>
    <ul>
        <?php while ($row = $result->fetch_assoc()) {
            $name = $row['name'] ?? '[Untitled Project]';
            $desc = $row['description'] ?? '';
        ?>
            <li>
                <strong><?php echo htmlspecialchars($name); ?></strong><br>
                <?php echo htmlspecialchars($desc); ?><br>
                <a class="btn" href="add_edit_project.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a class="btn" href="projects.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this project?')">Delete</a>
            </li>
        <?php } ?>
    </ul>
</div>

<?php include 'includes/footer.php'; ?>
