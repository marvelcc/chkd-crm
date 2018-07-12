<?php
  require_once('../conn.php');

	if ($_POST['submit']) {

    mysqli_autocommit($conn, FALSE);

    $user_id = isset($_POST['user_id'])? $_POST['user_id'] : '';
    $role = implode(',', $_POST['roles']);

    $sql1 = "UPDATE user natural join role natural join user_role SET u_first_name=? , u_last_name=? , email=?, mobile=? WHERE user_id= ?";

      if($stmt1 = mysqli_prepare($conn, $sql1)){
        mysqli_stmt_bind_param($stmt1, 'ssssi', $_POST['u_first_name'], $_POST['u_last_name'], $_POST['email'], $_POST['mobile'], $user_id);}
        mysqli_stmt_execute($stmt1) or die(mysqli_error($conn));
        mysqli_stmt_close($stmt1);


    mysqli_query($conn, "DELETE FROM user_role where user_id = $user_id") or die(mysqli_error($conn));

    if(isset($_POST['roles'])){
      foreach ($_POST['roles'] as $ur ) {
        mysqli_query($conn, "INSERT INTO user_role (role_id, user_id) VALUES($ur, $user_id)") or die(mysqli_error($conn));
      }
    }
    else{
      mysqli_rollback($conn);
    }

    header("location: user.php");



    mysqli_commit($conn) or die(mysqli_error($conn));
    mysqli_close($conn);
	}
  ?>
