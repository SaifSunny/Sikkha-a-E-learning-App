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
                <div class="col-md-12" style="padding-bottom:30px;">
                    <h2 style="font-weight:600">Teacher Online Classes</h2>
                    <p><a href="teacher_home.php">Home</a> / Teacher Online Classes</p>
                </div>
            </div>
            <div class="row">
                <table class="table" style="font-size: 14px;color:#222;">
                    <thead>
                        <th>Image</th>
                        <th>Course Name</th>
                        <th>Category</th>
                        <th>Lesson No.</th>
                        <th>Lesson Title</th>
                        <th>Schedule Date</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM courses where teacher_id = $teacher_id";
                            $result = mysqli_query($conn, $sql);
                            if($result){
                                while($row=mysqli_fetch_assoc($result)){
                                $id=$row['course_id'];
                                $course_name=$row['course_name'];
                                $category_id=$row['category_id'];
                                $image=$row['course_img'];
                                $publish_date=$row['publish_date'];
                                $price=$row['base_price'];
                                $course_type=$row['course_type'];

                                $sql4 = "SELECT * FROM course_lessons where course_id = $id and lesson_link <> ''";
                                $result4 = mysqli_query($conn, $sql4);
                                if($result4){
                                    while($row4=mysqli_fetch_assoc($result4)){
                                    $lesson_no=$row4['lesson_no'];
                                    $lesson_title=$row4['lesson_title'];
                                    $lesson_link=$row4['lesson_link'];
                                    $lesson_date=$row4['lesson_date'];

                                    $sql1 = "SELECT * FROM category where category_id = $category_id";
                                    $result1 = mysqli_query($conn, $sql1);
                                    $row1=mysqli_fetch_assoc($result1);
                                    $category_name=$row1['category_name'];

                                    $sql2 = "SELECT * FROM teachers where teacher_id = $teacher_id";
                                    $result2 = mysqli_query($conn, $sql2);
                                    $row2=mysqli_fetch_assoc($result2);
                                    $teacher_name=$row2['firstname']." ".$row2['lastname'];
                                    $email=$row2['email'];



                        ?>
                        <tr>
                            <td><img src="./assets/img/courses/<?php echo $image?>" style="width:90px;"
                                    alt="profile">
                                <span style="padding-left:20px;"></span></td>
                            <td><?php echo $course_name ?></td>
                            <td><?php echo $category_name ?></td>
                            <td><?php echo $lesson_no ?></td>
                            <td><?php echo $lesson_title ?></td>
                            <td><?php echo $lesson_date?></td>
                            <td><a href="<?php echo $lesson_link ?>" class="btn btn-success">Join Meeting</a>
                            </td>

                        </tr>
                        <?php 
                                    }
                                }
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