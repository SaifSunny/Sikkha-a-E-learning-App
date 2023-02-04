<?php
include_once("./database/config.php");
date_default_timezone_set('Asia/Dhaka');

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

$course_id = $_GET['id'];

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
$course_type=$row['course_type'];


$sql1 = "SELECT * FROM category where category_id= $category_id";
$result1 = mysqli_query($conn, $sql1);
$row1=mysqli_fetch_assoc($result1);

$category_name=$row1['category_name'];

$sql2 = "SELECT * FROM teachers where teacher_id= $teacher_id";
$result2 = mysqli_query($conn, $sql2);
$row2=mysqli_fetch_assoc($result2);

$teacher_name=$row2['firstname']. " ". $row2['lastname'];
$teacher_img=$row2['teacher_img'];
$about_me=$row2['about_me'];

$sql3 = "SELECT * FROM course_ratings WHERE course_id = '$course_id'";
$result3 = mysqli_query($conn, $sql3);
$count = $result3->num_rows;
                        
$query2 = "SELECT AVG(rating) AS average FROM course_ratings WHERE course_id = '$course_id'";
$result2 = mysqli_query($conn, $query2);
$row2 = mysqli_fetch_assoc($result2);
$avg = $row2['average'];

if (isset($_POST['submit'])) {

    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $error = "";
    $cls="";

    $sql = "SELECT * FROM course_ratings WHERE student_id='$student_id' and course_id='$course_id' and teacher_id='$teacher_id'";
	$result = mysqli_query($conn, $sql);

	if (!$result->num_rows > 0) {

        // INSERT Record
        $query2 = "INSERT INTO course_ratings(student_id, course_id,teacher_id, comment, `rating`) 
        VALUES('$student_id','$course_id','$teacher_id','$comment','$rating')";
	    $query_run2 = mysqli_query($conn, $query2);

        
        if ($query_run2) {
            $cls="success";
            $error = "Review Successfully Placed.";
        } 
        else {
            $cls="danger";
            $error = mysqli_error($conn);
        }
    }else{
        $error = "Review Already Exists";
        $cls="danger";
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
                <div class="col-md-12" style="padding-bottom:30px;">
                    <h2 style="font-weight:600">Course Details</h2>
                    <p><a href="student_home.php">Home</a> / <a href="student_all_courses.php">All Courses</a> / Course
                        Details</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="course-details-info">
                        <!-- Star Top Info -->
                        <div class="top-info">
                            <!-- Title-->
                            <div class="title">
                                <h2><?php echo $course_name?></h2>
                            </div>
                            <!-- End Title-->

                            <!-- Thumbnail -->
                            <div class="thumb">
                                <img src="assets/img/courses/<?php echo $image?>" alt="Thumb" width="100%">
                            </div>
                            <!-- End Thumbnail -->

                            <!-- Course Meta -->
                            <div class="course-meta">
                                <div class="item author">
                                    <div class="thumb">
                                        <a href="#"><img alt="Thumb"
                                                src="assets/img/teachers/<?php echo $teacher_img?>"></a>
                                    </div>
                                    <div class="desc">
                                        <h4>Teacher</h4>
                                        <a href="#"><?php echo $teacher_name?></a>
                                    </div>
                                </div>
                                <div class="item category">
                                    <h4>Category</h4>
                                    <a href="#"><?php echo $category_name?></a>
                                </div>
                                <div class="item rating">
                                    <h4>Rating</h4>
                                    <?php
                                                            for($i=0; $i<5; $i++){
                                                                if($i<$avg){
                                                                ?>
                                    <i class="fas fa-star" style="color:orange"></i>
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
                                <?php
                                    $sql1 = "SELECT * FROM course_student where course_id= $course_id AND student_id= $student_id";
                                    $result1 = mysqli_query($conn, $sql1);
                                    if($result1->num_rows > 0){
                                ?>
                                <div class="align-right">
                                    <a class="btn btn-warning  btn-sm active" href="">
                                        <i class="fas fa-chart-bar"></i> Enrolled
                                    </a>
                                </div>
                                <?php
                                    }else{
                                    ?>


                                <div class="item price">
                                    <h4>Price</h4>
                                    <span>Tk. <?php echo $base_price?></span>
                                </div>
                                <div class="align-right">
                                    <a class="btn btn-dark effect btn-sm"
                                        href="student_course_enroll.php?course_id=<?php echo $course_id?>&student_id=<?php echo $student_id?>">
                                        <i class="fas fa-chart-bar"></i> Enroll
                                    </a>
                                </div>
                                <?php
                                    }
                                    ?>
                            </div>
                            <!-- End Course Meta -->
                        </div>
                        <!-- End Top Info -->

                        <!-- Star Tab Info -->
                        <div class="tab-info">
                            <!-- Tab Nav -->
                            <ul class="nav nav-pills">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab1" aria-expanded="true">
                                        Overview
                                    </a>
                                </li>
                                <?php
                                    $sql1 = "SELECT * FROM course_student where course_id= $course_id AND student_id= $student_id";
                                    $result1 = mysqli_query($conn, $sql1);
                                    if($result1->num_rows > 0){
                                ?>
                                <li>
                                    <a data-toggle="tab" href="#tab2" aria-expanded="false">
                                        Curriculum
                                    </a>
                                </li>
                                <?php
                                    }else{}
                                    ?>
                                <li>
                                    <a data-toggle="tab" href="#tab3" aria-expanded="false">
                                        Teacher Info
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab4" aria-expanded="false">
                                        Reviews
                                    </a>
                                </li>
                            </ul>
                            <!-- End Tab Nav -->
                            <!-- Start Tab Content -->
                            <div class="tab-content tab-content-info">
                                <!-- Single Tab -->
                                <div id="tab1" class="tab-pane fade active in">
                                    <div class="info title">
                                        <h4 style="padding-top:20px;">Course Description</h4>
                                        <p>
                                            <?php echo $description?>
                                        </p>

                                        <h4 style="padding-top:40px;">Learning Outcomes</h4>
                                        <ul>
                                            <?php 
                                                        $sql = "SELECT * FROM course_obj where course_id = $course_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        if($result){
                                                            while($row=mysqli_fetch_assoc($result)){
                                                            $id=$row['obj_id'];
                                                            $objective=$row['objective'];
                                                    ?>
                                            <li><i class="fas fa-check-double"></i> <?php echo $objective?></li>

                                            <?php 
                                                        }
                                                    }
                                                    ?>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Single Tab -->

                                <!-- Single Tab -->
                                <div id="tab2" class="tab-pane fade">
                                    <div class="info title">
                                        <h4>List Of Curriculum</h4>
                                        <!-- Start Course List -->
                                        <div class="course-list-items acd-items acd-arrow">
                                            <div class="panel-group symb" id="accordion">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion"
                                                                href="#ac1">
                                                                <?php
                                                                    if($course_type=="Recorded"){
                                                                ?>
                                                                Course Lessons
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                Online Lessons
                                                                <?php
                                                                    }
                                                                ?>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="ac1" class="panel-collapse collapse in">
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
                                                                        $lesson_link=$row['lesson_link'];
                                                                        $lesson_video=$row['lesson_video'];
                                                                        $lesson_date=$row['lesson_date'];
                                                                     
                                                                        $sql222 = "SELECT * FROM course_lesson_complete where student_id = $student_id and lesson_id=$lesson_id";
                                                                        $result222 = mysqli_query($conn, $sql222);   
                                                                        if ($result222->num_rows > 0) {
                                                                ?>
                                                                <li style="background-color:rgba(152, 251, 152, 0.8);">
                                                                    <div class="d-flex justify-content-between"
                                                                        style="display:flex;justify-content:space-between">
                                                                        <div class="item name d-flex"
                                                                            style="padding-top:5px; display:flex;">

                                                                            <span> <i class="fas fa-play"></i> Lesson :
                                                                                <?php echo $lesson_no?></span>
                                                                            <h5
                                                                                style="margin-left:50px; margin-top:4px">
                                                                                <?php echo $lesson_title?></h5>
                                                                        </div>
                                                                        <?php
                                                                                if($course_type=="Online"){
                                                                        ?>
                                                                        <div class="item " style="margin-top:10px">
                                                                            <h5 style="font-weight:500">
                                                                                <?php echo date("d F Y h:i A", strtotime($lesson_date))?>
                                                                            </h5>
                                                                        </div>
                                                                        <?php
                                                                                }else{}
                                                                        ?>
                                                                        <div class="item info"
                                                                            style="justify-content:end;">
                                                                            <?php
                                                                                if($course_type=="Online"){
                                                                                    $startDate = strtotime(date('Y-m-d', strtotime($lesson_date) ) );
                                                                                    $currentDate = strtotime(date('Y-m-d'));
                                                                                
                                                                                    if($startDate < $currentDate) {
                                                                                    ?>
                                                                            <a href="<?php echo $lesson_link?>">Join
                                                                                Lesson</a>
                                                                            <?php
                                                                                    }else{
                                                                                ?>
                                                                            <a href="<?php echo $lesson_video?>">View
                                                                                Recording</a>
                                                                            <?php
                                                                                    }
                                                                                ?>

                                                                            <?php
                                                                                }else{
                                                                                ?>
                                                                            <a
                                                                                href="student_course_lesson_viewed.php?cid=<?php echo $course_id?>&lid=<?php echo $lesson_id?>&sid=<?php echo $student_id?>">View
                                                                                Lesson</a>
                                                                            <?php
                                                                                }
                                                                            ?>

                                                                        </div>
                                                                    </div>

                                                                </li>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                <li style="">
                                                                    <div class="d-flex justify-content-between"
                                                                        style="display:flex;justify-content:space-between">
                                                                        <div class="item name d-flex"
                                                                            style="padding-top:5px; display:flex;">

                                                                            <span> <i class="fas fa-play"></i> Lesson :
                                                                                <?php echo $lesson_no?></span>
                                                                            <h5
                                                                                style="margin-left:50px; margin-top:4px">
                                                                                <?php echo $lesson_title?></h5>
                                                                        </div>

                                                                        <div class="item " style="margin-top:10px">
                                                                            <h5 style="font-weight:500">
                                                                                <?php echo date("d F Y h:i A", strtotime($lesson_date))?>
                                                                            </h5>
                                                                        </div>

                                                                        <div class="item info"
                                                                            style="justify-content:end;">
                                                                            <?php
                                                                                     $startDate = strtotime(date('Y-m-d', strtotime($lesson_date) ) );
                                                                                     $currentDate = strtotime(date('Y-m-d'));
                                                                                if($course_type=="Online"){
                                                                                    if($startDate < $currentDate){
                                                                                    ?>
                                                                            <a href="<?php echo $lesson_link?>">Join
                                                                                Lesson</a>
                                                                            <?php
                                                                                    }else{
                                                                                        if(empty($lesson_video)){
                                                                                            ?>
                                                                                            <a href="<?php echo $lesson_video?>">Not Uploaded</a>
                                                                                            <?php
                                                                                        }else{
                                                                                            ?>
                                                                                            
                                                                            <a href="<?php echo $lesson_video?>">View
                                                                                Recording</a>
                                                                                            <?php
                                                                                        }
                                                                                ?>

                                                                            <?php
                                                                                    }
                                                                                ?>

                                                                            <?php
                                                                                }else{
                                                                                ?>
                                                                            <a
                                                                                href="student_course_lesson_viewed.php?cid=<?php echo $course_id?>&lid=<?php echo $lesson_id?>&sid=<?php echo $student_id?>">View
                                                                                Lesson</a>
                                                                            <?php
                                                                                }
                                                                            ?>

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
                                </div>
                                <!-- End Single Tab -->

                                <!-- Single Tab -->
                                <div id="tab3" class="tab-pane fade">
                                    <div class="info title">
                                        <div class="advisor-list-items">
                                            <!-- Advisor Item -->
                                            <div class="item">
                                                <div class="thumb">
                                                    <img src="assets/img/teachers/<?php echo $teacher_img?>"
                                                        alt="Thumb">
                                                </div>
                                                <div class="info">
                                                    <h4><?php echo $teacher_name?></h4>
                                                    <span>senior lecturer</span>
                                                    <p>
                                                        <?php echo $about_me?>
                                                    </p>
                                                    <ul>
                                                        <li>
                                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fab fa-dribbble"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fab fa-youtube"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- End Advisor Item -->
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Tab -->

                                <!-- Single Tab -->
                                <div id="tab4" class="tab-pane fade">
                                    <div class="info title">
                                        <div class="course-rating-list">
                                            <h4>Average Rating</h4>
                                            <?php

                                                ?>
                                            <div class="item rating">
                                                <?php
                                                            for($i=0; $i<5; $i++){
                                                                if($i<$avg){
                                                                ?>
                                                <i class="fas fa-star" style="color:orange"></i>
                                                <?php
                                                                        }else{
                                                                ?>
                                                <i class="fa fa-star" style="color:grey"></i>
                                                <?php
                                                                        }
                                                                    }
                                                                ?>
                                                <span><?php echo number_format((float)$avg, 2, '.', '')?>
                                                    (<?php echo $count?>)</p></span>
                                            </div>

                                            <ul>
                                                <li>
                                                    <?php
                                                $sql3 = "SELECT * FROM course_ratings WHERE course_id = '$course_id' and rating =5";
                                                $result3 = mysqli_query($conn, $sql3);
                                                $count10 = $result3->num_rows;
                                            ?>
                                                    <span>5 Star</span>
                                                    <div class="rating-bar"></div>
                                                    <span><?php echo $count10?></span>
                                                </li>
                                                <li>
                                                    <?php
                                                $sql3 = "SELECT * FROM course_ratings WHERE course_id = '$course_id' and rating =4";
                                                $result3 = mysqli_query($conn, $sql3);
                                                $count10 = $result3->num_rows;
                                            ?>
                                                    <span>4 Star</span>
                                                    <div class="rating-bar"></div>
                                                    <span><?php echo $count10?></span>
                                                </li>
                                                <li>
                                                    <?php
                                                $sql3 = "SELECT * FROM course_ratings WHERE course_id = '$course_id' and rating =3";
                                                $result3 = mysqli_query($conn, $sql3);
                                                $count10 = $result3->num_rows;
                                            ?>
                                                    <span>3 Star</span>
                                                    <div class="rating-bar"></div>
                                                    <span><?php echo $count10?></span>
                                                </li>
                                                <li>
                                                    <?php
                                                $sql3 = "SELECT * FROM course_ratings WHERE course_id = '$course_id' and rating =2";
                                                $result3 = mysqli_query($conn, $sql3);
                                                $count10 = $result3->num_rows;
                                            ?>
                                                    <span>2 Star</span>
                                                    <div class="rating-bar"></div>
                                                    <span><?php echo $count10?></span>
                                                </li>
                                                <li>
                                                    <?php
                                                $sql3 = "SELECT * FROM course_ratings WHERE course_id = '$course_id' and rating =1";
                                                $result3 = mysqli_query($conn, $sql3);
                                                $count10 = $result3->num_rows;
                                            ?>
                                                    <span>1 Star</span>
                                                    <div class="rating-bar"></div>
                                                    <span><?php echo $count10?></span>
                                                </li>
                                            </ul>

                                        </div>
                                        <div>
                                            <h4 style="margin-top:50px">Rate the Course</h4>

                                            <?php
                                            $sql1 = "SELECT * FROM course_student where course_id= $course_id AND student_id= $student_id";
                                            $result1 = mysqli_query($conn, $sql1);
                                            if($result1->num_rows > 0){
                                            ?>
                                            <form action="" method="post">
                                                <div class="col-md-12">
                                                    <div class="form-group d-flex" style="padding:10px">
                                                        <input type="radio" id="1" name="rating" value="1">
                                                        <label for="1" style="margin-bottom:10px"><i class="fas fa-star"
                                                                style="color:orange"></i></label><br>
                                                        <input type="radio" id="2" name="rating" value="2">
                                                        <label for="2"><i class="fas fa-star"
                                                                style="color:orange"></i><i class="fas fa-star"
                                                                style="color:orange"></i></label><br>
                                                        <input type="radio" id="3" name="rating" value="3">
                                                        <label for="3"><i class="fas fa-star"
                                                                style="color:orange"></i><i class="fas fa-star"
                                                                style="color:orange"></i><i class="fas fa-star"
                                                                style="color:orange"></i></label><br>
                                                        <input type="radio" id="4" name="rating" value="4">
                                                        <label for="4"><i class="fas fa-star"
                                                                style="color:orange"></i><i class="fas fa-star"
                                                                style="color:orange"></i><i class="fas fa-star"
                                                                style="color:orange"></i><i class="fas fa-star"
                                                                style="color:orange"></i></label><br>
                                                        <input type="radio" id="5" name="rating" value="5">
                                                        <label for="5"><i class="fas fa-star"
                                                                style="color:orange"></i><i class="fas fa-star"
                                                                style="color:orange"></i><i class="fas fa-star"
                                                                style="color:orange"></i><i class="fas fa-star"
                                                                style="color:orange"></i><i class="fas fa-star"
                                                                style="color:orange"></i></label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group" style="padding:10px">
                                                        <label>Comment</label>
                                                        <textarea class="form-control" name="comment" id="comment"
                                                            rows="6" placeholder="Write about service"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 d-flex justify-content-between">
                                                    <div>

                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="submit"
                                                            class="btn btn-dark effect btn-sm">Review</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <?php
                                            }else{

                                            }
                                        ?>
                                        </div>
                                        <div class="course-rating-list" style="margin-top:50px">
                                            <h4>Ratings </h4>

                                            <div class="abt-cdt d-block full-width mb-4">
                                                <?php 
												$sql = "SELECT * FROM course_ratings where course_id=$course_id";
												$result = mysqli_query($conn, $sql);
												if($result){
													while($row=mysqli_fetch_assoc($result)){
													$id=$row['feedback_id'];
													$student_id=$row['student_id'];
													$rating=$row['rating'];
													$comment=$row['comment'];

                                                    $sql1 = "SELECT * FROM students where student_id=$student_id";
                                                    $result1 = mysqli_query($conn, $sql1);
                                                    $row1=mysqli_fetch_assoc($result1);
													$user_name=$row1['firstname']." ".$row1['lastname'];
													$user_img=$row1['student_img'];

                                    ?>
                                                <div class=" ">
                                                    <div class="advisor-list-items" style="padding-bottom:20px">
                                                        <!-- Advisor Item -->
                                                        <div class="item" style="margin-right:30px;">
                                                            <div class="thumb">
                                                                <img src="assets/img/students/<?php echo $user_img?>"
                                                                    style="height:84px;width:84px" alt="Thumb">
                                                            </div>
                                                            <div class="info" style="margin-left:30px">
                                                                <h4><?php echo $user_name?></h4>
                                                                <div class="star-rating align-items-center d-flex">
                                                                    <?php
                                                            for($i=0; $i<5; $i++){
                                                                if($i<$rating){
                                                                ?>
                                                                    <i class="fas fa-star"></i>
                                                                    <?php
                                                                        }else{
                                                                ?>
                                                                    <i class="fa fa-star"></i> <br>
                                                                    <?php
                                                                        }
                                                                    }
                                                                ?>
                                                                </div>
                                                                <p>
                                                                    <?php echo $comment?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <!-- End Advisor Item -->
                                                    </div>
                                                </div>

                                                <?php
                                                    }
                                                }
                                            ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- End Single Tab -->
                            </div>
                            <!-- End Tab Content -->
                        </div>
                        <!-- End Tab Info -->
                    </div>
                </div>
                <!-- Start Sidebar -->
                <div class="col-md-3">
                    <div class="sidebar">
                        <aside>

                            <!-- Sidebar Item -->
                            <div class="sidebar-item category">
                                <div class="title">
                                    <h4>Courses Category</h4>
                                </div>
                                <div class="sidebar-info">
                                    <ul>
                                        <?php 
                                        $sql = "SELECT * FROM category";
                                        $result = mysqli_query($conn, $sql);
                                        if($result){
                                            while($row=mysqli_fetch_assoc($result)){
                                                                
                                                $id=$row['category_id'];
                                                $category_name=$row['category_name'];
                                                $creation_date=$row['creation_date'];

                                                $sql1 = "SELECT * from courses where category_id=$id";
                                                $result1 = mysqli_query($conn, $sql1);
                                                $row_cnt = $result1->num_rows;

                                    ?>
                                        <li>
                                            <a href="student_search_course.php?category_id=<?php echo $id?>"><?php echo $category_name?><span><?php echo $row_cnt?>
                                                </span></a>
                                        </li>
                                        <?php 
                                            }
                                        }
                                    ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Sidebar Item -->

                        </aside>
                    </div>
                </div>
                <!-- End Sidebar -->
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