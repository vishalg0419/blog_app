<?php
include 'db.php';

if(!isset($_SESSION["id"])){
header("Location:login.php");
}else{
$pre_sql = $conn->prepare("select * from blogs where id=?");
$pre_sql->bind_param("i",$_GET["id"]);
$pre_sql->execute();
$result = $pre_sql->get_result();
$blog = $result->fetch_assoc();

if(!$blog || $blog['author_name'] !== $_SESSION["username"]){
   header("Location:dashboard.php"); 
  die("Unauthorize Person");
   
}

$username = $_SESSION["username"];
    if($_SERVER["REQUEST_METHOD"] === "POST"){
$title = $_POST["title"];
$category = $_POST["category"];
$content = $_POST["content"];
$image_tmp = $_FILES['image']['tmp_name'];
$image_name = $_FILES['image']['name'];

if (!empty($image_name)) {
    $old_image = $blog['image_name'];
    if (file_exists("uploads/$old_image")) {
        unlink("uploads/$old_image");
    }
    move_uploaded_file($image_tmp, "uploads/$image_name");
} else {
    $image_name = $blog['image_name'];
}

if(isset($_POST["draft"])){
  $status = "draft";
        $sql = $conn->prepare("update blogs set title=?,category=?,image_name=?,blog_content=?,status=?,publish_date=? where id=?");
$sql-> bind_param("ssssssi",$title,$category,$image_name,$content,$status,date("Y-m-d"),$_GET['id']);
if($sql->execute()){
  header("Location:dashboard.php");
}
        }else if(isset($_POST["publish"])){
          $status = "published";
        $sql = $conn->prepare("update blogs set title=?,category=?,image_name=?,blog_content=?,status=?,publish_date=? where id=?");
$sql-> bind_param("ssssssi",$title,$category,$image_name,$content,$status,date("Y-m-d"),$_GET['id']);
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
  <title>Edit Blog Post</title>
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
  <h2 class="text-center mb-4">Edit Blog Post</h2>

  <form action="" method="post" enctype="multipart/form-data">
    <!-- Title -->
    <div class="mb-3">
      <label for="title" class="form-label">Blog Title</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Enter blog title"  value = "<?php echo $blog['title']; ?>" required />
    </div>

    <!-- Category -->
    <div class="mb-3">
      <label for="category" class="form-label">Category</label>
     <select class="form-select" id="category" name="category" required>
    <option disabled>Select category</option>
    <option value="Tech" <?php if ($blog['category'] == 'Tech') echo 'selected'; ?>>Tech</option>
    <option value="Travel" <?php if ($blog['category'] == 'Travel') echo 'selected'; ?>>Travel</option>
    <option value="Food" <?php if ($blog['category'] == 'Food') echo 'selected'; ?>>Food</option>
    <option value="Education" <?php if ($blog['category'] == 'Education') echo 'selected'; ?>>Education</option>
    <option value="Other" <?php if ($blog['category'] == 'Other') echo 'selected'; ?>>Other</option>
  </select>
    </div>

    <!-- Image Upload -->
    <div class="mb-3">
      <label for="image" class="form-label">Featured Image</label>
      <input class="form-control" type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
      <img id="imagePreview" class="preview-img" alt="Image preview"/>
      <?php if (!empty($blog['image_name'])){ ?>
    <img src="uploads/<?php echo $blog['image_name']; ?>" alt="Current image" class="preview-img" style="display:block; max-width:100%; max-height:300px; margin-top:10px;">
  <?php } ?>
 </div>

    <!-- Blog Content -->
    <div class="mb-3">
      <label for="content" class="form-label">Blog Content</label>
      <textarea class="form-control" id="content" name="content" rows="8" placeholder="Write your blog here..." required><?php echo $blog['blog_content'];?></textarea>
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
    const newPreview = document.getElementById('imagePreview');
    const existingPreview = document.querySelector('img[alt="Current image"]');

    if (existingPreview) {
      existingPreview.style.display = 'none'; // Hide old preview
    }

    newPreview.src = URL.createObjectURL(event.target.files[0]);
    newPreview.style.display = 'block'; // Show new preview
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
