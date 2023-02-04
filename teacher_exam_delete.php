<?php
include './database/config.php';

$exam_id = $_GET['exam_id'];
$course_id = $_GET['course_id'];

  $query = "DELETE FROM course_exams WHERE exam_id='$exam_id'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   

    echo "<script> 
    alert('Course has been Deleted.');
    window.location.href='teacher_course_details.php?id=$course_id';
    </script>";
    

  }else{
    echo "<script>alert('Cannot Delete Course');
      window.location.href='teacher_course_details.php?id=$course_id';
      </script>";
  }
?>