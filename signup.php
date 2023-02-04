<?php

include "./database/config.php";
error_reporting(0);

session_start();

if (isset($_SESSION["username"])) {
    header("Location: user_home.php");
}

if (isset($_POST["signup"])) {
  $type = $_POST["type"];

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]);
    $cpassword = md5($_POST["cpassword"]);
    $p = $_POST["password"];
    $error = "";
    $cls = "";

    if ($type == "student") {
        if ($password == $cpassword) {
            if (strlen($p) > 5) {
                $query = "SELECT * FROM students WHERE username = '$username'";
                $query_run = mysqli_query($conn, $query);

                if (!$query_run->num_rows > 0) {
                    $query = "SELECT * FROM students WHERE username = '$username' AND email = '$email'";
                    $query_run = mysqli_query($conn, $query);

                    if (!$query_run->num_rows > 0) {
                        $query2 = "INSERT INTO students(username,email,`password`)
                    VALUES ('$username', '$email', '$password')";
                        $query_run2 = mysqli_query($conn, $query2);

                        if ($query_run2) {
                            $_SESSION["studentname"] = $_POST["username"];
                            echo "<script> 
                        alert('Regestration Successfull.');
                        window.location.href='student_profile.php';
                        </script>";
                        } else {
                            $error = "Cannot Register";
                            $cls = "danger";
                        }
                    } else {
                        $error = "Student Already Exists";
                        $cls = "danger";
                    }
                } else {
                    $error = "Username Already Exists";
                    $cls = "danger";
                }
            } else {
                $error = "Password has to be minimum of 6 charecters";
                $cls = "danger";
            }
        } else {
            $error = "Passwords did not Matched.";
            $cls = "danger";
        }
    } elseif ($type == "teacher") {
        if ($password == $cpassword) {
            if (strlen($p) > 5) {
                $query = "SELECT * FROM teachers WHERE username = '$username'";
                $query_run = mysqli_query($conn, $query);

                if (!$query_run->num_rows > 0) {
                    $query = "SELECT * FROM teachers WHERE username = '$username' AND email = '$email'";
                    $query_run = mysqli_query($conn, $query);

                    if (!$query_run->num_rows > 0) {
                        $query2 = "INSERT INTO teachers(username,email,`password`)
                    VALUES ('$username', '$email', '$password')";
                        $query_run2 = mysqli_query($conn, $query2);

                        if ($query_run2) {
                            $_SESSION["teachername"] = $_POST["username"];
                            echo "<script> 
                        alert('Regestration Successfull.');
                        window.location.href='teacher_profile.php';
                        </script>";
                        } else {
                            $error = "Cannot Register";
                            $cls = "danger";
                        }
                    } else {
                        $error = "Teacher Already Exists";
                        $cls = "danger";
                    }
                } else {
                    $error = "Username Already Exists";
                    $cls = "danger";
                }
            } else {
                $error = "Password has to be minimum of 6 charecters";
                $cls = "danger";
            }
        } else {
            $error = "Passwords did not Matched.";
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

    <h1>Sign Up</h1>
    <div class="container">
      <div class="sign-up-content">
        <h2 class="form-title" style="margin-bottom:30px;">Sign Up to Sikkha</h2>
        <form method="POST" class="signup-form">
          <div class="<?php echo $cls;?>">
            <?php 
              if (isset($_POST['signup'])){
                echo $error;
              }
            ?>
          </div>
          <div class="form-radio ">
            <input type="radio" name="type" value="student" id="student" checked="checked" />
            <label for="student">Student</label>

            <input type="radio" name="type" value="teacher" id="teacher" />
            <label for="teacher">Teacher</label>
          </div>

          <div class="form-textbox">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" />
          </div>

          <div class="form-textbox">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" />
          </div>

          <div class="form-textbox">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" />
          </div>
          <div class="form-textbox">
            <label for="cpassword">Confirm <br> Password</label>
            <input type="password" name="cpassword" id="cpassword" />
          </div>
          <div class="form-group">
            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a
                href="#" class="term-service">Terms of service</a></label>
          </div>

          <div class="form-textbox">
            <input type="submit" name="signup" id="submit" class="submit" value="Create account" />
          </div>
        </form>

        <p class="loginhere">
          Already have an account ?<a href="login.php" class="loginhere-link"> Log in</a>
        </p>
      </div>
    </div>

  </div>

  <!-- JS -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/js/main.js"></script>

</html>