<?php
// edit_post.php
session_start();
require 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get post ID from query string
$post_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($post_id <= 0) {
    header("Location: index.php");
    exit;
}

$errors = [];
$title = '';
$content = '';

// Fetch post details for the form
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if (!$post) {
    // Post not found
    header("Location: index.php");
    exit;
}

// On form submit
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
        $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
        $stmt->execute([$title, $content, $post_id]);

        header("Location: index.php");
        exit;
    }
} else {
    // On initial load, fill form with existing data
    $title = $post['title'];
    $content = $post['content'];
}

include 'header.php';
?>

<h2>Edit Post</h2>

<?php if ($errors): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error) echo "<li>" . htmlspecialchars($error) . "</li>"; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="edit_post.php?id=<?php echo $post_id; ?>" method="post">
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>" required>
  </div>
  <div class="mb-3">
    <label for="content" class="form-label">Content</label>
    <textarea id="content" name="content" class="form-control" rows="6" required><?php echo htmlspecialchars($content); ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Update Post</button>
  <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include 'footer.php'; ?>
