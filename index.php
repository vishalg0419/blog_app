<?php
include 'db.php';

$sql = $conn->query("SELECT id, title, author_name, category, publish_date, image_name FROM blogs WHERE status='published'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Blog Posts</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
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
    .main-content {
      margin-left: 220px;
      padding: 40px 30px;
    }
    .post-card {
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      transition: transform 0.3s;
    }
    .post-card:hover {
      transform: scale(1.01);
    }
    .post-img {
      height: 180px;
      object-fit: cover;
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
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Blogs</h2>
    <a href="addBlog.php" class="btn btn-success">+ Add New Post</a>
  </div>

  <div class="row g-4">
    <?php while($row = $sql->fetch_assoc()) { ?>
      <!-- Post Card -->
      <div class="col-12 col-sm-6 col-lg-4">
        <a href="blog.php?id=<?php echo $row['id'] ?>" class="text-decoration-none text-dark">
          <div class="card post-card h-100">
            <img src="uploads/<?= $row["image_name"] ?>" class="card-img-top post-img" alt="Post Image">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row["title"]; ?></h5>
              <p class="text-muted mb-1">Category: <strong><?php echo $row["category"]; ?></strong></p>
              <p class="text-muted mb-1">Date: <strong><?php echo $row["publish_date"]; ?></strong></p>        
              <p class="text-muted mb-1">Author: <strong><?php echo $row["author_name"]; ?></strong></p>
            </div>
          </div>
        </a>
      </div>
      <!-- End Post Card -->
    <?php } ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
