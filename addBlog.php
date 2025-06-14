<?php
include 'db.php';

if(!isset($_SESSION["id"])){
header("Location:login.php");
}else{
$username = $_SESSION["username"];
    if($_SERVER["REQUEST_METHOD"] === "POST"){
$title = $_POST["title"];
$category = $_POST["category"];
$image_tmp = $_FILES['image']['tmp_name'];
$image_name = $_FILES['image']['name'];
$content = $_POST["content"];
move_uploaded_file($image_tmp,"uploads/$image_name");


if(isset($_POST["draft"])){
  $status = "draft";
        $sql = $conn->prepare("insert into blogs(title,author_name,category,image_name,blog_content,status) values(?,?,?,?,?,?)");
$sql-> bind_param("ssssss",$title,$username,$category,$image_name,$content,$status);
if($sql->execute()){
  header("Location:dashboard.php");
}
        }else if(isset($_POST["publish"])){
          $status = "published";
        $sql = $conn->prepare("insert into blogs(title,author_name,category,image_name,blog_content,status) values(?,?,?,?,?,?)");
$sql-> bind_param("ssssss",$title,$username,$category,$image_name,$content,$status);
if($sql->execute()){
  header("Location:dashboard.php");
}
      }
}
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Blog Post</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      max-width: 800px;
      margin-top: 50px;
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .form-label {
      font-weight: 500;
    }
    .preview-img {
      max-width: 100%;
      max-height: 300px;
      margin-top: 10px;
      display: none;
    }
  </style>
</head>
<body>

<div class="container">
  <h2 class="text-center mb-4">Add New Blog Post</h2>

  <form action="" method="post" enctype="multipart/form-data">
    <!-- Title -->
    <div class="mb-3">
      <label for="title" class="form-label">Blog Title</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Enter blog title" required />
    </div>

    

    <!-- Category -->
    <div class="mb-3">
      <label for="category" class="form-label">Category</label>
      <select class="form-select" id="category" name="category" required>
        <option selected disabled>Select category</option>
        <option value="Tech">Tech</option>
        <option value="Travel">Travel</option>
        <option value="Food">Food</option>
        <option value="Education">Education</option>
        <option value="other">Other</option>
      </select>
    </div>

    <!-- Image Upload -->
    <div class="mb-3">
      <label for="image" class="form-label">Featured Image</label>
      <input class="form-control" type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
      <img id="imagePreview" class="preview-img" alt="Image preview"/>
    </div>

    <!-- Blog Content -->
    <div class="mb-3">
      <label for="content" class="form-label">Blog Content</label>
      <textarea class="form-control" id="content" name="content" rows="8" placeholder="Write your blog here..." required></textarea>
    </div>

    <!-- Buttons -->
    <div class="d-flex justify-content-between mt-4">
<div>
      <button type="reset" class="btn btn-secondary" name="clear">Clear</button>
      <a href = "index.php"><button type="button" class="btn btn-danger">Back</button></a></div>

      <div>
        <button type="submit" name="draft" class="btn btn-warning">Save as Draft</button>
        <button type="submit" name="publish" class="btn btn-primary">Publish</button>
      </div>
    </div>
  </form>
</div>

<script>
  function previewImage(event) {
    const image = document.getElementById('imagePreview');
    image.src = URL.createObjectURL(event.target.files[0]);
    image.style.display = 'block';
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
