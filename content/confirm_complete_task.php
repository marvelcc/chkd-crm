<?php
  require_once '../conn.php';

	if ($_POST['delete']) {

    $task_id = isset($_POST['task_id'])? $_POST['task_id'] : '';


    $sql1 = "DELETE t, tt, ut
             FROM task t join task_target tt on t.task_id = tt.task_id
                           join user_has_task ut on ut.task_id = t.task_id
             WHERE t.task_id = {$task_id}";

    if(mysqli_query($conn, $sql1)){
        header("location: task.php");
      }
      else{
        die("Update failed".mysqli_error($conn));
      }
  	}
    ?>
