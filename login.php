<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
          <h3 class="mb-0">Login</h3>
        </div>
        <div class="card-body">
          <form action="" method="post">
            <div class="form-group">
              <label for="email">Email address:</label>
              <input type="email" class="form-control form-control-lg" placeholder="Enter email" name="email" id="email" required>
            </div>
            <div class="form-group">
              <label for="pwd">Password:</label>
              <input type="password" class="form-control form-control-lg" placeholder="Enter password" name="pass" id="pwd" required>
            </div>
            <div class="form-group form-check">
              <input class="form-check-input" type="checkbox" id="remember">
              <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button type="submit" name="btn" class="btn btn-primary btn-lg btn-block">Login</button>
          </form>

          <?php
          if(isset($_POST["btn"])){
              $email = $_POST["email"];
              $pass = md5($_POST["pass"]);
              require "db.php";
              $st = "SELECT * FROM `users` WHERE `email`='$email' AND `pass` = '$pass'";
              $result = mysqli_query($db, $st) or die(mysqli_error($db));
              if($row = mysqli_fetch_array($result)){
                  session_start();
                  $_SESSION["email"] = $row[1];
                  header("location:home.php");
              } else {
                  echo "<div class='alert alert-danger mt-3'>Email or password incorrect</div>";
              }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
