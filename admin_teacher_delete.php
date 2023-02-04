<?php
include './database/config.php';

$did = $_GET['id'];

  $query = "DELETE FROM teachers WHERE teacher_id='$did'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   

    echo "<script> 
    alert('Teacher has been Deleted.');
    window.location.href='admin_teachers.php';
    </script>";
    

  }else{
    echo "<script>alert('Cannot Delete Teacher');
      window.location.href='admin_teachers.php';
      </script>";
  }
?>