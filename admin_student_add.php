<?php
include_once "./database/config.php";

session_start();
$username = $_SESSION["adminname"];

if (!isset($_SESSION["adminname"])) {
    header("Location: login.php");
}

$sql = "SELECT * FROM admin WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$image = $row["admin_img"];
$admin_id = $row["admin_id"];



if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $username = $_POST['username'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];

    $p = $_POST['password'];
    $error = "";
    $cls="";
 
    $name = $_FILES['file']['name'];
    $target_dir = "assets/img/students/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
  
    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    if (strlen($p) > 5) {
    
        $query = "SELECT * FROM students WHERE username = '$username'";
        $query_run = mysqli_query($conn, $query);
        if (!$query_run->num_rows > 0) {

            $query = "SELECT * FROM students WHERE username = '$username' AND email = '$email'";
            $query_run = mysqli_query($conn, $query);
            if(!$query_run->num_rows > 0){

                // Check extension
                if( in_array($imageFileType,$extensions_arr) ){

                    // Upload file
                    if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){

                        // Convert to base64 
                        $image_base64 = base64_encode(file_get_contents('assets/img/students/'.$name));
                        $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

                        // Insert record

                        $query2 = "INSERT INTO students(username ,email,`password`,firstname,lastname,contact,gender,birthday,student_img, `address`, city, zip)
                        VALUES ('$username', '$email', '$password', '$firstname', '$lastname', '$contact', '$gender', '$birthday', '$name', '$address', '$city', '$zip')";
                        $query_run2 = mysqli_query($conn, $query2);
            
                        if ($query_run2) {
                            $cls="success";
                            $error = "Students Successfully Added.";
                        } 
                        else {
                            $cls="danger";
                            $error = mysqli_error($conn);
                        }

                    }else{
                        $cls="danger";
                        $error = 'Unknown Error Occurred.';
                    }
                }else{
                    $cls="danger";
                    $error = 'Invalid File Type';
                }
            }
            else{
                $cls="danger";
                $error = "Student Already Exists";
            }
            
        }else{
            $cls="danger";
            $error = "username Already Exists";
        }
    }else{
        $cls="danger";
        $error = 'Password has to be minimum of 6 charecters.';
    }
   
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ========== Page Title ========== -->
    <title>Sikkha - E-Learning Website</title>

    <!-- ========== Google Fonts ========== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- ========== Start Stylesheet ========== -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/css/flaticon-set.css" rel="stylesheet" />
    <link href="assets/css/elegant-icons.css" rel="stylesheet" />
    <link href="assets/css/magnific-popup.css" rel="stylesheet" />
    <link href="assets/css/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/css/owl.theme.default.min.css" rel="stylesheet" />
    <link href="assets/css/animate.css" rel="stylesheet" />
    <link href="assets/css/bootsnav.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet" />
    <!-- ========== End Stylesheet ========== -->

</head>

