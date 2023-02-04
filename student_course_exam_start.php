<?php
include './database/config.php';
date_default_timezone_set('Asia/Dhaka');

$course_id = $_GET['cid'];
$exam_id = $_GET['lid'];
$student_id = $_GET['sid'];

$now = date("d F Y h:i A");

$query4 = "SELECT * FROM course_exams WHERE exam_id = '$exam_id'";
$query_run4 = mysqli_query($conn, $query4);
$row=mysqli_fetch_assoc($query_run4);
$exam_duration=$row['exam_duration'];

$deadline = date("Y/m/d H:i:s", strtotime("+$exam_duration minutes"));
$new_deadline = date("d F Y h:i A", strtotime($deadline));


$query = "SELECT * FROM course_exam_complete WHERE exam_id = '$exam_id' AND student_id= '$student_id'";
$query_run = mysqli_query($conn, $query);

if ($query_run->num_rows > 0) {
  header("location: student_course_exam.php?course_id=$course_id&exam_id=$exam_id");

}else{

  $query = "INSERT INTO course_exam_complete(exam_id, student_id, `start_date`, deadline) values('$exam_id','$student_id','$now', '$new_deadline')";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   
    header("location: student_course_exam.php?course_id=$course_id&exam_id=$exam_id");
  }
}
?>