<?php
include './database/config.php';
date_default_timezone_set('Asia/Dhaka');

$course_id = $_GET['course_id'];
$student_id = $_GET['student_id'];
$date=date('d F Y h:i A');

  $query = "INSERT INTO course_student(student_id, course_id, enrolled_date) VALUES ('$student_id', '$course_id', '$date')";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   

    echo "<script> 
    alert('You Have Successfully Enrolled in this Course');
    window.location.href='student_course_details.php?id=$course_id';
    </script>";
    

  }else{
    echo mysqli_error($conn);
  }
?>