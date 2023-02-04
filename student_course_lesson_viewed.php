<?php
include './database/config.php';

$course_id = $_GET['cid'];
$lesson_id = $_GET['lid'];
$student_id = $_GET['sid'];

$query = "SELECT * FROM course_lesson_complete WHERE lesson_id = '$lesson_id' AND student_id= '$student_id'";
$query_run = mysqli_query($conn, $query);

if ($query_run->num_rows > 0) {
  header("location: student_course_lesson.php?cid=$course_id&lid=$lesson_id");

}else{

  $query = "INSERT INTO course_lesson_complete(lesson_id, student_id) values('$lesson_id','$student_id')";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   
    header("location: student_course_lesson.php?cid=$course_id&lid=$lesson_id");
  }
}
?>