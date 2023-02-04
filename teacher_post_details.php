<?php
include_once "./database/config.php";
date_default_timezone_set('Asia/Dhaka');
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

$post_id = $_GET['id'];


$sql2 = "SELECT * FROM posts where post_id = $post_id";
$result2 = mysqli_query($conn, $sql2);
$row2=mysqli_fetch_assoc($result2);

$topic=$row2['topic'];
$description=$row2['description'];
$post_date=$row2['post_date'];
$sender_id=$row2['sender_id'];
$role=$row2['role'];


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



if (isset($_POST['submit'])) {

    $message = $_POST['description'];
    $reply_date = date('d F Y h:i A');
    
    $error = "";
    $cls="";

    // Update Record
    $query2 = "INSERT INTO post_reply(`message`, post_id, reply_date, replyer_id,`role`) 
    VALUES ('$message', '$post_id', '$reply_date', '$teacher_id', 'Teacher')";
    $query_run2 = mysqli_query($conn, $query2);
        
    if ($query_run2) {
        $cls="success";
        $error = "Reply Successfully Posted.";
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
    <?php include_once("./templates/teacher_header.php");?>
    <!-- End Header Top -->


    <!-- Start Blog
    ============================================= -->
    <div class="blog-area full-blog right-sidebar default-padding">
        <div class="container">
            <div class="row">
                <div class="text-left col-md-8">
                    <h2 style="font-weight:600">Community Posts</h2>
                    <p><a href="teacher_home.php">Home</a> / <a href="teacher_community.php">Community Posts</a> / Post Details</p>
                </div>



                <div class="text-right col-md-4">
                    <a class="popup-with-form btn btn-success" href="#login-form" style="padding:12px 30px">
                        <i class="fas fa-plus"></i> &nbsp;&nbsp;Create a Post
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="blog-items">
                    <div class="blog-content col-md-10 col-md-offset-1">
                        <div class="item-box">
                            <div class="item">
                                <div class="info">
                                    <div >
                                        <ul style="display:flex;margin-bottom:20px">
                                            <?php
                                                       $sql6 = "SELECT * from post_reply where post_id = $post_id";
                                                       $result6 = mysqli_query($conn, $sql6);
                                                       $row_cnt = $result6->num_rows;
                                                ?>
                                            <li>
                                                <a href=""><img src="assets/img/<?php echo $dir."/".$sender_img?>"
                                                        alt="Thumb"
                                                        style="height:60px;width:60px; object-fit:cover;border-radius:50%;margin-bottom:10px"></a>
                                            </li>
                                            <li style="margin-left:30px">
                                                <a href="#" style="font-size:18px;font-weight:700">
                                                    <?php echo $sender_name?></a><br>
                                                <a href="#"><i class="fas fa-calendar"></i>
                                                    <?php echo $post_date?></a>
                                            </li>


                                        </ul>
                                    </div>
                                    <h3>
                                        <?php echo $topic?>
                                    </h3>

                                    <p>
                                        <?php echo $description?>
                                    </p>

                                </div>

                                <div class="comments-area">
                                    <div class="comments-title">
                                        <h4>
                                            <?php echo $row_cnt?> comments
                                        </h4>
                                        <div class="comments-list">
                                            <?php

                                            $sql1 = "SELECT * FROM post_reply where post_id = $post_id";
                                            $result1 = mysqli_query($conn, $sql1);
                                                if($result1){
                                                while($row1=mysqli_fetch_assoc($result1)){
                                                    $reply_message=$row1['message'];
                                                    $reply_date=$row1['reply_date'];
                                                    $replyer_id=$row1['replyer_id'];
                                                    $replyer_role=$row1['role'];

                                                    if($replyer_role=="Student"){
                                                        $sql3 = "SELECT * FROM students WHERE student_id='$replyer_id'";
                                                        $result3 = mysqli_query($conn, $sql3);
                                                        $row3=mysqli_fetch_assoc($result3);
                                                        $replyer_name=$row3['firstname']." ".$row3['lastname'];
                                                        $replyer_img=$row3['student_img'];
                                                        $dir="students";
                                                    }else{
                                                        $sql4 = "SELECT * FROM teachers WHERE teacher_id='$replyer_id'";
                                                        $result4 = mysqli_query($conn, $sql4);
                                                        $row4=mysqli_fetch_assoc($result4);
                                                        $replyer_name=$row4['firstname']." ".$row4['lastname'];
                                                        $replyer_img=$row4['teacher_img'];
                                                        $dir="teachers";
                                                    }
                                            ?>
                                            <div class="commen-item">
                                                <div class="content">
                                                    <div class="info">
                                                        <div class="" style="display:flex;">
                                                            <ul style="vertical-align:center;display:flex;">
                                                                <li>
                                                                    <a href=""><img
                                                                            src="assets/img/<?php echo $dir."/".$replyer_img?>"
                                                                            alt="Thumb"
                                                                            style="height:70px;width:70px; object-fit:cover;border-radius:50%;margin-bottom:10px"></a>
                                                                </li>
                                                                <li style="margin-left:20px">
                                                                    
                                                                    <h5 style="font-size:18px;">
                                                                            <?php echo $replyer_name?></h5>
                                                                            <a href="#" ><i class="fas fa-calendar"></i>
                                                                        <?php echo $reply_date?>
                                                                        
                                                                        <p style="margin-top:15px"><?php echo $reply_message?></p>
                                                                </li>


                                                            </ul>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="comments-form">
                                        <div class="title">
                                            <h4>Leave a comments</h4>
                                        </div>
                                        <form action="" method="POST">
                                            <div class="col-md-12">
                                                <form action="" method="POST">
                                                    <div class="row card">
                                                        <div class="col-md-12" style="padding-top:20px;">
                                                            <label for=""
                                                                style="padding-bottom:20px;color:black;font-weight:600;font-size:20px;">Post
                                                                Comment</label>
                                                            <textarea name="description" class="form-control"
                                                                placeholder="Enter Comment" style="color:black;"
                                                                rows="7"></textarea>
                                                        </div>

                                                        <div class="col-md-12 text-right" style="padding-top:20px;">
                                                            <button type="submit" name="submit" class="btn btn-success"
                                                                style="margin-right:10px;color:white;"><i
                                                                    class="fa fa-edit"></i>
                                                                Add Comment</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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