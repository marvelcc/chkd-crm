<?php
  require_once '../conn.php';

	if ($_POST['submit']) {

    $person_id = isset($_POST['person_id'])? $_POST['person_id'] : '';
    $address_id = isset($_POST['address_id'])? $_POST['address_id'] : '';

    $sql = "UPDATE address natural join person_address SET type=?, street=?, zip=?, city=?, state=?, country=? WHERE person_id=? AND address_id=?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, 'ssssssii', $_POST['type'], $_POST['street'], $_POST['zip'], $_POST['city'], $_POST['state'], $_POST['country'], $_POST['person_id'], $_POST['address_id']);
    }

    if(mysqli_stmt_execute($stmt)){
      header("location: person_address.php?person_id=$person_id");
    }
    else{
      die("Update failed".mysqli_error());
    }
    mysqli_stmt_close($stmt);
	}
  ?>
