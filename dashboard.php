<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
include 'config.php';

$search = $_GET['search'] ?? '';
$page = $_GET['page'] ?? 1;
$limit = 5;
$offset = ($page - 1) * $limit;

$where = $search ? "WHERE title LIKE '%$search%' OR content LIKE '%$search%'" : '';
$total = $conn->query("SELECT COUNT(*) AS count FROM posts $where")->fetch_assoc()['count'];
$pages = ceil($total / $limit);

$query = "SELECT * FROM posts $where ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Dashboard</h2>
        <div>
            <a href="add_post.php" class="btn btn-success">Add Post</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <form method="get" class="mb-3">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="form-control" placeholder="Search posts...">
    </form>

    <?php while ($post = $result->fetch_assoc()): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5><?= htmlspecialchars($post['title']) ?></h5>
                <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                <small><?= $post['created_at'] ?></small><br>
                <a href="edit_post.php?id=<?= $post['id'] ?>" class="btn btn-warning btn-sm mt-2">Edit</a>
                <a href="delete_post.php?id=<?= $post['id'] ?>" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Delete this post?')">Delete</a>
            </div>
        </div>
    <?php endwhile; ?>

    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</body>
</html>
