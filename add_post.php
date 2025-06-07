<?php
// add_post.php
session_start();
require 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$errors = [];
$title = '';
$content = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if (empty($title)) {
        $errors[] = "Title is required.";
    }
    if (empty($content)) {
        $errors[] = "Content is required.";
    }

    if (!$errors) {
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$title, $content]);

        header("Location: index.php");
        exit;
    }
}

include 'header.php';
?>

<h2>Add New Post</h2>

<?php if ($errors): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error) echo "<li>" . htmlspecialchars($error) . "</li>"; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="add_post.php" method="post">
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>" required>
  </div>
  <div class="mb-3">
    <label for="content" class="form-label">Content</label>
    <textarea id="content" name="content" class="form-control" rows="6" required><?php echo htmlspecialchars($content); ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Add Post</button>
  <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include 'footer.php'; ?>
