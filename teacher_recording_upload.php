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

$teacher_img = $row["teacher_img"];
$teacher_id = $row["teacher_id"];
$firstname=$row['firstname'];
$lastname=$row['lastname'];
$gender=$row['gender'];
$birthday=$row['birthday'];
$contact=$row['contact'];
$email=$row['email'];
$address=$row['address'];
$city=$row['city'];
$zip=$row['zip'];

$lesson_id =$_GET['lid'];
$course_id =$_GET['cid'];

if (isset($_POST['submit_link'])) {

    $lesson_link = $_POST['lesson_recording'];

    $error = "";
    $cls="";

        // Update Record
        $query2 = "UPDATE course_lessons set lesson_video = '$lesson_link' where lesson_id = '$lesson_id' AND course_id = '$course_id'";
        $query_run2 = mysqli_query($conn, $query2);
        
        if ($query_run2) {
            echo "<script> alert('Recording Successfully Added.');
            window.location.href='teacher_course_details_online.php?id=$course_id';</script>";
        } 
        else {
            $cls="danger";
            $error = mysqli_error($conn);
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
                    <h2 style="font-weight:600">Add Recording</h2>
                    <p><a href="teacher_home.php">Home</a> / <a href="teacher_courses.php">Courses</a> / Add Recording</p>
                </div>
            </div>


            <div class="popular-courses without-carousel" style="margin-top:40px">
                <div class="container">
                    <form action="" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" style="padding:10px">
                                <label style="padding-bottom:10px;">Lesson Recording<span
                                        class="color:red;">*</span></label>
                                <input type="text" class="form-control" name="lesson_recording" id="lesson_recording"
                                    placeholder="Enter Lesson Recording" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end" style="padding-top:10px;margin-left:30px">
                            <button type="submit" name="submit_link" class="btn btn-success"
                                style="margin-right:10px;color:white;"><i class="fa fa-edit"></i>
                                Add Recording</button>
                        </div>
                    </div>
                    </form>

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