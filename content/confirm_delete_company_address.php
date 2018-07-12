<?php
  require_once '../conn.php';
  $company_id = isset($_REQUEST['company_id'])? $_REQUEST['company_id'] : '';

	if ($_POST['delete']) {

    $address_id = isset($_GET['address_id'])? $_GET['address_id'] : '';

    $sql1 = "DELETE From address where address_id = $address_id";

    if(mysqli_query($conn, $sql1)){
        header("location: company_address.php?company_id=$company_id");
      }
      else{
        die("Update failed".mysqli_error($conn));
      }
  	}
    ?>
