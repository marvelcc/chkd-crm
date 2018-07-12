<?php
  require_once '../conn.php';

  $person_id = isset($_REQUEST['person_id'])? $_REQUEST['person_id'] : '';

	if ($_POST['delete']) {

    $address_id = isset($_GET['address_id'])? $_GET['address_id'] : '';

    $sql1 = "DELETE From address where address_id = $address_id";


    if(mysqli_query($conn, $sql1)){
        header("location: person_address.php?person_id=$person_id");
      }
      else{
        die("Update failed".mysqli_error($conn));
      }
  	}
    ?>
