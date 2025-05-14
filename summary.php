<?php
include 'includes/header.php';
include 'config.php';

$projects = $conn->query("SELECT * FROM projects");
$skills = $conn->query("SELECT * FROM skills");
$feedbacks = $conn->query("SELECT * FROM feedback");
$availability = $conn->query("SELECT * FROM availability LIMIT 1")->fetch_assoc();
?>

<link rel="stylesheet" href="assets/style.css">
<div class="container">
    <h2>📊 Portfolio Summary</h2>
    <p style="text-align:center; font-size:18px;">Here's an overview of your work, skills, and client interactions.</p>

    <h3>📁 Projects</h3>
    <ul>
        <?php while ($p = $projects->fetch_assoc()) {
            $name = $p['name'] ?? '[Unnamed]';
            $desc = $p['description'] ?? '';
            echo "<li><strong>" . htmlspecialchars($name) . "</strong>: " . htmlspecialchars($desc) . "</li>";
        } ?>
    </ul>

    <h3>🛠️ Skills</h3>
    <ul>
        <?php while ($s = $skills->fetch_assoc()) {
            $skill = $s['name'] ?? '[Unnamed]';
            $level = $s['level'] ?? '';
            echo "<li><strong>" . htmlspecialchars($skill) . "</strong> — " . htmlspecialchars($level) . "</li>";
        } ?>
    </ul>

    <h3>📝 Client Feedback</h3>
    <ul>
        <?php while ($f = $feedbacks->fetch_assoc()) {
            $name = $f['name'] ?? '[No Name]';
            $msg = $f['message'] ?? '[No comment]';
            echo "<li><strong>" . htmlspecialchars($name) . ":</strong> \"" . htmlspecialchars($msg) . "\"</li>";
        } ?>
    </ul>

    <h3>🟢 Availability</h3>
    <p class="summary-page"><?php echo htmlspecialchars($availability['status'] ?? "Unknown"); ?></p>
</div>

<?php include 'includes/footer.php'; ?>
