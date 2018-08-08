<?php
  require_once '../conn.php';

	if ($_POST['delete']) {

    $task_id = isset($_POST['task_id'])? $_POST['task_id'] : '';


    $sql1 = "UPDATE task SET completed = '1'
             WHERE task_id = {$task_id}";

    if(mysqli_query($conn, $sql1)){
        header("location: task.php");
      }
      else{
        die("Update failed".mysqli_error($conn));
      }
  	}
    ?>
