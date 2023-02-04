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

$image = $row["teacher_img"];
$teacher_id = $row["teacher_id"];



if(isset($_POST['submit'])){


    $course_name = $_POST['course_name'];
    $course_type = $_POST['type'];
    $schedule = $_POST['schedule'];
    $description = $_POST['description'];
    $base_price = $_POST['base_price'];
    $category = $_POST['category'];
    $date=  date("Y-m-d l h:i:sa");

    $error = "";
    $cls="";
 
    $name = $_FILES['file']['name'];
    $target_dir = "assets/img/courses/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
  
    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");


            $query = "SELECT * FROM courses WHERE teacher_id = '$teacher_id' AND course_name = '$course_name'";
            $query_run = mysqli_query($conn, $query);
            if(!$query_run->num_rows > 0){

                // Check extension
                if( in_array($imageFileType,$extensions_arr) ){

                    // Upload file
                    if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){

                        // Convert to base64 
                        $image_base64 = base64_encode(file_get_contents('assets/img/courses/'.$name));
                        $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

                        // Insert record

                        $query2 = "INSERT INTO courses(category_id, course_img,`course_name`, `description`, teacher_id , publish_date, base_price, course_type, schedule)
                        VALUES ('$category', '$name', '$course_name', '$description', '$teacher_id ', '$date', '$base_price', '$course_type', '$schedule')";
                        $query_run2 = mysqli_query($conn, $query2);
            
                        if ($query_run2) {
                            $cls="success";
                            $error = "Course Successfully Added.";
                        } 
                        else {
                            $cls="danger";
                            $error = mysqli_error($conn);
                        }

                    }else{
                        $cls="danger";
                        $error = 'Unknown Error Occurred.';
                    }
                }else{
                    $cls="danger";
                    $error = 'Invalid File Type';
                }
            }
            else{
                $cls="danger";
                $error = "Course Already Exists";
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


    <!-- Start teachers Profiel 
    ============================================= -->
    <div class="students-profiel adviros-details-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="padding-bottom:30px;">
                    <h2 style="font-weight:600">Add Course</h2>
                    <p><a href="teacher_courses.php">Home</a> / Add Courses</p>
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
                                            <div class="col-md-4">
                                                <div>
                                                    <img src="assets/img/courses/add.jpg" alt="Thumb" width="80%">
                                                </div>

                                                <input type="file" name="file" id="file"
                                                    style="border:none; margin-top:40px;">

                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Course Title <span
                                                            class="color:red;">*</span></label>
                                                    <input type="text" class="form-control" name="course_name"
                                                        id="course_name" placeholder="Enter Course Title" required>
                                                </div>
                                            </div>


                                            <div class="col-md-4" style="z-index:66">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Category <span
                                                            class="color:red;">*</span></label>
                                                    <select id="category" name="category" required>
                                                        <option class="form-group">-- Select Category --</option>
                                                        <?php
                                                            $br_option = "SELECT * FROM category";
                                                            $br_option_run = mysqli_query($conn, $br_option);

                                                            if (mysqli_num_rows($br_option_run) > 0) {
                                                                foreach ($br_option_run as $row2) {
                                                            ?>
                                                        <option value="<?php echo $row2['category_id']; ?>"><?php echo $row2['category_name'];?> </option>
                                                        <?php
                                                                }
                                                            }
                                                            ?>
                                                        <option class="form-group"></option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Base Price <span
                                                            class="color:red;">*</span></label>
                                                    <input type="text" class="form-control" name="base_price"
                                                        id="base_price" placeholder="Enter Base Price">
                                                </div>
                                            </div>
                                            <div class="col-md-4" >
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;font-weight:600">Course Type<span
                                                            class="color:red;">*</span></label>
                                                    <select class="form-control" id="type" name="type" required>
                                                        <option>-- Select Type --</option>  
                                                        <option value="Recorded">Recorded</option>
                                                        <option value="Online">Online</option>
                                                    <option></option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Schedule (for Online Courses) <span
                                                            class="color:red;"></span></label>
                                                    <input type="text" class="form-control" name="schedule"
                                                        id="schedule" placeholder="Ex: Every Monday at 11:00 Am">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" style="padding:10px">
                                                    <label style="padding-bottom:10px;">Course Description <span
                                                            class="color:red;">*</span></label>
                                                    <textarea name="description" id="description" class="form-control"
                                                        placeholder="Enter Course Description"></textarea>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-end" style="padding-top:10px;">
                                            <button type="submit" name="submit" class="btn btn-success"
                                                style="margin-right:10px;color:white;"><i class="fa fa-edit"></i>
                                                Add Course</button>
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