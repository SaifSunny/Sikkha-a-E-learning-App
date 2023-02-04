<?php
include_once("./database/config.php");
error_reporting(0);
session_start();
$username = $_SESSION['studentname'];

if (!isset($_SESSION['studentname'])) {
    header("Location: login.php");
}

$sql = "SELECT * FROM students WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$image = $row['student_img'];
$student_id = $row['student_id'];
$firstname=$row['firstname'];
$lastname=$row['lastname'];
$gender=$row['gender'];
$birthday=$row['birthday'];
$contact=$row['contact'];
$email=$row['email'];
$address=$row['address'];
$city=$row['city'];
$zip=$row['zip'];
$about_me=$row['about_me'];
$pass=$row['password'];



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


    <!-- Start Students Profiel 
    ============================================= -->
    <div class="students-profiel adviros-details-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="padding-bottom:30px;">
                    <h2 style="font-weight:600">Student Home</h2>
                    <p><a href="student_home.php">Home</a> / Student Home</p>
                </div>
            </div>
            <div class="row " style="">
                <div class="col-md-3">
                    <div class="card mx-auto"
                        style="text-align:center;padding:30px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
                        <h5 class="card-title" style="font-family:poppins;color:black;font-size:20px">Course Enrolled
                        </h5>
                        <div class="card-body" style="text-align:center; font-size:18px;">
                            <?php
                                    $sql = "SELECT * from course_student  where student_id=$student_id";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
                            <h1 style="font-family:poppins;color:black;"><?php echo $row_cnt?></h1>

                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card mx-auto"
                        style="text-align:center;padding:30px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
                        <h5 class="card-title" style="font-family:poppins;color:black;font-size:20px">Lessons Completed
                        </h5>
                        <div class="card-body" style="text-align:center; font-size:18px;">
                            <?php

                                    $sql = "SELECT * from course_lesson_complete where student_id=$student_id";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;

                                ?>
                            <h1 style="font-family:poppins;color:black;"><?php echo $row_cnt?></h1>

                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card mx-auto"
                        style="text-align:center;padding:30px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
                        <h5 class="card-title" style="font-family:poppins;color:black;font-size:20px">Exams Completed
                        </h5>
                        <div class="card-body" style="text-align:center; font-size:18px;">
                            <?php
                                    $sql = "SELECT * from course_exam_complete where student_id=$student_id";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
                            <h1 style="font-family:poppins;color:black;"><?php echo $row_cnt?></h1>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mx-auto"
                        style="text-align:center;padding:30px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
                        <h5 class="card-title" style="font-family:poppins;color:black;font-size:20px">Community Posts
                        </h5>
                        <div class="card-body" style="text-align:center; font-size:18px;">
                            <?php
                                    $sql = "SELECT * from posts where sender_id ='$student_id' AND role = 'Student'";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
                            <h1 style="font-family:poppins;color:black;"><?php echo $row_cnt?></h1>
                        </div>
                    </div>
                </div>
            </div>


            <div class="popular-courses without-carousel" style="margin-top:40px">
                <h2 style="font-weight:600;margin: 50px 0;">Recently Enrolled</h2>

                <div class="container">
                    <div class="row">
                        <div class="popular-courses-items bottom-price">
                            <?php 
                                $sql22 = "SELECT * FROM course_student where student_id =$student_id order by sl desc limit 3";
                                $result22 = mysqli_query($conn, $sql22);
                                if($result22){
                                    while($row22=mysqli_fetch_assoc($result22)){
                                        $id=$row22['course_id'];

                                        $sql = "SELECT * FROM courses where course_id=$id";
                                        $result = mysqli_query($conn, $sql);
                                        $row=mysqli_fetch_assoc($result);

                                    $id=$row['course_id'];
                                    $category_id =$row['category_id'];
                                    $course_name=$row['course_name'];
                                    $description= substr($row['description'], 0, 100);
                                    $publish_date=$row['publish_date'];
                                    $base_price=$row['base_price'];
                                    $image=$row['course_img'];
                                    $teacher_id=$row['teacher_id'];
                                    $course_type=$row['course_type'];
                                    $schedule=$row['schedule'];


                                    $sql1 = "SELECT * FROM category where category_id= $category_id";
                                    $result1 = mysqli_query($conn, $sql1);
                                    $row1=mysqli_fetch_assoc($result1);

                                    $category_name=$row1['category_name'];


                                    $sql2 = "SELECT * FROM teachers where teacher_id= $teacher_id";
                                    $result2 = mysqli_query($conn, $sql2);
                                    $row2=mysqli_fetch_assoc($result2);

                                    $teacher_name=$row2['firstname']. " ". $row2['lastname'];
                                    $teacher_img=$row2['teacher_img'];

                                    $sql3 = "SELECT * FROM course_ratings WHERE course_id = '$id'";
                                    $result3 = mysqli_query($conn, $sql3);
                                    $count = $result3->num_rows;
                                                            
                                    $query4 = "SELECT AVG(rating) AS average FROM course_ratings WHERE course_id = '$id'";
                                    $result4 = mysqli_query($conn, $query4);
                                    $row4 = mysqli_fetch_assoc($result4);
                                    $avg = $row4['average'];

                            ?>
                            <!-- Single Item -->
                            <!-- Single Item -->
                            <div class="col-md-4 col-sm-4 equal-height">
                                <div style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                                    <div class="item">
                                        <div class="thumb">
                                            <a href="student_course_details.php?id=<?php echo $id ?>">
                                                <img src="assets/img/courses/<?php echo $image?>" alt="Thumb"
                                                    style="height:270px; object-fit:cover;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="info">

                                        <div class="author-info">
                                            <div style="margin-bottom:10px">
                                                <a href="#" class="badge"
                                                    style="background:rgba(240, 173, 78, 1);color:white"><?php echo $category_name?></a>
                                                <a href="#" class="badge"
                                                    style="background:rgba(217, 83, 79, 1);color:white"><?php echo $course_type?></a>
                                            </div>
                                            <div class="thumb">
                                                <a href=""><img src="assets/img/teachers/<?php echo $teacher_img?>"
                                                        alt="Thumb"></a>
                                            </div>
                                            <div class="others">
                                                <a href="#"><?php echo $teacher_name?></a>
                                                <div class="rating">
                                                    <?php
                                                            for($i=0; $i<5; $i++){
                                                                if($i<$avg){
                                                                ?>
                                                    <i class="fas fa-star"></i>
                                                    <?php
                                                                        }else{
                                                                ?>
                                                    <i class="fa fa-star" style="color:grey"></i>
                                                    <?php
                                                                        }
                                                                    }
                                                                ?>
                                                    <span><?php echo number_format((float)$avg, 2, '.', '')?>
                                                        (<?php echo $count?>)</span>
                                                </div>
                                            </div>
                                        </div>

                                        <h4><a
                                                href="student_course_details.php?id=<?php echo $id ?>"><?php echo $course_name?></a>
                                        </h4>

                                        <p>
                                            <?php echo substr($description, 0, 100);?>
                                            <?php
                                                if($course_type=="Online"){
                                                ?>
                                            <br>
                                            <h5 style="font-weight:700;margin-top:10px;"><?php echo $schedule;?></h5>
                                            <?php
                                                }else{}
                                                ?>
                                        </p>
                                        <div class="bottom-info">
                                            <ul>
                                                <?php
                                                    $sql9 = "SELECT * FROM course_student WHERE course_id = '$id'";
                                                    $result9 = mysqli_query($conn, $sql9);
                                                    $count = $result9->num_rows;
                                                    ?>
                                                <li>
                                                    <i class="fas fa-user"></i> <?php echo $count?>
                                                </li>
                                            </ul>
                                            <div class="price-btn">
                                                Tk. <?php echo $base_price?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                    }
                                }
                            ?>
                        </div>
                        <!-- End Single Item -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Students Profile -->


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