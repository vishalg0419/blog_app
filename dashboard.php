<?php
include 'db.php';


if(!isset($_SESSION["id"])){
  header("Location:login.php");
}else{
  $username = $_SESSION["username"];
$sql2 = $conn->prepare("select(select count(id) from blogs where author_name =?)as total_blog,(select count(id) from blogs where author_name = ? and status = 'draft')as pending");


$sql2->bind_param("ss",$username,$username);
$sql2->execute();
$result2 = $sql2->get_result();
if($row2 = $result2->fetch_assoc()){
  $total_blogs = $row2['total_blog'];
  $pending_blog = $row2['pending'];
}

$sql = $conn->prepare("select id,title,publish_date,status from blogs where author_name =?");
$sql ->bind_param("s",$username);
$sql->execute();
$result = $sql -> get_result();
}


?>






<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f1f4f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .sidebar {
      height: 100vh;
      background-color: #343a40;
      color: white;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 10px 20px;
      transition: background 0.3s ease;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
    .content {
      padding: 30px;
    }
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
    }
    .table thead {
      background-color: #e9ecef;
    }
    .table tbody tr:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-2 d-none d-md-block sidebar pt-4">
        <div class="text-center mb-4">
          <h4>Admin Panel</h4>
        </div>
        <a href="dashboard.php">Dashboard</a>
        <a href="index.php">Blogs</a>
        <a href="#">Users</a>
        <!-- <a href="#">Comments</a>
        <a href="#">Settings</a> -->
        <a href="logout.php">Logout</a>
      </nav>

      <!-- Main content -->
      <main class="col-md-10 ms-sm-auto col-lg-10 content">
<div
  class="container"
>
 <h3 class="mb-4 text-end me-3">Hello <?php echo $username; ?></h3>

</div>

        <h2 class="mb-4">Dashboard</h2>

        <!-- Stats cards -->
        <div class="row mb-4">
          <div class="col-md-3">
            <div class="card text-white bg-primary">
              <div class="card-body">
                <h5 class="card-title">Total Posts</h5>
                <p class="card-text fs-4"><?php echo isset($row2)?$total_blogs: '0'; ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-success">
              <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <p class="card-text fs-4">6</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-warning">
              <div class="card-body">
                <h5 class="card-title">Pending Blogs</h5>
                <p class="card-text fs-4"><?php echo isset($row2)?$pending_blog: '0'; ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-danger">
              <div class="card-body">
                <h5 class="card-title">Reports</h5>
                <p class="card-text fs-4">2</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Posts Table -->
        <div class="card">
          <div class="card-header bg-white">
            <h5 class="mb-0">Recent Posts</h5>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <!-- <th>Author</th> -->
                  <th>Date</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                
                    <!-- <button class="btn btn-sm btn-info">Edit</button>
                    <button class="btn btn-sm btn-danger">Delete</button>
                  </td>
                   <td><span class="badge bg-success">Published</span></td>
               <td><span class="badge bg-warning text-dark">Draft</span></td>
                   -->
<?php
$i =1;
while ($row = $result->fetch_assoc()) {
 
?>
<tr>
  <td><?php echo $i++;?></td>
    <td><?php echo $row['title']; ?></td>
      <td><?php echo $row['publish_date']; ?></td>
      <?php 
        $status= $row['status'];
        if($status == "draft"){ ?>
          <td><span class="badge bg-warning text-dark">Draft</span>
       <?php }else{ ?>
         <td><span class="badge bg-success">Published</span></td>
         <?php } ?>
        </td>

        <td> 
<a href="edit.php?id=<?php echo $row['id']; ?>"><button class="btn btn-sm btn-info">Edit</button>
                    <a href ="delete.php?id=<?php echo $row["id"];?>" onclick="return confirm('Are You Sure Want to Delete');"><button type="button" class="btn btn-sm btn-danger">Delete</button></a>
                  </td>
       </tr>
       <?php  } ?>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
