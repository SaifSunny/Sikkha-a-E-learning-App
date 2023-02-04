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

$student_id=$_GET['student_id'];
$exam_id=$_GET['exam_id'];
$course_id=$_GET['course_id'];


$sql5 = "SELECT * FROM course_exam_complete WHERE student_id='$student_id' and exam_id ='$exam_id'";
$result5 = mysqli_query($conn, $sql5);
$row5=mysqli_fetch_assoc($result5);
$submission=$row5['submission'];

if (isset($_POST["submit_marks"])) {
    $marks = $_POST["marks"];


    $error = "";
    $cls = "";

    // Update Record
    $query2 = "UPDATE course_exam_complete SET mark='$marks' WHERE student_id='$student_id' and exam_id ='$exam_id'";
    $query_run2 = mysqli_query($conn, $query2);

    if ($query_run2) {
        echo "<script> alert('Successfully Graded.');
                window.location.href='teacher_exam_submission.php?id=$exam_id&cid=$course_id';</script>";
    } else {
        $cls = "danger";
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
                <div class="col-md-6" style="padding-bottom:30px;">
                    <h2 style="font-weight:600">Teacher Home</h2>
                    <p><a href="teacher_home.php">Home</a>/<a href="teacher_courses.php">Teacher Courses</a> / Exam
                        Submissions</p>
                </div>
                <div class="col-md-6" style="margin-bottom: 40px;">
                    <form action="" method="post" clkass="d-flex">
                        <div class="form-group" style="">
                            <label style="padding-bottom:10px;">Marks (of 100) <span
                                    class="color:red;">*</span></label>
                            <input type="text" name="marks" id="marks" class="form-control"
                                placeholder="Enter Marks"></input>
                        </div>
                        <div class="d-flex justify-content-end" style="padding-top:10px 0;">
                            <button type="submit" name="submit_marks" class="btn btn-success"
                                style="margin-right:10px;color:white;"><i class="fa fa-edit"></i>
                                Grade</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
      
                <embed src="assets/img/pdf/<?php echo $submission?>" width="100%" height="1500px" />
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