<body>
    <!-- Start Header Top 
    ============================================= -->
    <?php include_once("./templates/admin_header.php");?>
    <!-- End Header Top -->


    <!-- Start admin Profiel 
    ============================================= -->
    <div class="students-profiel adviros-details-area default-padding">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-md-10" style="padding-bottom:30px;">
                    <h2 style="font-weight:600">Add Student</h2>
                    <p><a href="admin_home.php">Home</a> / <a href="admin_students.php">Manage Students</a> / Add Student
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 info main-content">
                    <!-- Star Tab Info -->
                    <div class="tab-info">
                        <!-- Start Tab Content -->
                        <div class="tab-content tab-content-info">
                            <!-- Single Tab -->
                            <div class="tab-pane fade active in">
                                <div class="info title">
                                    <form action="" method="POST" enctype='multipart/form-data'>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-<?php echo $cls;?>">
                                                    <?php 
                                                    if (isset($_POST['submit']) || isset($_POST['submit_img'])){
                                                        echo $error;
                                                }?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div>
                                                    <img src="assets/img/students/user.png" alt="Thumb" width="80%">
                                                </div>

                                                <input type="file" name="file" id="file"
                                                    style="border:none; margin-top:40px;">
                                                <button type="submit" name="submit_img" class="btn btn-warning active"
                                                    style="margin-top:10px;color:white;margin-bottom:30px"><i
                                                        class="fa fa-edit"></i>
                                                    Update
                                                    Image</button>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">First Name <span class="color:red;">*</span></label>
                                                    <input type="text" class="form-control" name="firstname"
                                                        id="firstname" placeholder="Enter First Name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Last Name <span class="color:red;">*</span></label>
                                                    <input type="text" class="form-control" name="lastname"
                                                        id="lastname" placeholder="Enter Last Name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Username <span class="color:red;">*</span></label>
                                                    <input type="text" class="form-control" name="username"
                                                        id="username" placeholder="Username">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Password <span class="color:red;">*</span></label>
                                                    <input type="text" class="form-control" name="password"
                                                        id="password" placeholder="Password">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Date of Birth <span class="color:red;">*</span></label>
                                                    <input type="date" class="form-control" name="birthday"
                                                        id="birthday" placeholder="Birthday" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Contact <span class="color:red;">*</span></label>
                                                    <input type="text" class="form-control" name="contact" id="contact"
                                                        placeholder="Enter Contact" required>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Gender <span class="color:red;">*</span></label>
                                                    <input type="text" class="form-control" name="gender" id="gender"
                                                        placeholder="Enter Gender" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Email <span class="color:red;">*</span></label>
                                                    <input type="text" class="form-control" name="email" id="email"
                                                        placeholder="Enter Email Address" required>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Address <span class="color:red;">*</span></label>
                                                    <input type="text" class="form-control" name="address" id="address"
                                                        placeholder="Enter Address" required>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">City <span class="color:red;">*</span></label>
                                                    <input type="text" class="form-control" name="city" id="city"
                                                        placeholder="Enter City" required>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Zip <span class="color:red;">*</span></label>
                                                    <input type="text" class="form-control" name="zip" id="zip"
                                                        placeholder="Enter Zip" required>

                                                </div>
                                            </div>`
                                        </div>
                                        <div class="d-flex justify-content-end" style="padding-top:10px;">
                                            <button type="submit" name="submit" class="btn btn-success"
                                                style="margin-right:10px;color:white;"><i class="fa fa-edit"></i>
                                                Add Student</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- End Single Tab -->
                        </div>
                        <!-- End Tab Content -->
                    </div>
                    <!-- End Tab Info -->
                </div>
            </div>
        </div>
    </div>
    <!-- End admin Profile -->


    <!-- Start Footer 
    ============================================= -->
    <footer class="bg-dark default-padding-top text-light" style="padding-bottom:90px;">
        <div class="container">
            <div class="row">
                <div class="f-items">
                    <div class="col-md-4 item">
                        <div class="f-item">
                            <img src="assets/img/logo-light.png" alt="Logo">
                            <p>
                                Sikkha is an e-learning platform based in Bangladesh that provides access to a wealth of
                                knowledge for local students and professionals. With Sikkha, you can gain the skills and
                                knowledge you need to succeed in today's world.
                            </p>
                            <div class="social">
                                <ul>
                                    <li>
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-dribbble"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 item">
                        <div class="f-item link">
                            <h4>Links</h4>
                            <ul>
                                <li>
                                    <a href="#">Courses</a>
                                </li>
                                <li>
                                    <a href="#">Event</a>
                                </li>
                                <li>
                                    <a href="#">Gallery</a>
                                </li>
                                <li>
                                    <a href="#">Faqs</a>
                                </li>
                                <li>
                                    <a href="#">admin</a>
                                </li>
                                <li>
                                    <a href="#">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 item">
                        <div class="f-item link">
                            <h4>Support</h4>
                            <ul>
                                <li>
                                    <a href="#">Documentation</a>
                                </li>
                                <li>
                                    <a href="#">Forums</a>
                                </li>
                                <li>
                                    <a href="#">Language Packs</a>
                                </li>
                                <li>
                                    <a href="#">Release Status</a>
                                </li>
                                <li>
                                    <a href="#">LearnPress</a>
                                </li>
                                <li>
                                    <a href="#">Feedback</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 item">
                        <div class="f-item recent-post">
                            <h4>Popular Courses</h4>
                            <ul>
                                <li>
                                    <div class="thumb">
                                        <a href="#">
                                            <img src="assets/img/courses/g1.jpg" alt="Thumb">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <a href="#">Subjects allied to Creative arts and design</a>
                                        <div class="meta-title">
                                            <span class="post-date">12 Feb, 2018</span> - By <a href="#">Jessica</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="thumb">
                                        <a href="#">
                                            <img src="assets/img/courses/g2.jpg" alt="Thumb">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <a href="#">Business and administrative subjects</a>
                                        <div class="meta-title">
                                            <span class="post-date">12 Feb, 2018</span> - By <a href="#">Arnold</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- jQuery Frameworks
    ============================================= -->
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/equal-height.min.js"></script>
    <script src="assets/js/jquery.appear.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/modernizr.custom.13711.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/count-to.js"></script>
    <script src="assets/js/loopcounter.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/bootsnav.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>