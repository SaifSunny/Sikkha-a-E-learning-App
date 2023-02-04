<?php
include_once("./database/config.php");
date_default_timezone_set('Asia/Dhaka');

session_start();
$username = $_SESSION['teachername'];

if (!isset($_SESSION['teachername'])) {
    header("Location: login.php");
}

$sql = "SELECT * FROM teachers WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$image = $row['teacher_img'];
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

    $course_name = $_POST['course_name'];
    $category_id = $_POST['category'];
    $base_price=$_POST['base_price'];
    $description=$_POST['description'];

    $error = "";
    $cls="";

        // Update Record
        $query2 = "UPDATE courses SET course_name='$course_name',category_id='$category_id',
        `description`='$description', base_price='$base_price' WHERE course_id='$course_id'";
        $query_run2 = mysqli_query($conn, $query2);
        
        if ($query_run2) {
            $cls="success";
            $error = "Course Information Successfully Updated.";
        } 
        else {
            $cls="danger";
            $error = mysqli_error($conn);
        }

}

if (isset($_POST['submit_objective'])) {

    $objective = $_POST['objective'];

    $error = "";
    $cls="";

    $query = "SELECT * FROM course_obj WHERE course_id = '$course_id' AND objective = '$objective'";
    $query_run = mysqli_query($conn, $query);
    if (!$query_run->num_rows > 0) {

        // Update Record
        $query2 = "INSERT INTO course_obj (course_id, objective) VALUES ('$course_id', '$objective')";
        $query_run2 = mysqli_query($conn, $query2);
        
        if ($query_run2) {
            $cls="success";
            $error = "Course Objective Successfully Added.";
        } 
        else {
            $cls="danger";
            $error = mysqli_error($conn);
        }
    }else{
        $cls="danger";
        $error = "Objective Already Exists";
    }

}

if (isset($_POST['submit_lesson'])) {

    $lesson_no = $_POST['lesson_no'];
    $lesson_title = $_POST['lesson_title'];
    $lesson_description = $_POST['lesson_description'];
    $lesson_link = $_POST['lesson_link'];
    $Lesson_date = $_POST['lesson_date'];

    $newDate = date("d F Y h:i A", strtotime($Lesson_date)); 

    $error = "";
    $cls="";

    $query = "SELECT * FROM course_lessons WHERE lesson_title = '$lesson_title' AND lesson_no = '$lesson_no'";
    $query_run = mysqli_query($conn, $query);
    if (!$query_run->num_rows > 0) {

        // Update Record
        $query2 = "INSERT INTO course_lessons (course_id, lesson_no, lesson_title, lesson_description, lesson_link,lesson_date) 
        VALUES ('$course_id', '$lesson_no', '$lesson_title', '$lesson_description', '$lesson_link', '$newDate')";
        $query_run2 = mysqli_query($conn, $query2);
        
        if ($query_run2) {
            $cls="success";
            $error = "Lesson Successfully Scheduled.";
        } 
        else {
            $cls="danger";
            $error = mysqli_error($conn);
        }
    }else{
        $cls="danger";
        $error = "Lesson Already Exists";
    }

}

