<?php
include_once "./database/config.php";

session_start();
$username = $_SESSION["adminname"];

if (!isset($_SESSION["adminname"])) {
    header("Location: admin_login.php");
}

$sql = "SELECT * FROM admin WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$image = $row["admin_img"];
$admin_id = $row["admin_id"];

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
                    <h2 style="font-weight:600">Manage Students</h2>
                    <p><a href="admin_home.php">Home</a> / Manage Students</p>
                </div>
                <div class="col-md-2" style="text-align:right; padding-right:70px; padding-top:20px;">
              <a href="admin_student_add.php" class="btn btn-success">Add Students</a>
            </div>
            </div>
            <div class="row">
                <table class="table" style="font-size: 14px;color:#222;">
                    <thead>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Birthday</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php 
                      $sql = "SELECT * FROM students";
                      $result = mysqli_query($conn, $sql);
                      if($result){
                        while($row=mysqli_fetch_assoc($result)){
                          $name=$row['firstname']. " ".$row['lastname'];
                          $id=$row['student_id'];
                          $gender=$row['gender'];
                          $birthday=$row['birthday'];
                          $address=$row['address'].",".$row['city'].",".$row['zip'];
                          $contact=$row['contact'];
                          $email=$row['email'];
                          $image=$row['student_img'];
                    ?>
                        <tr>
                            <td><img src="./assets/img/students/<?php echo $image?>" style="width:60px;border-radius: 20%;"
                                    alt="profile">
                                <span style="padding-left:20px;"></span></td>
                            <td><?php echo $name ?></td>
                            <td><?php echo $gender ?></td>
                            <td><?php echo $birthday ?></td>
                            <td><?php echo $contact ?></td>
                            <td><?php echo $email ?></td>
                            <td><?php echo $address ?></td>
                            <td><a href="admin_student_delete.php?id=<?php echo $id ?>" class="btn btn-danger">Delete</a>
                            </td>

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