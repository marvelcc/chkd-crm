<?php
  require_once '../conn.php';

	if ($_POST['delete']) {

    $address_id = isset($_GET['address_id'])? $_GET['address_id'] : '';

    $sql1 = "DELETE From address where address_id = $address_id";

    if(mysqli_query($conn, $sql1)){
        header("location: company.php");
      }
      else{
        die("Update failed".mysqli_error($conn));
      }
  	}
    ?>
