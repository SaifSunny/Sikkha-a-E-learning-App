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
    $description = $_POST['description'];
    $date = date("l Y-m-d h:i");

    $error = "";
    $cls="";

    
        $query = "SELECT * FROM category WHERE category_name = '$category_name' AND `description` = '$description'";
        $query_run = mysqli_query($conn, $query);
        if (!$query_run->num_rows > 0) {

                        // Insert record

                        $query2 = "INSERT INTO category(category_name ,creation_date, `description`)
                        VALUES ('$category_name', '$date', '$description')";
                        $query_run2 = mysqli_query($conn, $query2);
            
                        if ($query_run2) {
                            echo "<script> alert('Category Successfully Addes.');
                            window.location.href='admin_category.php';</script>";
                        } 
                        else {
                            $cls="danger";
                            $error = mysqli_error($conn);
                        }

        }else{
            $cls="danger";
            $error = 'Category Already Exists.';
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
            <div class="row d-flex justify-content-between">
                <div class="col-md-10" style="padding-bottom:30px;">
                    <h2 style="font-weight:600">Add Category</h2>
                    <p><a href="admin_home.php">Home</a> / <a href="admin_category.php">Manage Categories</a> / Add Category
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 info main-content">
                    <!-- Star Tab Info -->
                    <div class="tab-info">
                        <!-- Start Tab Content -->
                        <div class="tab-content tab-content-info">
                            <!-- Single Tab -->
                            <div class="tab-pane fade active in">
                                <div class="info title">
                                    <form action="" method="POST" enctype='multipart/form-data'>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-<?php echo $cls;?>">
                                                    <?php 
                                                    if (isset($_POST['submit']) || isset($_POST['submit_img'])){
                                                        echo $error;
                                                }?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;font-weight:700;">Category Name <span class="color:red;">*</span></label>
                                                    <input type="text" class="form-control" name="category_name"
                                                        id="category_name" placeholder="Enter Category Name" required>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;font-weight:700;">Category Description <span class="color:red;">*</span></label>

                                                        <textarea class="form-control" name="description" style="padding:15px"
                                                        id="description" placeholder="Enter Description" required></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end" style="padding-top:10px;">
                                            <button type="submit" name="submit" class="btn btn-success"
                                                style="margin-right:10px;color:white;"><i class="fa fa-edit"></i>
                                                Add Category</button>
                                        </div>
                                    </form>
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
    <!-- End admin Profile -->


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