<?php
  require_once '../conn.php';

	if ($_POST['submit']) {

    $user_id = isset($_POST['user_id'])? $_POST['user_id'] : '';

    $sql = "UPDATE user natural join role natural join user_role SET first_name=? , last_name=? , email=?, mobile=?, role_id=?  WHERE user_id= ?";

      if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, 'ssssii', $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['mobile'], $_POST['role_id'], $_POST['user_id']);

    }

		if(mysqli_stmt_execute($stmt)){
      header("location: user.php");
    }
    else{
      die("Update failed".mysqli_error($conn));
    }
    mysqli_stmt_close($stmt);
	}
  ?>
