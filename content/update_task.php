<?php
  require_once('../conn.php');

	if ($_POST['submit']) {

    mysqli_autocommit($conn, FALSE);

    $task_id = isset($_POST['task_id'])? $_POST['task_id'] : '';

    $sql1 = "UPDATE task SET task_type=?, task_desc=?, due=? Where task_id=?";
    if ($stmt1= mysqli_prepare($conn, $sql1)) {
      mysqli_stmt_bind_param($stmt1, 'sssi', $_POST['task_type'], $_POST['task_desc'], $_POST['due'], $_POST['task_id']);
    }
    mysqli_stmt_execute($stmt1) or die(mysqli_error($conn));
    mysqli_stmt_close($stmt1);

    $sql2 = "UPDATE user_has_task SET user_id=? where task_id=?";
    if ($stmt2 = mysqli_prepare($conn, $sql2)) {
      mysqli_stmt_bind_param($stmt2, 'ii', $_POST['task_owner'], $_POST['task_id']);
    }
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);

    $sql3 = "UPDATE task_target SET person_id=? where task_id=?";
    if ($stmt3 = mysqli_prepare($conn, $sql3)){
      mysqli_stmt_bind_param($stmt3, 'ii', $_POST['task_target'], $_POST['task_id']);
    }
    mysqli_stmt_execute($stmt3);
    mysqli_stmt_close($stmt3);

    header("location: task.php");

    mysqli_commit($conn) or die(mysqli_error($conn));
    mysqli_close($conn);
    }
    ?>
