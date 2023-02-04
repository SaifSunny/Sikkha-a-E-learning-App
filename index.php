<?php
include_once("./database/config.php");?>
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
    <div class="top-bar-area address-one-lines bg-dark text-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8 address-info">
                    <div class="info box">
                        <ul>
                            <li>
                                <i class="fas fa-phone"></i> +880-1712345678
                            </li>
                            <li>
                                <i class="fas fa-envelope-open"></i> sikkha.Info@gmail.com
                            </li>
                            <li>
                                <i class="fas fa-location"></i> <span>Dhaka, Bangladesh</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="user-login text-right col-md-4">
                    <a class="" href="signup.php">
                        <i class="fas fa-edit"></i> Register
                    </a>
                    <a class="" href="login.php">
                        <i class="fas fa-user"></i> Login
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top -->

    <!-- Header 
    ============================================= -->
    <header id="home">

        <!-- Start Navigation -->
        <nav class="navbar navbar-default navbar-fixed dark no-background bootsnav">

            <div class="container">

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="index.html">
                        <img src="assets/img/logo.png" class="logo" alt="Logo">
                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right" data-in="#" data-out="#">
                        <li>
                            <a class="smooth-menu" href="#home">Home</a>
                        </li>
                        <li>
                            <a class="smooth-menu" href="#category">Category</a>
                        </li>
                        <li>
                            <a class="smooth-menu" href="#courses">Courses</a>
                        </li>
                        <li>
                            <a class="smooth-menu" href="#testimonials">Testimonial</a>
                        </li>
                        <li>
                            <a class="smooth-menu" href="#contact">Contact</a>
                        </li>
                    </ul>

                </div>
                <!-- /.navbar-collapse -->

            </div>

        </nav>
        <!-- End Navigation -->

    </header>
    <!-- End Header -->

    <!-- Start Banner 
    ============================================= -->
    <div class="banner-area standard text-default bg-gray-hard">

        <div class="item">
            <div class="box-table">
                <div class="box-cell">
                    <div class="container">
                        <div class="row item-flex center">

                            <div class="col-md-6" style="margin-right:80px">
                                <div class="content-box">
                                    <h1>Learn Anything with Sikkha</h1>
                                    <p>
                                        Sikkha is an e-learning platform based in Bangladesh that provides access to a
                                        wealth of knowledge for local students and professionals. With Sikkha, you can
                                        gain the skills and knowledge you need to succeed in today's world.No matter
                                        what your educational needs are, Sikkha has something for
                                        everyone. Join us today and start learning how to make your dreams a reality.
                                    </p>
                                    <a href="#" class="btn btn-dark effect btn-sm" style="margin-top:15px;">
                                        <i class="fas fa-chart-bar"></i> Get Strated
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <img src="assets/img/about/3.jpg" alt="Thumb" style="border-radius:10px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Banner -->

    <!-- Start Top Categories 
    ============================================= -->
    <div id="top-categories" class="top-cat-area default-padding bottom-less">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2>Top Categories</h2>
                        <p>
                            Discourse assurance estimable applauded to so. Him everything melancholy uncommonly but
                            solicitude inhabiting projection off. Connection stimulated estimating excellence an to
                            impression.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="top-cat-items">

                <?php 
                                        $sql = "SELECT * FROM category limit 8";
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
                    <div class="col-md-3 col-sm-6 equal-height">
                        <div class="item">
                            <a href="#" style="height:18rem">
                                <div class="info">
                                    <h4><?php echo $category_name?></h4>
                                    <span>(<?php echo $row_cnt?>) Courses</span>
                                </div>
                            </a>
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
    <!-- End Top Categories -->

    <!-- Start Popular Courses 
    ============================================= -->
    <div id="courses" class="popular-courses circle carousel-shadow bg-gray default-padding">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2>Popular Courses</h2>
                        <p>
                            Discourse assurance estimable applauded to so. Him everything melancholy uncommonly but
                            solicitude inhabiting projection off. Connection stimulated estimating excellence an to
                            impression.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="popular-courses-items bottom-price popular-courses-carousel owl-carousel owl-theme">
                    <?php 
                                    $sql = "SELECT * FROM courses";
                                    $result = mysqli_query($conn, $sql);
                                    if($result){
                                        while($row=mysqli_fetch_assoc($result)){
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
                        <div class="item">
                            <div class="thumb">
                                <a href="#">
                                <img src="assets/img/courses/<?php echo $image?>" alt="Thumb" style="height:250px; object-fit:cover;">
                                </a>
                                <div class="overlay">
                                    <a class="btn btn-theme effect btn-sm" href="#">
                                        <i class="fas fa-chart-bar"></i> Enroll Now
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
                                        <a href="#"><img src="assets/img/teachers/<?php echo $teacher_img?>"
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
                                <h4><a href="#"><?php echo $course_name?></a></h4>
                            
                                <p>
                                                <?php echo substr($description, 0, 100);?>
                                                <?php
                                                if($course_type=="Online"){
                                                ?>
                                                <br><h5 style="font-weight:700;margin-top:10px;"><?php echo $schedule;?></h5>
                                                <?php
                                                }else{}
                                                ?>
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
                        <!-- End Single Item -->
                        <?php 
                                    }
                                }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Popular Courses -->

    <!-- Start Fun Factor 
    ============================================= -->
    <div class="fun-factor-area default-padding bottom-less text-center bg-fixed shadow dark-hard"
        style="background-image: url(assets/img/banner/1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 item">
                    <div class="fun-fact">
                        <div class="icon">
                            <i class="flaticon-contract"></i>
                        </div>
                        <div class="info">
                            <span class="timer" data-to="212" data-speed="5000"></span>
                            <span class="medium">National Awards</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 item">
                    <div class="fun-fact">
                        <div class="icon">
                            <i class="flaticon-professor"></i>
                        </div>
                        <div class="info">
                            <span class="timer" data-to="128" data-speed="5000"></span>
                            <span class="medium">Best Teachers</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 item">
                    <div class="fun-fact">
                        <div class="icon">
                            <i class="flaticon-online"></i>
                        </div>
                        <div class="info">
                            <span class="timer" data-to="8970" data-speed="5000"></span>
                            <span class="medium">Students Enrolled</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 item">
                    <div class="fun-fact">
                        <div class="icon">
                            <i class="flaticon-reading"></i>
                        </div>
                        <div class="info">
                            <span class="timer" data-to="640" data-speed="5000"></span>
                            <span class="medium">Cources</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Fun Factor -->




    <!-- Start Testimonials 
    ============================================= -->
    <div id="testimonials" class="testimonials-area carousel-shadow default-padding bg-dark text-light">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2>Students Review</h2>
                        <p>
                            I have been using Sikkha for a while now and I have to say that it is an amazing platform!
                            It has helped me improve my grades and I have learnt so much from it.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="clients-review-carousel owl-carousel owl-theme">
                        <!-- Single Item -->
                        <div class="item">
                            <div class="col-md-5 thumb">
                                <img src="assets/img/team/2.jpg" alt="Thumb">
                            </div>
                            <div class="col-md-7 info">
                                <p>
                                    Sikkha has been a great help to me in my studies. I have been using it for a while
                                    now and it has helped me improve my grades significantly.
                                </p>
                                <h4>Mumhamamd Siraj</h4>
                                <span>University Student</span>
                            </div>
                        </div>
                        <!-- Single Item -->
                        <!-- Single Item -->
                        <div class="item">
                            <div class="col-md-5 thumb">
                                <img src="assets/img/team/3.jpg" alt="Thumb">
                            </div>
                            <div class="col-md-7 info">
                                <p>
                                    I would recommend Sikkha to anyone who wants to improve their grades or learn more
                                    effectively. It is an amazing platform that has helped me a lot.

                                </p>
                                <h4>Sifat Ahmed</h4>
                                <span>BBA Student</span>
                            </div>
                        </div>
                        <!-- Single Item -->
                        <!-- Single Item -->
                        <div class="item">
                            <div class="col-md-5 thumb">
                                <img src="assets/img/team/4.jpg" alt="Thumb">
                            </div>
                            <div class="col-md-7 info">
                                <p>
                                    I have been using Sikkha for a while now and it is definitely one of the best
                                    e-learning platforms out there. It has helped me improve my grades and learn more
                                    effectively.

                                </p>
                                <h4>Mahfuza Ahmed</h4>
                                <span>University Student</span>
                            </div>
                        </div>
                        <!-- Single Item -->
                        <!-- Single Item -->
                        <div class="item">
                            <div class="col-md-5 thumb">
                                <img src="assets/img/team/7.jpg" alt="Thumb">
                            </div>
                            <div class="col-md-7 info">
                                <p>
                                    If you are looking for an e-learning platform that will help you improve your grades
                                    and learn more effectively, I would highly recommend Sikkha.
                                </p>
                                <h4>Sanjida Jalal</h4>
                                <span>Biology Student</span>
                            </div>
                        </div>
                        <!-- Single Item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonials -->


    <!-- Start Contact Info
    ============================================= -->
    <div id="contact" class="contact-info-area bg-gray default-padding">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2>Contact us</h2>
                        <p>
                            Able an hope of body. Any nay shyness article matters own removal nothing his forming. Gay
                            own additions education satisfied the perpetual. If he cause manor happy. Without farther
                            she exposed saw man led. Along on happy could cease green oh.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Start Contact Info -->
                <div class="contact-info">
                    <div class="col-md-4 col-sm-4">
                        <div class="item">
                            <div class="icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="info">
                                <h4>Call Us</h4>
                                <span>+880-1712345678</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="item">
                            <div class="icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info">
                                <h4>Address</h4>
                                <span>Bosila, Dhaka-1207</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="item">
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info">
                                <h4>Email Us</h4>
                                <span>info@sikkha.com</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Contact Info -->

                <div class="seperator col-md-12">
                    <span class="border"></span>
                </div>

                <!-- Start Maps & Contact Form -->
                <div class="maps-form">
                    <div class="col-md-6 maps">
                        <h3>Our Location</h3>
                        <div class="google-maps">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.7904999237835!2d90.35904210000001!3d23.754849099999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755bf5c4574b361%3A0x533620153224ff37!2sBosila%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1669576583238!5m2!1sen!2sbd"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-md-6 form">
                        <div class="heading">
                            <h3>Contact Us</h3>
                            <p>
                                Occasional terminated insensible and inhabiting gay. So know do fond to half on. Now who
                                promise was justice new winding
                            </p>
                        </div>
                        <form action="assets/mail/contact.php" method="POST" class="contact-form">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <input class="form-control" id="name" name="name" placeholder="Name"
                                            type="text">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <input class="form-control" id="email" name="email" placeholder="Email*"
                                            type="email">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <input class="form-control" id="phone" name="phone" placeholder="Phone"
                                            type="text">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group comments">
                                        <textarea class="form-control" id="comments" name="comments"
                                            placeholder="Tell Me About Courses *"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <button type="submit" name="submit" id="submit">
                                        Send Message <i class="fa fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- Alert Message -->
                            <div class="col-md-12 alert-notification">
                                <div id="message" class="alert-msg"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Maps & Contact Form -->

            </div>
        </div>
    </div>
    <!-- End Contact Info -->

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