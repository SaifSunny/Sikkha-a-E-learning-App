<?php
include './database/config.php';

$lid = $_GET['id'];
$cid = $_GET['cid'];

  $query = "DELETE FROM course_lessons WHERE lesson_id='$lid'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   

    echo "<script> 
    alert('Lesson has been Deleted.');
    window.location.href='teacher_course_details.php?id=$cid';
    </script>";
    

  }else{
    echo "<script>alert('Cannot Delete Lesson');
      window.location.href='teacher_course_details.php?id=$cid';
      </script>";
  }
?>