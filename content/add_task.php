<?php
  require_once('../conn.php');

  $task_owner=$err_task_owner= "";
  $task_desc=$err_task_desc="";
  $task_type=$err_task_type="";
  $task_target=$err_task_target="";
  $due=$err_due="";



if($_SERVER["REQUEST_METHOD"] == "POST"){

  //task owner
  if(isset($_POST["task_owner"]) && $_POST["task_owner"] == 'not_selected'){
    $err_task_owner = "Please select the task owner!";
  }
  else {
    $task_owner = $_POST["task_owner"];

  }

  //task description
  if(empty(trim($_POST["task_desc"]))){
      $err_task_desc = "Please describe the task!";
  }
  else {
    $task_desc = trim($_POST["task_desc"]);
  }

  // task type
  if(isset($_POST["task_type"]) && $_POST["task_type"] == 'not_selected'){
    $err_task_type = "Please choose the task type!";
  }
  else {
    $task_type = $_POST["task_type"];

  }

  if(isset($_POST["task_target"]) && $_POST["task_target"] == 'not_selected'){
    $err_task_target = "Please select the task target!";
  }
  else {
    $task_target = $_POST["task_target"];

  }

  if(isset($_POST["due"])){
    $due = date("Y-m-d", strtotime($_POST["due"]));
  }
  else{
    $err_due = "Please set a time limit for this task!";
  }



  if(empty($err_task_owner) && empty($err_task_type) &&empty($err_task_desc) &&empty($err_task_target)){

    mysqli_autocommit($conn, FALSE);

    $sql1 = "INSERT INTO task (task_type, task_desc, due) VALUES (?, ?, ?)";
    if($stmt1= mysqli_prepare($conn, $sql1)){
      mysqli_stmt_bind_param($stmt1, 'sss', $task_type, $task_desc, $due);
    }
    mysqli_stmt_execute($stmt1);
    $task_id = mysqli_insert_id($conn);
    mysqli_stmt_close($stmt1);


    $sql2 = "INSERT INTO user_has_task (user_id, task_id) VALUES (?, $task_id)";
    if($stmt2 = mysqli_prepare($conn, $sql2)){
      mysqli_stmt_bind_param($stmt2, 'i', $user_id);
      $user_id = $task_owner;
    }
    mysqli_stmt_execute($stmt2) or die(mysqli_error($conn));
    mysqli_stmt_close($stmt2);

    $sql3 = "INSERT INTO task_target (task_id, person_id) VALUES ($task_id, ?)";
    if($stmt3 = mysqli_prepare($conn, $sql3)){
      mysqli_stmt_bind_param($stmt3, 'i', $person_id);
      $person_id = $task_target;
    }
    mysqli_stmt_execute($stmt3);
    mysqli_stmt_close($stmt3);

    header("location: task.php");
  }
  mysqli_commit($conn);
  mysqli_close($conn);
}
?>



<?php
include_once('../page/head.php');
?>


<h1 style="text-align: center; font-weight:bolder;">CHKD e. V. CRM System</h1>

<?php include_once('../page/menu.php'); ?>

<h3 style="text-align: center; font-weight:bolder;">Add new task</h3>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>" method="post" class="wrapper1">

  <!--task owner-->
  <div class="form-group <?php echo (!empty($err_task_owner)) ? 'has-error' : ''; ?>">
    <label>Task owner</label><br>
    <select name="task_owner">
    <option value="not_selected">Please select</option>
    <?php
    $result1 = mysqli_query($conn, "SELECT user_id, CONCAT(`u_first_name`, ' ', `u_last_name`) AS fullname FROM user");
    while ($row1 = mysqli_fetch_assoc($result1)){
      echo '<option value="'.$row1['user_id'].'">'.$row1['fullname'].'</option>';
    }

     ?>
   </select>
    <span class="help-block"><?php echo $err_task_owner; ?></span>
  </div>

  <!--task type-->
  <div class="form-group <?php echo (!empty($err_task_type)) ? 'has-error' : ''; ?>">
    <label>Task type</label>
    <br>
    <select name="task_type">
      <option value="not_selected">Please select</option>
      <option value="Email">Email</option>
      <option value="Call">Call</option>
      <option value="Meeting">Meeting</option>
      <option value="Other">Other</option>
    </select>
  </div>

  <!--task description-->
  <div class="form-group">
    <label>Task description</label>
    <br>
    <textarea rows="5" cols="50" name="task_desc"></textarea>
  </div>

  <!-- task target -->
  <div class="form-group <?php echo (!empty($err_task_target)) ? 'has-error' : ''; ?>">
    <label>Task target (Person)</label><br>
    <select name="task_target">
      <option value="not_selected">Please select</option>
      <?php
        $result2 = mysqli_query($conn, "SELECT person_id, CONCAT(`first_name`, ' ', `last_name`) AS target FROM person");
        while ($row2 = mysqli_fetch_assoc($result2)){
          echo '<option value="'.$row2['person_id'].'">'.$row2['target'].'</option>';
        }
       ?>
    </select>
    <span class="help-block"><?php echo $err_task_target; ?></span>
  </div>

  <!-- due -->
  <div class="form-group <?php echo (!empty($err_due)) ? 'has-error' : ''; ?>">
    <label>Due date</label>
    <br>
    <input type="date" name="due">
    <span class="help-block"><?php echo $err_due; ?></span>

  </div>


  <div class="form-group">
    <input type="submit" class="btnsml" value="Add task">
    <input type="reset" class="btnsml" value="Reset">
    <a href="task.php" class="btnsml">Back</a>

  </div>
</form>



</form>
<?php include_once('../page/footer.php'); ?>
