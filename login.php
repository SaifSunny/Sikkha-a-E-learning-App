<?php

include "./database/config.php";
error_reporting(0);

session_start();

if (isset($_SESSION["username"])) {
    header("Location: user_home.php");
}

if (isset($_POST["signin"])) {
  $error = "";
  $cls = "";

  $type = $_POST["type"];


  if ($type == "student") {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

      $sql = "SELECT * FROM students WHERE username='$username'";
      $result = mysqli_query($conn, $sql);

      if ($result->num_rows > 0) {
          $sql = "SELECT * FROM students WHERE `password`='$password'";
          $result = mysqli_query($conn, $sql);

          if ($result->num_rows > 0) {
              $sql = "SELECT * FROM students WHERE username='$username' AND password='$password'";
              $result = mysqli_query($conn, $sql);

              if ($result->num_rows > 0) {
                  $_SESSION["studentname"] = $_POST["username"];
                  header("Location: student_home.php");
              } else {
                  $error = "Woops! Someting Went Wrong.";
                  $cls = "danger";
              }
          } else {
              $error = "Woops! Password is Incorrect.";
              $cls = "danger";
          }
      } else {
          $error = "Woops! Username is Incorrect.";
          $cls = "danger";
      }
  } 
  elseif ($type == "teacher") {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

      $sql = "SELECT * FROM teachers WHERE username='$username'";
      $result = mysqli_query($conn, $sql);

      if ($result->num_rows > 0) {
          $sql = "SELECT * FROM teachers WHERE `password`='$password'";
          $result = mysqli_query($conn, $sql);

          if ($result->num_rows > 0) {
              $sql = "SELECT * FROM teachers WHERE username='$username' AND password='$password'";
              $result = mysqli_query($conn, $sql);

              if ($result->num_rows > 0) {
                  $_SESSION["teachername"] = $_POST["username"];
                  header("Location: teacher_home.php");
              } else {
                  $error = "Woops! Someting Went Wrong.";
                  $cls = "danger";
              }
          } else {
              $error = "Woops! Password is Incorrect.";
              $cls = "danger";
          }
      } else {
          $error = "Woops! Username is Incorrect.";
          $cls = "danger";
      }
  } 
  elseif ($type == "admin") {
    $username = $_POST["username"];
    $password = $_POST["password"];

      $sql = "SELECT * FROM `admin` WHERE username='$username'";
      $result = mysqli_query($conn, $sql);

      if ($result->num_rows > 0) {
          $sql = "SELECT * FROM `admin` WHERE `password`='$password'";
          $result = mysqli_query($conn, $sql);

          if ($result->num_rows > 0) {
              $sql = "SELECT * FROM `admin` WHERE username='$username' AND password='$password'";
              $result = mysqli_query($conn, $sql);

              if ($result->num_rows > 0) {
                  $_SESSION["adminname"] = $_POST["username"];
                  header("Location: admin_home.php");
              } else {
                  $error = "Woops! Someting Went Wrong.";
                  $cls = "danger";
              }
          } else {
              $error = "Woops! Password is Incorrect.";
              $cls = "danger";
          }
      } else {
          $error = "Woops! Username is Incorrect.";
          $cls = "danger";
      }
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sikkha - E-Learning Website</title>

  <!-- Font Icon -->
  <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.min.css">

  <!-- Main css -->
  <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>

  <div class="main">

    <h1>Log In</h1>
    <div class="container" style="padding-top:30px;">
      <div class="sign-up-content">
        <h2 class="form-title" style="margin-bottom:30px;">Log In to Sikkha</h2>
        <form method="POST" class="signup-form">
          <div class="<?php echo $cls;?>">
            <?php 
              if (isset($_POST['signin'])){
                echo $error;
              }
            ?>
          </div>
          <div class="form-radio ">
            <input type="radio" name="type" value="student" id="student" checked="checked" />
            <label for="student">Student</label>

            <input type="radio" name="type" value="teacher" id="teacher" />
            <label for="teacher">Teacher</label>

            <input type="radio" name="type" value="admin" id="admin" />
            <label for="admin">Admin</label>
          </div>

          <div class="form-textbox">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" />
          </div>

          <div class="form-textbox">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" />
          </div>

          <div class="form-group">
            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
            <label for="agree-term" class="label-agree-term"><span><span></span></span>Remember Me</label>
          </div>

          <div class="form-textbox">
            <input type="submit" name="signin" id="submit" class="submit" value="Log In" />
          </div>
        </form>

        <p class="loginhere">
          New to Sikkha ? <a href="signup.php" class="loginhere-link"> Sign Up Now</a>
        </p>
      </div>
    </div>

  </div>

  <!-- JS -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/js/main.js"></script>

</html>