if (isset($_POST['submit_exam'])) {

    $lesson_id = $_POST['lesson_id'];
    $exam_no = $_POST['exam_no'];
    $exam_title = $_POST['exam_title'];
    $exam_Instructions = $_POST['exam_Instructions'];
    $exam_duration = $_POST['exam_duration'];
    $exam_question = $_POST['exam_question'];

    $error = "";
    $cls="";

    $query = "SELECT * FROM course_exams WHERE lesson_id = '$lesson_id' AND exam_title = '$exam_title'";
    $query_run = mysqli_query($conn, $query);
    if (!$query_run->num_rows > 0) {

        // Update Record
        $query2 = "INSERT INTO course_exams (lesson_id,exam_no,exam_title,exam_Instructions, exam_question, exam_duration,course_id) 
        VALUES ('$lesson_id', '$exam_no', '$exam_title', '$exam_Instructions', '$exam_question', '$exam_duration', '$course_id')";
        $query_run2 = mysqli_query($conn, $query2);
        
        if ($query_run2) {
            $cls="success";
            $error = "Exam Successfully Added.";
        } 
        else {
            $cls="danger";
            $error = mysqli_error($conn);
        }
    }else{
        $cls="danger";
        $error = "Exam Already Exists";
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


    <!-- Start Course Details 
    ============================================= -->
    <div class="course-details-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="course-details-info">
                        <!-- Star Top Info -->
                        <div class="top-info d-flex">
                            <!-- Thumbnail -->
                            <div class="thumb">
                                <img src="assets/img/courses/<?php echo $image?>" alt="Thumb" width="100%">
                            </div>
                            <!-- End Thumbnail -->
                            <!-- Title-->
                            <div class="title" style="margin-top:40px;">
                                <h2><?php echo $course_name?></h2>
                            </div>
                            <!-- End Title-->
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
                                <div class="item price">
                                    <h4>Price</h4>
                                    <span>Tk. <?php echo $base_price?></span>
                                </div>

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
                                        Course Information
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab2" aria-expanded="false">
                                        Live Classes
                                    </a>
                                </li>

                                <li>
                                    <a data-toggle="tab" href="#tab3" aria-expanded="false">
                                        Course Exams
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
                                        <div class="alert alert-<?php echo $cls;?>" style="margin:10px 0">
                                            <?php 
                                                if (isset($_POST['submit'])||isset($_POST['submit_objective'])||isset($_POST['submit_lesson'])||isset($_POST['submit_exam'])){
                                                    echo $error;
                                                }
                                            ?>
                                        </div>
                                        <div class="advisor-list-items">
                                            <!-- Advisor Item -->
                                            <div class="item">
                                                <h4>Update Course Information</h4>
                                                <hr><br>
                                                <form action="" method="POST">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for=""
                                                                style="padding-bottom:10px;color:black;font-weight:600;">Course
                                                                Name</label>
                                                            <input type="text" class="form-control" name="course_name"
                                                                placeholder="Enter Course Name"
                                                                value="<?php echo $course_name?>" style="color:black;">
                                                        </div>
                                                        <div class="col-md-6" style="padding-top:30px;">
                                                            <label for=""
                                                                style="padding-bottom:10px;color:black;font-weight:600;">Course
                                                                Category</label>
                                                            <select class="form-control" name="category" id="category"
                                                                required>
                                                                <option value="<?php echo $category_id ?>">
                                                                    <?php echo $category_name;?></option>
                                                                <?php
                                                                    $option = "SELECT * FROM category";
                                                                    $option_run = mysqli_query($conn, $option);

                                                                    if (mysqli_num_rows($option_run) > 0) {
                                                                        foreach ($option_run as $row2) {
                                                                ?>
                                                                <option value="<?php echo $row2['category_id']; ?>">
                                                                    <?php echo $row2['category_name'];?> </option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                                <option></option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6" style="padding-top:30px;">
                                                            <label for=""
                                                                style="padding-bottom:10px;color:black;font-weight:600;">Course
                                                                Price</label>
                                                            <input type="text" class="form-control" name="base_price"
                                                                placeholder="Enter Course Price"
                                                                value="<?php echo $base_price?>" style="color:black;">
                                                        </div>
                                                        <div class="col-md-12" style="padding-top:30px;">
                                                            <label for=""
                                                                style="padding-bottom:10px;color:black;font-weight:600;">Course
                                                                Description</label>
                                                            <textarea name="description" class="form-control"
                                                                placeholder="Enter Course Description"
                                                                style="color:black;"
                                                                rows="8"><?php echo $description?></textarea>
                                                        </div>
                                                        <div class="col-md-12 text-right" style="padding-top:30px;">
                                                            <button type="submit" name="submit" class="btn btn-success"
                                                                style="margin-right:10px;color:white;"><i
                                                                    class="fa fa-edit"></i>
                                                                Update</button>
                                                        </div>
                                                    </div>

                                                </form>

                                            </div>
                                            <!-- End Advisor Item -->
                                        </div>
                                    </div>
                                    <div class="info title" style="margin-top:20px;">

                                        <div class="advisor-list-items">
                                            <!-- Advisor Item -->
                                            <div class="item">
                                                <h4>Course Objective</h4>

                                                <hr><br>
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
                                                <div style="padding-top:40px;">
                                                    <hr>

                                                    <form action="" method="POST">
                                                        <label for=""
                                                            style="padding:15px 0;color:black;font-weight:600;">
                                                            <h4>Add Course Objective</h4>
                                                        </label>
                                                        <input type="text" class="form-control" name="objective"
                                                            placeholder="Course Objective" style="color:black;">
                                                        <button type="submit" name="submit_objective"
                                                            class="btn btn-success"
                                                            style="margin-right:10px;margin-top:20px;color:white;"><i
                                                                class="fa fa-edit"></i>
                                                            Add Obective</button>
                                                    </form>
                                                </div>

                                            </div>
                                            <!-- End Advisor Item -->
                                        </div>
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
                                                                Live Classes
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
                                                                        $lesson_date=$row['lesson_date'];
                                                                        $lesson_video=$row['lesson_video'];
                                                                ?>
                                                                <li>
                                                                    <div class="item name" style="padding-top:5px;">
                                                                        <i class="fas fa-play"></i>
                                                                        <span>Lesson : <?php echo $lesson_no?></span>
                                                                    </div>
                                                                    <div class="item title" style="padding-top:5px;">
                                                                        <h5><?php echo $lesson_title?></h5>
                                                                    </div>
                                                                    <div class="item title" style="padding-top:5px;">
                                                                        <h5><?php echo $lesson_date?></h5>
                                                                    </div>

                                                                    <div class="item ">
                                                                        <?php
                                                                        if(empty($lesson_video)){
                                                                        ?>
                                                                        <a href="teacher_recording_upload.php?lid=<?php echo $lesson_id?>&cid=<?php echo $course_id?>"
                                                                            class="btn btn-success"
                                                                            style="padding:5px 2px 2px 8px;">Upload
                                                                            Recording</a>
                                                                        <?php
                                                                        }else{
                                                                        ?>
                                                                        <a href="<?php echo $lesson_video?>"
                                                                            class="btn btn-success"
                                                                            style="padding:5px 2px 2px 8px;">view
                                                                            Recording</a>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        <a href="teacher_lesson_delete.php?id=<?php echo $lesson_id?>&cid=<?php echo $course_id?>"
                                                                            class="btn btn-danger"
                                                                            style="padding:5px 2px 2px 8px;"><i
                                                                                class="fa fa-trash"
                                                                                style="color:white;"></i></a>
                                                                    </div>
                                                                </li>
                                                                <?php 
                                                                    }
                                                                }
                                                                ?>

                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="info title">
                                                        <div class="advisor-list-items">
                                                            <!-- Advisor Item -->
                                                            <div class="item" style="margin-top:20px">
                                                                <h4>Schedule Lesson</h4>
                                                                <hr><br>
                                                                <form action="" method="post">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for=""
                                                                                style="padding-bottom:10px;color:black;font-weight:600;">Lesson
                                                                                No.</label>
                                                                            <input type="text" class="form-control"
                                                                                name="lesson_no"
                                                                                placeholder="Enter Lesson No."
                                                                                style="color:black;">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for=""
                                                                                style="padding-bottom:10px;color:black;font-weight:600;">Lesson
                                                                                Title</label>
                                                                            <input type="text" class="form-control"
                                                                                name="lesson_title"
                                                                                placeholder="Enter Lesson Title"
                                                                                style="color:black;">
                                                                        </div>
                                                                        <div class="col-md-6"
                                                                            style="padding-top:30px;">
                                                                            <label for=""
                                                                                style="padding-bottom:10px;color:black;font-weight:600;">Meet Link</label>
                                                                            <input type="text" class="form-control"
                                                                                name="lesson_link" placeholder="Enter Meet Link" style="color:black;">
                                                                        </div>
                                                                        <div class="col-md-6"
                                                                            style="padding-top:30px;">
                                                                            <label for=""
                                                                                style="padding-bottom:10px;color:black;font-weight:600;">Lesson Date</label>
                                                                            <input type="datetime-local" class="form-control"
                                                                                name="lesson_date" style="color:black;">
                                                                        </div>
                                                                        <div class="col-md-12"
                                                                            style="padding-top:30px;">
                                                                            <label for=""
                                                                                style="padding-bottom:10px;color:black;font-weight:600;">Lesson
                                                                                Description</label>
                                                                            <textarea name="lesson_description"
                                                                                class="form-control"
                                                                                placeholder="Enter Lesson Description"
                                                                                style="color:black;"
                                                                                rows="8"></textarea>
                                                                        </div>
                                                                        <div class="col-md-12 text-right"
                                                                            style="padding-top:30px;">
                                                                            <button type="submit" name="submit_lesson"
                                                                                class="btn btn-success"
                                                                                style="margin-right:10px;color:white;"><i
                                                                                    class="fa fa-edit"></i>
                                                                                Add Lesson</button>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                            <!-- End Advisor Item -->
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Course List -->
                                    </div>
                                </div>
                                <!-- Single Tab -->
                                <div id="tab3" class="tab-pane fade">
                                    <div class="info title">
                                        <h4>List Of Exams</h4>
                                        <!-- Start Course List -->
                                        <div class="course-list-items acd-items acd-arrow">
                                            <div class="panel-group symb" id="accordion">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion"
                                                                href="#ac1">
                                                                Course Exams
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="ac1" class="panel-collapse collapse in">
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
                                                                        $lesson_id=$row['lesson_id'];
                                                                        $exam_duration=$row['exam_duration'];
                                                                ?>
                                                                <li>
                                                                    <div class="item name" style="padding-top:5px;">
                                                                        <i class="fas fa-play"></i>
                                                                        <span>Exam : <?php echo $exam_no?></span>
                                                                    </div>
                                                                    <div class="item title" style="padding-top:5px;">
                                                                        <h5><?php echo $exam_title?></h5>
                                                                    </div>
                                                                    <div class="item title" style="padding-top:5px;">
                                                                        <h5>Duration: <?php echo $exam_duration?>
                                                                            Minutes</h5>
                                                                    </div>
                                                                    <div class="item ">
                                                                        <a href="teacher_exam_submission.php?id=<?php echo $exam_id?>&cid=<?php echo $course_id?>"
                                                                            class="btn btn-success"
                                                                            style="padding:5px 2px 2px 8px;">View
                                                                            Submissions</a>
                                                                        <a href="teacher_exam_delete.php?exam_id=<?php echo $exam_id?>&course_id=<?php echo $course_id?>"
                                                                            class="btn btn-danger"
                                                                            style="padding:5px 2px 2px 8px;"><i
                                                                                class="fa fa-trash"
                                                                                style="color:white;"></i></a>
                                                                    </div>
                                                                </li>
                                                                <?php 
                                                                    }
                                                                }
                                                                ?>

                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="info title">
                                                        <div class="advisor-list-items">
                                                            <!-- Advisor Item -->
                                                            <div class="item" style="margin-top:20px">
                                                                <h4>Add Course Exam</h4>
                                                                <hr><br>
                                                                <form action="" method="post">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for=""
                                                                                style="padding-bottom:10px;color:black;font-weight:600;">Lesson
                                                                                No.</label>
                                                                            <select class="form-control"
                                                                                name="lesson_id" id="lesson_id"
                                                                                required>
                                                                                <option value="">
                                                                                    --Select Lesson--
                                                                                </option>
                                                                                <?php
                                                                                    $option = "SELECT * FROM course_lessons where course_id=$course_id";
                                                                                    $option_run = mysqli_query($conn, $option);

                                                                                    if (mysqli_num_rows($option_run) > 0) {
                                                                                        foreach ($option_run as $row2) {
                                                                                ?>
                                                                                <option
                                                                                    value="<?php echo $row2['lesson_id']; ?>">
                                                                                    Lesson:
                                                                                    <?php echo $row2['lesson_no']." (".$row2['lesson_title'].")"?>
                                                                                </option>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <option></option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for=""
                                                                                style="padding-bottom:10px;color:black;font-weight:600;">Exam
                                                                                No.</label>
                                                                            <input type="text" class="form-control"
                                                                                name="exam_no"
                                                                                placeholder="Enter Exam No."
                                                                                style="color:black;">
                                                                        </div>

                                                                        <div class="col-md-12"
                                                                            style="padding-top:30px;">
                                                                            <label for=""
                                                                                style="padding-bottom:10px;color:black;font-weight:600;">Exam
                                                                                Title</label>
                                                                            <input type="text" class="form-control"
                                                                                name="exam_title"
                                                                                placeholder="Enter Exam Title"
                                                                                style="color:black;">
                                                                        </div>
                                                                        <div class="col-md-12"
                                                                            style="padding-top:30px;">
                                                                            <label for=""
                                                                                style="padding-bottom:10px;color:black;font-weight:600;">Exam
                                                                                Duration (in Minutes)</label>
                                                                            <input type="text" class="form-control"
                                                                                name="exam_duration"
                                                                                placeholder="Enter Exam Duration"
                                                                                style="color:black;">
                                                                        </div>


                                                                        <div class="col-md-12"
                                                                            style="padding-top:30px;">
                                                                            <label for=""
                                                                                style="padding-bottom:10px;color:black;font-weight:600;">Exam
                                                                                Instruction</label>
                                                                            <textarea name="exam_Instructions"
                                                                                class="form-control"
                                                                                placeholder="Enter Exam Instruction"
                                                                                style="color:black;"
                                                                                rows="8"></textarea>
                                                                        </div>
                                                                        <div class="col-md-12"
                                                                            style="padding-top:30px;">
                                                                            <label for=""
                                                                                style="padding-bottom:10px;color:black;font-weight:600;">Exam
                                                                                Question</label>
                                                                            <textarea name="exam_question"
                                                                                class="form-control"
                                                                                placeholder="Enter Exam Question"
                                                                                style="color:black;"
                                                                                rows="8"></textarea>
                                                                        </div>
                                                                        <div class="col-md-12 text-right"
                                                                            style="padding-top:30px;">
                                                                            <button type="submit" name="submit_exam"
                                                                                class="btn btn-success"
                                                                                style="margin-right:10px;color:white;"><i
                                                                                    class="fa fa-edit"></i>
                                                                                Add Exam</button>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                            <!-- End Advisor Item -->
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

                                        <div class="course-rating-list" style="margin-top:50px">
                                            <h4>Reviews </h4>

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