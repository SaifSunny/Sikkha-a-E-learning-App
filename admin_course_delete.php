<?php
include './database/config.php';

$did = $_GET['id'];

  $query = "DELETE FROM courses WHERE course_id='$did'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   

    echo "<script> 
    alert('Course has been Deleted.');
    window.location.href='admin_courses.php';
    </script>";
    

  }else{
    echo mysqli_error($conn);
  }
?>