<?php
include_once("./database/config.php");

session_start();
$username = $_SESSION['studentname'];

if (!isset($_SESSION['studentname'])) {
    header("Location: login.php");
}

$sql = "SELECT * FROM students WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$student_id = $row['student_id'];
$image = $row['student_img'];
$firstname=$row['firstname'];
$lastname=$row['lastname'];
$contact=$row['contact'];
$email=$row['email'];

$exam_id = $_GET['exam_id'];
$course_id = $_GET['course_id'];


$sql1 = "SELECT * FROM course_exams WHERE exam_id='$exam_id'";
$result1 = mysqli_query($conn, $sql1);
$row1=mysqli_fetch_assoc($result1);

$exam_id=$row1['exam_id'];
$exam_title=$row1['exam_title'];
$exam_no=$row1['exam_no'];
$exam_instructions=$row1['exam_Instructions'];
$exam_question=$row1['exam_question'];
$exam_duration=$row1['exam_duration'];

$sql3 = "SELECT * FROM course_exam_complete WHERE exam_id='$exam_id' and student_id =$student_id";
$result3 = mysqli_query($conn, $sql3);
$row3=mysqli_fetch_assoc($result3);
$deadline=$row3['deadline'];


$sql = "SELECT * FROM courses WHERE course_id='$course_id'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$category_id =$row['category_id'];
$course_name=$row['course_name'];
$description= substr($row['description'], 0, 100);
$publish_date=$row['publish_date'];
$base_price=$row['base_price'];
$image=$row['course_img'];
$teacher_id=$row['teacher_id'];


if (isset($_POST["submit_pdf"])) {
    $error = "";
    $cls = "";
    $now = date("d F Y h:i A");

    $name = $_FILES["file"]["name"];
    $target_dir = "assets/img/pdf/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = ["pdf"];

    // Check extension
    if (in_array($imageFileType, $extensions_arr)) {
        // Upload file
        if (
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $name)
        ) {
            // Convert to base64
            $image_base64 = base64_encode(
                file_get_contents("assets/img/pdf/" . $name)
            );
            $image =
                "data:image/" . $imageFileType . ";base64," . $image_base64;

            // Update Record
            $query2 = "UPDATE course_exam_complete SET submit_date ='$now' , submission='$name' WHERE exam_id='$exam_id' and student_id ='$student_id'";
            $query_run2 = mysqli_query($conn, $query2);

            if ($query_run2) {
                echo "<script> 
                alert('File Submitted.');
                window.location.href='student_course_details.php?id=$course_id';
                </script>";
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
    <?php include_once("./templates/student_header.php");?>
    <!-- End Header Top -->


    <!-- Start Course Details 
    ============================================= -->
    <div class="course-details-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="margin: 50px 20px;font-weight:700">
                    <div style="text-align:center">
                        <h4 style="font-family:Arial;font-weight:700">Course Name: <?php echo $course_name?></h4>
                        <h4 style="font-family:Arial;font-weight:700">Exam Title: <?php echo $exam_title?></h4>
                        <h4 style="font-family:Arial;font-weight:700; text-align:center">Duration:
                            <?php echo $exam_duration?> Minutes</h4>
                        <h4 style="font-family:Arial;font-weight:700; text-align:center">Time Remaining:&nbsp;<p
                                id="demo" style="color:black; margin-top:20px"></p>
                        </h4>
                    </div>
                    <div class="col-md-12" style="margin:20px 0;text-align:center">
                        <h5 style="font-family:Arial;font-weight:700">Instructions: <?php echo $exam_instructions?></h5>

                    </div>
                    <div class="col-md-12" style="margin:20px 0">
                        <h5 style="font-family:Arial;font-weight:700"><?php echo $exam_question?></h5>

                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-<?php echo $cls;?>">
                            <?php 
                                                    if (isset($_POST['submit_pdf'])){
                                                        echo $error;
                                                }?>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin:20px 0; ">
                        <form action="" method="Post" enctype='multipart/form-data'>
                            <label for="exam_file" style="font-family:Arial;font-weight:700">Submit File (PDF)</label>
                            <input type="file" name="file" id="file" class="form-control">
                            <button type="submit" name="submit_pdf" class="btn btn-success"
                                style="margin-top:20px">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Course Details -->


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

        <script>
            // Set the date we're counting down to
            var countDownDate = new Date("<?php echo $deadline ?>").getTime();

            // Update the count down every 1 second
            var x = setInterval(function () {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
                    minutes + "m " + seconds + "s ";

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                }
            }, 1000);
        </script>

</body>

</html>