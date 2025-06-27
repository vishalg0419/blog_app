<?php
include 'db.php';

/* ───── Get the post by ?id ───── */
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id  = $_GET['id'];
$sql = $conn->query(
    "SELECT title, author_name, category, publish_date, image_name, blog_content
     FROM blogs
     WHERE id = '$id' AND status = 'published'"
);

if ($sql->num_rows === 0) {
    echo "<h2 style='text-align:center;margin-top:80px;'>Blog not found or unpublished.</h2>";
    exit;
}
$row = $sql->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title><?php echo $row['title']; ?> - BlogApp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    /* ───── Admin Sidebar (copied from index page) ───── */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 220px;
      background-color: #343a40;
      color: white;
      padding-top: 20px;
    }
    .sidebar h4 {
      text-align: center;
      margin-bottom: 30px;
    }
    .sidebar a {
      color: #ccc;
      text-decoration: none;
      display: block;
      padding: 12px 20px;
      transition: 0.3s;
    }
    .sidebar a:hover,
    .sidebar a.active {
      background-color: #495057;
      color: #fff;
    }

    /* ───── Main Area ───── */
    .main-content {
      margin-left: 220px;           /* keeps layout identical to index */
      padding: 40px 30px;
    }
    .blog-container {
      max-width: 900px;
      margin: 0 auto;
      background: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }
    .blog-title  { font-size: 2.5rem; font-weight: 700; margin-bottom: 20px; }
    .blog-meta   { color:#6c757d; font-size:.9rem; margin-bottom:30px; }
    .blog-image  { width:100%; max-height:450px; object-fit:cover;
                   border-radius:10px; margin-bottom:30px; }
    .blog-content{ font-size:1.1rem; line-height:1.8; color:#333; }
    .btn-back    { margin-top:40px; }

    @media (max-width:768px){
      .blog-title{font-size:2rem;}
      .main-content{margin-left:0;padding:30px 15px;}
      .sidebar{display:none;}       /* hide sidebar on small screens */
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h4>Admin Panel</h4>
  <a href="dashboard.php">Dashboard</a>
  <a href="index.php" class="active">Blogs</a>
  <a href="#">Users</a>
  <a href="logout.php">Logout</a>
</div>

<!-- Main Content -->
<div class="main-content">
  <div class="blog-container">
    <h1 class="blog-title"><?php echo $row['title']; ?></h1>

    <div class="blog-meta">
      <span>By <strong><?php echo $row['author_name']; ?></strong></span> |
      <span>Category: <em><?php echo $row['category']; ?></em></span> |
      <span>Published on:
        <time datetime="<?php echo $row['publish_date']; ?>">
          <?php echo date('F d, Y', strtotime($row['publish_date'])); ?>
        </time>
      </span>
    </div>

    <?php if (!empty($row['image_name'])) { ?>
      <img src="uploads/<?php echo $row['image_name']; ?>" class="blog-image" alt="Blog Image">
    <?php } ?>

    <div class="blog-content">
      <?php echo nl2br($row['blog_content']); ?>
    </div>

    <a href="index.php" class="btn btn-outline-primary btn-back">&larr; Back to Blogs</a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
