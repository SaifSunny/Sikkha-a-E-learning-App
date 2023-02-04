<?php
include './database/config.php';

$did = $_GET['id'];

  $query = "DELETE FROM category WHERE category_id='$did'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   

    echo "<script> 
    alert('Category has been Deleted.');
    window.location.href='admin_category.php';
    </script>";
    

  }else{
    echo mysqli_error($conn);
  }
?>