<?php
include 'db.php';
$name = $email = $username = $gender = $role = $password = $cpassword = "";

if($_SERVER["REQUEST_METHOD"]==="POST"){
$name = $_POST["name"]?? '';
$email = $_POST["email"]?? '';
$username = $_POST["username"]?? '';
$gender = $_POST["gender"]?? '';
$role = $_POST["role"]?? '';
$password = $_POST["password"]?? '';
$cpassword = $_POST["cpassword"]?? '';


if(empty($name)){
    echo "<script>alert('Enter Name')</script>";
}elseif(empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo "<script>alert('Enter Valid Email');</script>";
}elseif(empty($username)){
    echo "<script>alert('Enter UserName');</script>";
}
elseif(empty($gender)){
    echo "<script>alert('Enter Gender')</script>";
}
else if(empty($role)){
    echo "<script>alert('Enter Role')</script>";
}else if((empty($password) || empty($cpassword)) || $password != $cpassword){
    echo "<script>alert('Enter Password Correctly')</script>";
}else{

    $pass = password_hash($cpassword,PASSWORD_DEFAULT);
    $sql = "insert into users(name,email,username,gender,role,password) values(?,?,?,?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt-> bind_param("ssssss",$name,$email,$username,$gender,$role,$pass);
    if($stmt->execute()){
         $_SESSION["username"] = $name;
        header("Location:login.php");
       
    }
}
}

?>





<!doctype html>
<html lang="en">
  <head>
    <title>Registration Page</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      body {
        background-color: #f8f9fa;
      }
      .registration-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="registration-container">
        <h2 class="text-center mb-4">User Registration</h2>
        <form action="register.php" method="post">

          <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label">Full Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="name" name="name" required />
            </div>
          </div>

<div class="mb-3 row">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="email" name="email" required />
            </div>
          </div>

          <!-- Username -->
          <div class="mb-3 row">
            <label for="username" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="username" name="username" required />
            </div>
          </div>

          <!-- Gender -->
          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Gender</label>
            <div class="col-sm-9">
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="gender"
                  id="male"
                  value="Male"
                  required
                />
                <label class="form-check-label" for="male">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="gender"
                  id="female"
                  value="Female"
                />
                <label class="form-check-label" for="female">Female</label>
              </div>
            </div>
          </div>

          <!-- Role -->
          <div class="mb-3 row">
            <label for="role" class="col-sm-3 col-form-label">Role</label>
            <div class="col-sm-9">
              <select class="form-select" name="role" id="role" required>
      
                <option value="Admin">Admin</option>
                <option value="Editor">Editor</option>
                <option value="User" selected>User</option>
              </select>
            </div>
          </div>

          <!-- Password -->
          <div class="mb-3 row">
            <label for="password" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
              <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                required
              />
            </div>
          </div>

          <!-- Confirm Password -->
          <div class="mb-3 row">
            <label for="confirm_password" class="col-sm-3 col-form-label">Confirm</label>
            <div class="col-sm-9">
              <input
                type="password"
                class="form-control"
                id="confirm_password"
                name="cpassword"
                required
              />
            </div>
          </div>

          <!-- Submit -->
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary w-100">Register</button>
          </div>
          <div class="text-center mt-3">
  <p class="mb-0">Already have an account?
    <a href="login.php" class="text-primary fw-semibold">Login here</a>
  </p>
</div>

        </form>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    ></script>
  </body>
</html>
