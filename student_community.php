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

if (isset($_POST['submit'])) {

    $topic = $_POST['topic'];
    $description = $_POST['description'];
    $post_date = date('d F Y h:i A');
    $sender_name = $firstname." ".$lastname;

    $error = "";
    $cls="";

        // Update Record
        $query2 = "INSERT INTO posts (topic, `description`, post_date, sender_id, `role`) 
        VALUES ('$topic', '$description', '$post_date', '$student_id', 'Student')";
        $query_run2 = mysqli_query($conn, $query2);
        
        if ($query_run2) {
            $cls="success";
            $error = "Post Successfully Added.";
        } 
        else {
            $cls="danger";
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
    <?php include_once("./templates/student_header.php");?>
    <!-- End Header Top -->


    <!-- Start Blog
    ============================================= -->
    <div class="blog-area full-blog right-sidebar default-padding">
        <div class="container">
            <div class="row">
                <div class="text-left col-md-8">
                    <h2 style="font-weight:600">Community Posts</h2>
                    <p><a href="student_home.php">Home</a> / Community Posts</p>
                </div>



                <div class="text-right col-md-4">
                    <a class="popup-with-form btn btn-success" href="#login-form" style="padding:12px 30px">
                        <i class="fas fa-plus"></i> &nbsp;&nbsp;Create a Post
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="blog-items">
                    <div class="blog-content col-md-12">
                        <!-- Single Item -->
                        <div class="single-item">
                            <div class="item" style="">
                                <div class="alert alert-<?php echo $cls;?>" style="margin:10px 0">
                                    <?php 
                                        if (isset($_POST['submit'])){
                                            echo $error;
                                        }
                                    ?>
                                </div>

                                <div class="info"
                                    style="padding:25px 30px;overflow-y:scroll; overflow-x:hidden; height:120vh;">
                                    <?php 
                                        $sql = "SELECT * FROM posts ORDER BY post_id DESC";
                                        $result = mysqli_query($conn, $sql);
                                        if($result){
                                            while($row=mysqli_fetch_assoc($result)){
                                                $id=$row['post_id'];

                                                $topic=$row['topic'];
                                                $description=$row['description'];
                                                $post_date=$row['post_date'];
                                                $sender_id=$row['sender_id'];
                                                $role=$row['role'];
 
                                                if($role=="Student"){
                                                    $sql3 = "SELECT * FROM students WHERE student_id='$sender_id'";
                                                    $result3 = mysqli_query($conn, $sql3);
                                                    $row3=mysqli_fetch_assoc($result3);
                                                    $sender_name=$row3['firstname']." ".$row3['lastname'];
                                                    $sender_img=$row3['student_img'];
                                                    $dir="students";
                                                }else{
                                                    $sql4 = "SELECT * FROM teachers WHERE teacher_id='$sender_id'";
                                                    $result4 = mysqli_query($conn, $sql4);
                                                    $row4=mysqli_fetch_assoc($result4);
                                                    $sender_name=$row4['firstname']." ".$row4['lastname'];
                                                    $sender_img=$row4['teacher_img'];
                                                    $dir="teachers";
                                                }
                                               

                                    ?>
                                    <div>
                                       
                                       
                                        <div class="row" style="padding-bottom:20px;">
                                            <div class="col-md-11">
                                                <h3>
                                                    <a
                                                        href="student_post_details.php?id=<?php echo $id?>"><?php echo $topic?></a>
                                                </h3>
                                            </div>
                                            <?php

                                                   if($sender_id==$student_id && $role=="Student"){
                                                ?>
                                            <div class="col-md-1">
                                                <a href="student_post_delete.php?id=<?php echo $id?>"
                                                    class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                            </div>
                                            <?php
                                                   }else{}
                                            ?>

                                        </div>

                                        <p>
                                            <?php echo $description?>
                                        </p>

                                        <div class="meta" style="padding-bottom:50px">
                                            <ul>

                                                <?php
                                                       $sql6 = "SELECT * from post_reply where post_id = $id";
                                                       $result6 = mysqli_query($conn, $sql6);
                                                       $row_cnt = $result6->num_rows;
                                                ?>
                                                <li>
                                                    <a href=""><img src="assets/img/<?php echo $dir."/".$sender_img?>"
                                                            alt="Thumb"
                                                            style="height:40px;width:40px; object-fit:cover;border-radius:50%"></a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <?php echo $sender_name?></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="fas fa-comments"></i><?php echo $row_cnt?>
                                                        Comments</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="fas fa-calendar"></i>
                                                        <?php echo $post_date?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php 
                                        }
                                    }
                                    ?>
                                </div>

                                <!-- Start Login Form ============================================= -->

                                <form action="" method="POST" id="login-form" class="mfp-hide white-popup-block">
                                    <div class="col-md-12">
                                        <h4>Craete a Post</h4>

                                        <div class="col-md-12">
                                            <form action="" method="POST">
                                                <div class="row card">

                                                    <div class="col-md-12">
                                                        <label for=""
                                                            style="padding-bottom:10px;color:black;font-weight:600;">Post
                                                            Title</label>
                                                        <input type="text" class="form-control" name="topic"
                                                            placeholder="Enter Post Name" style="color:black;">
                                                    </div>

                                                    <div class="col-md-12" style="padding-top:20px;">
                                                        <label for=""
                                                            style="padding-bottom:10px;color:black;font-weight:600;">Post
                                                            Description</label>
                                                        <textarea name="description" class="form-control"
                                                            placeholder="Enter Post Description" style="color:black;"
                                                            rows="12"></textarea>
                                                    </div>

                                                    <div class="col-md-12 text-right" style="padding-top:20px;">
                                                        <button type="submit" name="submit" class="btn btn-success"
                                                            style="margin-right:10px;color:white;"><i
                                                                class="fa fa-edit"></i>
                                                            Add Post</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </form>
                                <!-- End Login Form -->


                            </div>
                        </div>
                        <!-- Single Item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog -->

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