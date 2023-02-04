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
                <div class="col-md-10" style="padding-bottom:30px;">
                    <h2 style="font-weight:600">Teacher Courses</h2>
                    <p><a href="teacher_courses.php">Home</a> / Teacher Courses</p>
                </div>
                <div class="col-md-2" style="text-align:right; padding-right:70px; padding-top:20px;">
                    <a href="teacher_course_add.php" class="btn btn-success">Add Course</a>
                </div>
            </div>
            <div class="popular-courses bottom-less without-carousel">
                <div class="container">
                    <div class="row">
                        <div class="popular-courses-items bottom-price">
                            <?php 
                                $sql22 = "SELECT * FROM courses where teacher_id=$teacher_id";
                                $result22 = mysqli_query($conn, $sql22);
                                if($result22){
                                    while($row=mysqli_fetch_assoc($result22)){
                                

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


                                    $sql3 = "SELECT * FROM course_ratings WHERE course_id = '$id'";
                                    $result3 = mysqli_query($conn, $sql3);
                                    $count = $result3->num_rows;
                                                            
                                    $query4 = "SELECT AVG(rating) AS average FROM course_ratings WHERE course_id = '$id'";
                                    $result4 = mysqli_query($conn, $query4);
                                    $row4 = mysqli_fetch_assoc($result4);
                                    $avg = $row4['average'];

                            ?>

                            <!-- Single Item -->
                            <div class="col-md-4 col-sm-4 equal-height">
                                <div style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                                    <div class="item">
                                        <div class="thumb">
                                        <?php
                                            if($course_type=="Recorded"){
                                            ?>
                                           <a href="teacher_course_details_recorded.php?id=<?php echo $id?>">
                                                <img src="assets/img/courses/<?php echo $image?>" alt="Thumb"
                                                    style="height:270px; object-fit:cover;">
                                            </a>
                                            <?php
                                            }else{
                                            ?>
                                           <a href="teacher_course_details_online.php?id=<?php echo $id?>">
                                                <img src="assets/img/courses/<?php echo $image?>" alt="Thumb"
                                                    style="height:270px; object-fit:cover;">
                                            </a>
                                            <?php
                                            }
                                            ?>
                                            
                                            <div class="overlay">
                                                <a class="btn btn-danger effect btn-sm"
                                                    href="teacher_course_delete.php?id=<?php echo $id?>">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </div>
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
                                                <a href="#"><?php echo $firstname." ".$lastname?></a>
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

                                        <h4>
                                            <?php
                                            if($course_type=="Recorded"){
                                            ?>
                                            <a href="teacher_course_details_recorded.php?id=<?php echo $id?>"><?php echo $course_name?></a>
                                            <?php
                                            }else{
                                            ?>
                                            <a href="teacher_course_details_online.php?id=<?php echo $id?>"><?php echo $course_name?></a>
                                            <?php
                                            }
                                            ?>
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