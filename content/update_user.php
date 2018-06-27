<?php
  require_once '../conn.php';

	if ($_POST['submit']) {

    mysqli_autocommit($conn, FALSE);

    $user_id = isset($_POST['user_id'])? $_POST['user_id'] : '';
    $role = implode(',', $_POST['roles']);

    $sql1 = "UPDATE user natural join role natural join user_role SET first_name=? , last_name=? , email=?, mobile=? WHERE user_id= ?";

      if($stmt1 = mysqli_prepare($conn, $sql1)){
        mysqli_stmt_bind_param($stmt1, 'ssssi', $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['mobile'], $user_id);}
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_close($stmt1);


    $sql2 = "INSERT INTO user_role SET role_id =? WHERE user_id=?";
    if ($stmt2 = mysqli_prepare($conn, $sql2)){
      mysqli_stmt_bind_param($stmt2, 'ii', $role, $user_id);
    }
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);
c
    header("location: user.php");



    mysqli_commit($conn) or die(mysqli_error($conn));
    mysqli_close($conn);
	}
  ?>
