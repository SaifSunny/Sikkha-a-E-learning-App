<?php
include_once "./database/config.php";
date_default_timezone_set('Asia/Dhaka');

session_start();
$username = $_SESSION["adminname"];

if (!isset($_SESSION["adminname"])) {
    header("Location: login.php");
}

$sql = "SELECT * FROM admin WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$image = $row["admin_img"];
$admin_id = $row["admin_id"];


if(isset($_POST['submit'])){


    $category_name = $_POST['category_name'];
    $date=  date("Y-m-d l h:i:sa");

    $query = "SELECT * FROM category WHERE category_name = '$category_name'";
    $query_run = mysqli_query($conn, $query);

    if(!$query_run->num_rows > 0){

        // Insert record

        $query2 = "INSERT INTO category(category_name ,creation_date)
        VALUES ('$category_name', '$date')";
        $query_run2 = mysqli_query($conn, $query2);
            
        if ($query_run2) {
            $cls="success";
            $error = "Category Successfully Added.";
        } 
        else {
            $cls="danger";
            $error = mysqli_error($conn);
        }
    }
    else{
        $cls="danger";
        $error = "Category Already Exists";
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
    <?php include_once("./templates/admin_header.php");?>
    <!-- End Header Top -->


    <!-- Start admin Profiel 
    ============================================= -->
    <div class="students-profiel adviros-details-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="padding-bottom:30px;">
                    <h2 style="font-weight:600">Admin Home</h2>
                    <p>Admin Home</p>
                </div>
            </div>
            <div class="row " style="">
                <div class="col-md-3">
                    <div class="card mx-auto"
                        style="text-align:center;padding:30px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
                        <h5 class="card-title" style="font-family:poppins;color:black;font-size:20px">Students</h5>
                        <div class="card-body" style="text-align:center; font-size:18px;">
                            <?php
                                    $sql = "SELECT * from students";
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
                        <h5 class="card-title" style="font-family:poppins;color:black;font-size:20px">Teachers</h5>
                        <div class="card-body" style="text-align:center; font-size:18px;">
                            <?php
                                    $sql = "SELECT * from teachers";
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
                        <h5 class="card-title" style="font-family:poppins;color:black;font-size:20px">Courses</h5>
                        <div class="card-body" style="text-align:center; font-size:18px;">
                            <?php
                                    $sql = "SELECT * from courses";
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
                                    $sql = "SELECT * from Posts";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
                            <h1 style="font-family:poppins;color:black;"><?php echo $row_cnt?></h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="padding-top:60px;margin-bottom:0px;">
                <div class="col-md-8">
                <div class="card mx-auto"
                        style="text-align:center;padding:30px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                        <h3 class="title" style="font-family:poppins;color:black;font-weight:600">Latest Courses</h3>
                        <div class="card-body"
                            style="padding:20px 40px; text-align:left;font-size:18px;height: 400px;overflow-y:scroll;">

                            <div class="row">
                <table class="table" style="font-size: 14px;color:#222;">
                    <thead>
                        <th>Image</th>
                        <th>Course Name</th>
                        <th>Category</th>
                        <th>Teacher Name</th>
                        <th>Price</th>
                    </thead>

                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM courses order by course_id desc";
                            $result = mysqli_query($conn, $sql);
                            if($result){
                                while($row=mysqli_fetch_assoc($result)){
                                $id=$row['course_id'];
                                $course_name=$row['course_name'];
                                $teacher_id=$row['teacher_id'];
                                $category_id=$row['category_id'];
                                $image=$row['course_img'];
                                $publish_date=$row['publish_date'];
                                $price=$row['base_price'];

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
                            <td><?php echo $teacher_name ?></td>
                            <td><?php echo "Tk. ".$price ?></td>


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
                </div>
                <div class="col-md-4" style="">
                    <div class="card mx-auto"
                        style="text-align:center;padding:30px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                        <h3 class="title" style="font-family:poppins;color:black;font-weight:600">New Students</h3>
                        <div class="card-body"
                            style="padding:20px 40px; text-align:left;font-size:18px;height: 400px;overflow-y:scroll;">

                            <table class="table">
                                <tbody>
                                    <?php 
                                        $sql = "SELECT DISTINCT `firstname`,lastname, `student_img` FROM students  ORDER BY student_id DESC ;";
                                        $result = mysqli_query($conn, $sql);
                                        if($result){
                                            while($row=mysqli_fetch_assoc($result)){
                                                                
                                                $name=$row['firstname']." ".$row['lastname'];
                                                $image=$row['student_img'];
                                                $role="Student";

                                                echo '<tr>
                                                <td style="font-size:14px; font-weight:600; "> <img src="./assets/img/students/'.$image.'" style="width:40px;border-radius: 20%;" alt="profile"> <span style="padding-left:20px;">'.$name.'</span></td>
                                                <td style="font-size:14px; font-weight:600; color:#bbb; padding-top:15px;">'.$role.'</td>
                                                </tr>';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End admin Profile -->


    <!-- Start Footer 
    ============================================= -->
    <footer class="bg-dark default-padding-top text-light" style="padding-bottom:90px;">
        <div class="container">
            <div class="row">
                <div class="f-items">
                    <div class="col-md-4 item">
                        <div class="f-item">
                            <img src="assets/img/logo-light.png" alt="Logo">
                            <p>
                                Sikkha is an e-learning platform based in Bangladesh that provides access to a
                                wealth of
                                knowledge for local students and professionals. With Sikkha, you can gain the skills
                                and
                                knowledge you need to succeed in today's world.
                            </p>
                            <div class="social">
                                <ul>
                                    <li>
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-dribbble"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 item">
                        <div class="f-item link">
                            <h4>Links</h4>
                            <ul>
                                <li>
                                    <a href="#">Courses</a>
                                </li>
                                <li>
                                    <a href="#">Event</a>
                                </li>
                                <li>
                                    <a href="#">Gallery</a>
                                </li>
                                <li>
                                    <a href="#">Faqs</a>
                                </li>
                                <li>
                                    <a href="#">admin</a>
                                </li>
                                <li>
                                    <a href="#">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 item">
                        <div class="f-item link">
                            <h4>Support</h4>
                            <ul>
                                <li>
                                    <a href="#">Documentation</a>
                                </li>
                                <li>
                                    <a href="#">Forums</a>
                                </li>
                                <li>
                                    <a href="#">Language Packs</a>
                                </li>
                                <li>
                                    <a href="#">Release Status</a>
                                </li>
                                <li>
                                    <a href="#">LearnPress</a>
                                </li>
                                <li>
                                    <a href="#">Feedback</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 item">
                        <div class="f-item recent-post">
                            <h4>Popular Courses</h4>
                            <ul>
                                <li>
                                    <div class="thumb">
                                        <a href="#">
                                            <img src="assets/img/courses/g1.jpg" alt="Thumb">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <a href="#">Subjects allied to Creative arts and design</a>
                                        <div class="meta-title">
                                            <span class="post-date">12 Feb, 2018</span> - By <a href="#">Jessica</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="thumb">
                                        <a href="#">
                                            <img src="assets/img/courses/g2.jpg" alt="Thumb">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <a href="#">Business and administrative subjects</a>
                                        <div class="meta-title">
                                            <span class="post-date">12 Feb, 2018</span> - By <a href="#">Arnold</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
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