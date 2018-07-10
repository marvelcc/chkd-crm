<?php
	require_once '../conn.php';

  $task_id = isset($_GET['task_id'])? $_GET['task_id'] : '';

  $sql = "SELECT * FROM user u JOIN user_has_task ut on u.user_id = ut.user_id JOIN task t on ut.task_id = t.task_id JOIN task_target tt on tt.task_id = t.task_id JOIN person p on p.person_id = tt.person_id WHERE t.task_id ='{$task_id}'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($conn);

?>

<!--Head-->
<?php
include_once('../page/head.php');
?>

<!--Body-->
<h1 style="text-align: center; font-weight:bolder;">CHKD e. V. CRM System</h1>

 <!--Menü-->
<?php include_once('../page/menu.php'); ?>

<!--Main Code-->

<h3 style="padding-left:700px; font-weight:bolder;">Complete task</h3>
<h4 style="padding-left:700px; font-weight:bolder;">Are you sure to this task is completed?</h4>
<form action="confirm_complete_task.php" method="post" class="wrapper1">
  <div class="form-group">
    <input type="hidden" name="task_id" value="<?php echo $row['task_id']?>" />
    <input type="submit" name="delete" class="btnsml" value="Confirm">
    <a href="task.php" class="btnsml">Back</a>
  </div>
</form>
