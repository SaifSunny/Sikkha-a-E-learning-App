<?php
include_once "./database/config.php";

session_start();
$username = $_SESSION["teachername"];

if (!isset($_SESSION["teachername"])) {
    header("Location: login.php");
}

$sql = "SELECT * FROM teachers WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$image = $row["teacher_img"];
$firstname = $row["firstname"];
$lastname = $row["lastname"];
$gender = $row["gender"];
$birthday = $row["birthday"];
$contact = $row["contact"];
$email = $row["email"];
$address = $row["address"];
$city = $row["city"];
$zip = $row["zip"];
$about_me = $row["about_me"];
$pass = $row["password"];

if (isset($_POST["submit_img"])) {
    $error = "";
    $cls = "";

    $name = $_FILES["file"]["name"];
    $target_dir = "assets/img/teachers/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = ["jpg", "jpeg", "png", "gif"];

    // Check extension
    if (in_array($imageFileType, $extensions_arr)) {
        // Upload file
        if (
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $name)
        ) {
            // Convert to base64
            $image_base64 = base64_encode(
                file_get_contents("assets/img/teachers/" . $name)
            );
            $image =
                "data:image/" . $imageFileType . ";base64," . $image_base64;

            // Update Record
            $query2 = "UPDATE teachers SET `teacher_img`='$name' WHERE username='$username'";
            $query_run2 = mysqli_query($conn, $query2);

            if ($query_run2) {
                echo "<script> alert('Profile Image Successfully Updated.');
                window.location.href='teacher_home.php';</script>";
            } else {
                $cls = "danger";
                $error = mysqli_error($conn);
            }
        } else {
            $cls = "danger";
            $error = "Unknown Error Occurred.";
        }
    } else {
        $cls = "danger";
        $error = "Invalid File Type";
    }
}

