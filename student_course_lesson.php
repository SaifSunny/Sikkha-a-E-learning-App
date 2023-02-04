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

$lesson_id = $_GET['lid'];
$course_id = $_GET['cid'];

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


$sql1 = "SELECT * FROM course_lessons WHERE lesson_id='$lesson_id'";
$result1 = mysqli_query($conn, $sql1);
$row1=mysqli_fetch_assoc($result1);

$lesson_id=$row1['lesson_id'];
$lesson_title=$row1['lesson_title'];
$lesson_no=$row1['lesson_no'];
$lesson_description=$row1['lesson_description'];
$lesson_video=$row1['lesson_video'];

$sql2 = "SELECT * FROM teachers where teacher_id= $teacher_id";
$result2 = mysqli_query($conn, $sql2);
$row2=mysqli_fetch_assoc($result2);

$teacher_name=$row2['firstname']. " ". $row2['lastname'];
$teacher_img=$row2['teacher_img'];
$about_me=$row2['about_me'];


$sql3 = "SELECT * FROM category where category_id= $category_id";
$result3 = mysqli_query($conn, $sql3);
$row3=mysqli_fetch_assoc($result3);

$category_name=$row3['category_name'];
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
                <div class="col-md-12">
                    <div class="course-details-info">
                        <!-- Star Top Info -->
                        <div class="top-info">
                            <!-- Thumbnail -->
                            <div class="thumb">
                                <?php 
                            echo str_replace("315","630",str_replace("560","100%",$lesson_video));
                            ?>
                            </div>
                            <!-- End Thumbnail -->
                        </div>
                        <!-- End Top Info -->
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Title-->
                                <div class="title" style="padding-top:40px;">
                                    <h3 style="font-weight:600"><?php echo $lesson_title?></h3>
                                </div>
                                <!-- End Title-->
                                <p style="margin-bottom:30px">
                                    <?php echo $lesson_description?>
                                </p>
                                <!-- Start Course List -->
                                <div class="course-list-items acd-items acd-arrow">
                                    <div class="panel-group symb" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#ac1">
                                                        Lesson Exam
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="act1" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <ul>
                                                        <?php 
                                                            $sql = "SELECT * FROM course_exams where course_id = $course_id";
                                                            $result = mysqli_query($conn, $sql);
                                                            if($result){
                                                                while($row=mysqli_fetch_assoc($result)){
                                                                $exam_id=$row['exam_id'];
                                                                $exam_title=$row['exam_title'];
                                                                $exam_no=$row['exam_no'];

                                                                $sql222 = "SELECT * FROM course_exam_complete where student_id = $student_id and exam_id=$exam_id";
                                                                $result222 = mysqli_query($conn, $sql222);   
                                                                if ($result222->num_rows > 0) {
                                                        ?>
                                                        <li
                                                            style="background-color:rgba(152, 251, 152, 0.8);">
                                                            <div class="d-flex justify-content-between" style="display:flex;justify-content:space-between">
                                                            <div class="item name d-flex" style="padding-top:5px;display:flex;justify-content:space-between">
                                                                    <i class="fas fa-play"  style="margin-top:5px; margin-right:10px"></i>
                                                                    <span>Exam : <?php echo $exam_no?></span>
                                                                    <h5 style="margin-top:5px; margin-left:30px"><?php echo $exam_title?></h5>

                                                                </div>
                                                                <br>
                                                                <div class="item title" style="padding:15px;">
                                                                </div>

                                                                <div class="item info">
                                                                    <a
                                                                        href="student_course_exam_start.php?cid=<?php echo $course_id?>&lid=<?php echo $exam_id?>&sid=<?php echo $student_id?>" style="margin-top:10px">View
                                                                        Exam</a>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        <?php
                                                                                                                        }else{
                                                        ?>
                                                        <li
                                                            style="">
                                                            <div class="d-flex justify-content-between" style="display:flex;justify-content:space-between">
                                                                <div class="item name d-flex" style="padding-top:5px;display:flex;justify-content:space-between">
                                                                    <i class="fas fa-play"  style="margin-top:5px; margin-right:10px"></i>
                                                                    <span>Exam : <?php echo $exam_no?></span>
                                                                    <h5 style="margin-top:5px; margin-left:30px"><?php echo $exam_title?></h5>

                                                                </div>
                                                                <br>
                                                                <div class="item title" style="padding:15px;">
                                                                </div>

                                                                <div class="item info">
                                                                    <a
                                                                        href="student_course_exam_start.php?cid=<?php echo $course_id?>&lid=<?php echo $exam_id?>&sid=<?php echo $student_id?>" style="margin-top:10px">View
                                                                        Exam</a>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        <?php
                                                                                                                        }
                                                        ?>
                                                        <?php 
                                                        }
                                                    }
                                                ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Course List -->
                            </div>
                            <div class="col-md-4">
                                <div class="course-list-items acd-items acd-arrow">
                                    <div class="panel-group symb" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#ac2">
                                                        Course Lessons
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="act2" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <ul>
                                                        <?php 
                                                            $sql = "SELECT * FROM course_lessons where course_id = $course_id";
                                                            $result = mysqli_query($conn, $sql);
                                                            if($result){
                                                                while($row=mysqli_fetch_assoc($result)){
                                                                $lesson_id=$row['lesson_id'];
                                                                $lesson_title=$row['lesson_title'];
                                                                $lesson_no=$row['lesson_no'];

                                                                $sql222 = "SELECT * FROM course_lesson_complete where student_id = $student_id and lesson_id=$lesson_id";
                                                                $result222 = mysqli_query($conn, $sql222);   
                                                                if ($result222->num_rows > 0) {
                                                        ?>
                                                        <li
                                                            style="height:11rem;background-color:rgba(152, 251, 152, 0.8);">
                                                            <div class="d-flex justify-content-between">
                                                                <div style="display:flex;justify-content:space-between">
                                                                    <div class="item name d-flex"
                                                                        style="padding-top:5px;">
                                                                        <i class="fas fa-play"></i>
                                                                        <span>Lesson : <?php echo $lesson_no?></span>
                                                                    </div>
                                                                    
                                                                    <div class="item title" style="padding-top:11px;">
                                                                        <h5><?php echo $lesson_title?></h5>
                                                                    </div>
                                                                </div>


                                                                <div class="item info">
                                                                    <a
                                                                        href="student_course_lesson_viewed.php?cid=<?php echo $course_id?>&lid=<?php echo $lesson_id?>&sid=<?php echo $student_id?>">View
                                                                        Lesson</a>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        <?php
                                                                                                                        }else{
                                                        ?>
                                                        <li
                                                            style="height:13rem;">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="item name d-flex" style="padding-top:5px;">
                                                                    <i class="fas fa-play"></i>
                                                                    <span>Lesson : <?php echo $lesson_no?></span>
                                                                </div>
                                                                <br>
                                                                <div class="item title" style="padding:15px;">
                                                                    <h5><?php echo $lesson_title?></h5>
                                                                </div>

                                                                <div class="item info">
                                                                    <a
                                                                        href="student_course_lesson_viewed.php?cid=<?php echo $course_id?>&lid=<?php echo $lesson_id?>&sid=<?php echo $student_id?>">View
                                                                        Lesson</a>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        <?php
                                                                                                                        }
                                                        ?>
                                                        <?php 
                                                        }
                                                    }
                                                ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

</body>

</html>