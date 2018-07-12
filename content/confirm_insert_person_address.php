<?php
  require_once '../conn.php';

	if ($_POST['submit']) {

    $person_id = isset($_POST['person_id'])? $_POST['person_id'] : '';
    $address_id = isset($_POST['address_id'])? $_POST['address_id'] : '';

     $sql1 = "INSERT INTO address (type, street, zip, city, state, country)
              VALUES (?, ?, ?, ?, ?, ?)";
     if ($stmt1 = mysqli_prepare($conn, $sql1)){
       mysqli_stmt_bind_param($stmt1, 'ssssss', $_POST['type'], $_POST['street'], $_POST['zip'], $_POST['city'], $_POST['state'], $_POST['country']);
     }
     mysqli_stmt_execute($stmt1);
     $address_id = mysqli_insert_id($conn);
     mysqli_stmt_close($stmt1);



     $sql2 = "INSERT INTO person_address (person_id, address_id) VALUES ($person_id, $address_id)";
     mysqli_query($conn, $sql2) or die(mysqli_error($conn));

     header("location: person_address.php?person_id=$person_id");

     mysqli_close($conn);

	}
  ?>
