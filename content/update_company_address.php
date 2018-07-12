<?php
  require_once '../conn.php';

	if ($_POST['submit']) {

    $company_id = isset($_POST['company_id'])? $_POST['company_id'] : '';
    $address_id = isset($_POST['address_id'])? $_POST['address_id'] : '';

    $sql = "UPDATE address natural join company_address SET type=?, street=?, zip=?, city=?, state=?, country=? WHERE company_id=? AND address_id=?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, 'ssssssii', $_POST['type'], $_POST['street'], $_POST['zip'], $_POST['city'], $_POST['state'], $_POST['country'], $_POST['company_id'], $_POST['address_id']);
    }

    if(mysqli_stmt_execute($stmt)){
      header("location: company_address.php?company_id=$company_id");
    }
    else{
      die("Update failed".mysqli_error());
    }
    mysqli_stmt_close($stmt);
	}
  ?>