if (isset($_POST["submit"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $gender = $_POST["gender"];
    $birthday = $_POST["birthday"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $zip = $_POST["zip"];
    $about_me = $_POST["about_me"];

    $error = "";
    $cls = "";

    // Update Record
    $query2 = "UPDATE teachers SET firstname='$firstname',lastname='$lastname',
        birthday='$birthday', gender='$gender', contact='$contact',email='$email',
        `address`='$address', city='$city', zip='$zip', about_me='$about_me' WHERE username='$username'";
    $query_run2 = mysqli_query($conn, $query2);

    if ($query_run2) {
        $cls = "success";
        $error = "Profile Successfully Updated.";
    } else {
        $cls = "danger";
        $error = mysqli_error($conn);
    }
}

if (isset($_POST["submit_pass"])) {
    $old_pass = md5($_POST["old_pass"]);

    $new_pass = $_POST["new_pass"];
    $con_pass = $_POST["con_pass"];

    $error = "";
    $cls = "";

    if ($pass == $old_pass) {
        if (strlen($new_pass) > 5) {
            if ($new_pass == $con_pass) {
                // Update Password
                $save_pass = md5($new_pass);
                $query2 = "UPDATE teachers SET `password`='$save_pass' WHERE username='$username'";
                $query_run2 = mysqli_query($conn, $query2);

                if ($query_run2) {
                    $cls = "success";
                    $error = "Password Successfully Updated.";
                } else {
                    $cls = "danger";
                    $error = "Cannot Update Password";
                }
            } else {
                $cls = "danger";
                $error = "Passwords does not Match";
            }
        } else {
            $cls = "danger";
            $error = "Passwords has to be minimum of 6 Charecters";
        }
    } else {
        $cls = "danger";
        $error = "Invalid! Old Password";
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
    <?php include_once("./templates/teacher_header.php");?>
    <!-- End Header Top -->


    <!-- Start teachers Profiel 
    ============================================= -->
    <div class="students-profiel adviros-details-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="padding-bottom:30px;">
                    <h2 style="font-weight:600">Teacher Profile</h2>
                    <p><a href="teacher_home.php">Home</a> / Teacher Profile</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 thumb">
                    <img src="assets/img/teachers/<?php echo $image?>" alt="Thumb" width="90%">
                    <form action="" method="POST" enctype='multipart/form-data'>
                        <input type="file" name="file" id="file" style="border:none; margin-top:40px;">
                        <button type="submit" name="submit_img" class="btn btn-warning active"
                            style="margin-top:10px;color:white;"><i class="fa fa-edit"></i> Update
                            Image</button>
                    </form>
                </div>
                <div class="col-md-7 info main-content">
                    <!-- Star Tab Info -->
                    <div class="tab-info">
                        <!-- Tab Nav -->
                        <ul class="nav nav-pills">
                            <li class="active">
                                <a data-toggle="tab" href="#tab1" aria-expanded="true">
                                    Personal Information
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab2" aria-expanded="false">
                                    Change Password
                                </a>
                            </li>
                        </ul>
                        <!-- End Tab Nav -->
                        <!-- Start Tab Content -->
                        <div class="tab-content tab-content-info">
                            <!-- Single Tab -->
                            <div id="tab1" class="tab-pane fade active in">
                                <div class="info title">
                                    <form action="" method="POST" enctype='multipart/form-data'>
                                        <div class="row">
                                            <strong class="mb-0">Personal Information</strong>
                                            <p>You can change your Personal Information here.</p>
                                            <hr>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-<?php echo $cls;?>">
                                                    <?php 
                                                    if (isset($_POST['submit']) || isset($_POST['submit_img'])){
                                                        echo $error;
                                                }?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">First Name</label>
                                                    <input type="text" class="form-control" name="firstname"
                                                        id="firstname" value="<?php echo $firstname?>"
                                                        placeholder="First Name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Last Name</label>
                                                    <input type="text" class="form-control" name="lastname"
                                                        id="lastname" value="<?php echo $lastname?>"
                                                        placeholder="Last Name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Date of Birth</label>
                                                    <input type="date" class="form-control" name="birthday"
                                                        id="birthday" value="<?php echo $birthday?>"
                                                        placeholder="Birthday" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Contact</label>
                                                    <input type="text" class="form-control" name="contact" id="contact"
                                                        value="<?php echo $contact?>" placeholder="Contact" required>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Gender</label>
                                                    <input type="text" class="form-control" name="gender" id="gender"
                                                        value="<?php echo $gender?>" placeholder="Gender" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Email</label>
                                                    <input type="text" class="form-control" name="email" id="email"
                                                        value="<?php echo $email?>" placeholder="Email Address"
                                                        required>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Address</label>
                                                    <input type="text" class="form-control" name="address" id="address"
                                                        value="<?php echo $address?>" placeholder="Address" required>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">City</label>
                                                    <input type="text" class="form-control" name="city" id="city"
                                                        value="<?php echo $city?>" placeholder="City" required>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Zip</label>
                                                    <input type="text" class="form-control" name="zip" id="zip"
                                                        value="<?php echo $zip?>" placeholder="Zip" required>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">About Me</label>
                                                    <textarea name="about_me" id="about_me" class="form-control"
                                                        placeholder="About Me"><?php echo $about_me?></textarea>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end" style="padding-top:10px;">
                                            <button type="submit" name="submit" class="btn btn-success"
                                                style="margin-right:10px;color:white;"><i class="fa fa-edit"></i>
                                                Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- End Single Tab -->

                            <!-- Single Tab -->
                            <div id="tab2" class="tab-pane">
                                <div class="info title">
                                    <form method="POST" action="">

                                        <strong class="mb-0">Passwords</strong>
                                        <p>You can change your passwords here.</p>
                                        <hr>
                                        <div class=" col-md-12">
                                            <div class="alert alert-<?php echo $cls;?>" style="padding=0; margin:0;">
                                                <?php 
                                                    if (isset($_POST['submit'])){
                                                    echo $error;
                                                }?>
                                            </div>
                                        </div>
                                        <div class="row mb-4" style="padding-top:20px;">
                                            <div class="col-md-">
                                                <div class="form-group">
                                                    <label for="old_pass">Old Password</label>
                                                    <input type="password" class="form-control" name="old_pass"
                                                        value="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="new_pass">New Password</label>
                                                    <input type="password" class="form-control" name="new_pass">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword6">Confirm Password</label>
                                                    <input type="password" class="form-control" name="con_pass">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="submit_pass" class="btn btn-primary">Save Change</button>
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
    <!-- End teachers Profile -->


    <!-- Start Footer 
    ============================================= -->
    <?php include_once("./templates/footer.php");?>

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