<?php
include './database/config.php';

$did = $_GET['id'];

  $query = "DELETE FROM students WHERE student_id='$did'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   

    echo "<script> 
    alert('Student has been Deleted.');
    window.location.href='admin_students.php';
    </script>";
    

  }else{
    echo "<script>alert('Cannot Delete Student');
      window.location.href='admin_students.php';
      </script>";
  }
?>