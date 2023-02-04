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


$course_id=$_GET['cid'];
$exam_id=$_GET['id'];


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
                    <h2 style="font-weight:600">Teacher Home</h2>
                    <p><a href="teacher_home.php">Home</a>/<a href="teacher_courses.php">Teacher Courses</a> / Exam Submissions</p>
                </div>
            </div>
            <div class="row">
                <table class="table" style="font-size: 14px;color:#222;">
                    <thead>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Submit Deadline</th>
                        <th>Submit Date</th>
                        <th>Submission</th>
                                
                    </thead>

                    <tbody>
                        <?php 
                      $sql2 = "SELECT * FROM course_student where course_id=$course_id";
                      $result2 = mysqli_query($conn, $sql2);
                      if($result2){
                          while($row2=mysqli_fetch_assoc($result2)){

                          $student_id=$row2['student_id'];

                          $sql3 = "SELECT * FROM students WHERE student_id='$student_id'";
                          $result3 = mysqli_query($conn, $sql3);
                          $row3=mysqli_fetch_assoc($result3);

                          $firstname=$row3['firstname'];
                          $lastname=$row3['lastname'];
                          $student_img=$row3['student_img'];


                          $sql5 = "SELECT * FROM course_exam_complete WHERE student_id='$student_id' and exam_id ='$exam_id'";
                          $result5 = mysqli_query($conn, $sql5);
                          $row5=mysqli_fetch_assoc($result5);
                          $submission=$row5['submission'];
                          $submit_date=$row5['submit_date'];
                          $deadline=$row5['deadline'];
                          $mark=$row5['mark'];


                          
                    ?>
                        <tr>
                            <td><img src="./assets/img/students/<?php echo $student_img?>"
                                    style="width:60px;border-radius: 20%;" alt="profile">
                                <span style="padding-left:20px;"></span></td>
                            <td><?php echo $firstname." ".$lastname ?></td>
                            <td><?php echo $email ?></td>
                            <td><?php echo $deadline ?></td>
                            <td><?php echo $submit_date ?></td>
                            <td>
                                <?php
                                    if(empty($submission)){
                                ?>
                                Not Submitted
                                <?php
                                    }else{
                                        if(empty($mark)){
                                ?>
                                <a class="btn btn-success" href="teacher_view_pdf.php?exam_id=<?php echo $exam_id?>&student_id=<?php echo $student_id?>&course_id=<?php echo $course_id?>">View Submission</a>
                                        <?php
                                        }else{
                                        ?>
                                        <?php echo $mark?>
                                        <?php
                                        }
                                        ?>
                                <?php
                                    }
                                ?>
                            </td>


                        </tr>
                        <?php 
                        }
                      }
                    ?>
                    </tbody>
                </table>
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