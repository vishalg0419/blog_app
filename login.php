<?php
include 'db.php';


if($_SERVER["REQUEST_METHOD"] === "POST"){
$username = $_POST["username"];
$password = $_POST["password"];


$sql2 = $conn->prepare("select id,password from users where username = ?");
$sql2->bind_param("s",$username);
$sql2->execute();
$sql2->store_result();
$sql2->bind_result($id,$dbpass);
echo "$id.$dbpass";

if($sql2->fetch() && password_verify($password,$dbpass)){
  $_SESSION["username"] = $username;
  $_SESSION["id"] = $id;
  header("Location:dashboard.php");
}else{
  echo"<script>alert('Enter Proper Credentials');</script>";
}




}



?>





<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <style>
      body {
        background: linear-gradient(135deg, #c3ecf9,rgb(224, 230, 238));
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }
      .login-container {
        width: 100%;
        max-width: 500px;
        padding: 30px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      }
      .login-container h2 {
        font-weight: 600;
        margin-bottom: 25px;
      }
      .form-label {
        font-weight: 500;
      }
      .btn-primary {
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 1px;
      }
    </style>
  </head>
  <body>

    <div class="login-container">
      <h2 class="text-center">Login</h2>
      <form action="" method="post">
        <div class="mb-3">
          <label for="name" class="form-label">UserName</label>
          <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($_SESSION['username'])?$_SESSION['username']:'' ?>" required/>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password"  required/>
        </div>

        <div class="text-center mt-4">
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </div>
        <div class="text-center mt-3">
  <p class="mb-0">Don't have an account?
    <a href="register.php" class="text-primary fw-semibold">Register here</a>
  </p>
</div>

      </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
