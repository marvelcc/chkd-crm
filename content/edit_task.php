<?php
  require_once('../conn.php');

  $task_id = isset($_GET['task_id'])? $_GET['task_id'] : '';



  $sql1 = "SELECT u.user_id, t.task_id, CONCAT(`u_first_name`,' ', `u_last_name`) AS task_owner, task_desc, task_type, CONCAT(`first_name`,' ', `last_name`) AS target, due, tt.person_id  FROM user u JOIN user_has_task ut on u.user_id = ut.user_id JOIN task t on ut.task_id = t.task_id JOIN task_target tt on tt.task_id = t.task_id JOIN person p on p.person_id = tt.person_id WHERE t.task_id = '$task_id'";
  $result = mysqli_query($conn, $sql1);
  $row = mysqli_fetch_assoc($result);



?>

<?php include_once ('../page/head.php') ?>
<h1 style="text-align: center; font-weight:bolder;">CHKD e. V. CRM System</h1>
<?php include_once ('../page/menu.php') ?>
<h3 style="text-align: center; font-weight:bolder;"><b>Edit task information</b></h3>
<br>
<form  method="post" action="update_task.php" class="wrapper1">
  <div class="form-group">
    <label>Task owner</label><br>
    <select name="task_owner">
      <option value="not_selected">Please select</option>
      <?php
      $result1 = mysqli_query($conn, "SELECT user_id, CONCAT(`u_first_name`, ' ', `u_last_name`) AS fullname FROM user");
      while ($row1 = mysqli_fetch_assoc($result1)){
        $selected1 = $row1['user_id']==$row['user_id']? 'selected="selected"':'';
        echo '<option value="'.$row1['user_id'].'" '.$selected1.' >'.$row1['fullname'].'</option>';
      }
       ?>
   </select>
  </div>

  <!-- task type -->
  <div class="form-group">
    <label>Task type</label><br>
    <select name="task_type">
        <option value="Email" <?php if($row['task_type'] == 'Email') echo 'selected="selected"'; ?>>Email</option>
        <option value="Call" <?php if($row['task_type'] == 'Call') echo 'selected="selected"'; ?>>Call</option>
        <option value="Meeting" <?php if($row['task_type'] == 'Meeting') echo 'selected="selected"'; ?>>Meeting</option>
        <option value="Other" <?php if($row['task_type'] == 'Other') echo 'selected="selected"'; ?>>Other</option>
      </select>
   </select>
  </div>


  <!--task description-->
  <div class="form-group">
    <label>Task description</label>
    <br>
    <textarea rows="5" cols="50" name="task_desc"><?php echo isset($row['task_desc'])?$row['task_desc']:''; ?></textarea>
  </div>

  <!-- task_target -->
  <div class="form-group">
    <label>Task target (Person)</label><br>
    <select name="task_target">
      <?php
        $result2 = mysqli_query($conn, "SELECT person_id, CONCAT(`first_name`, ' ', `last_name`) AS target FROM person");
        while ($row2 = mysqli_fetch_assoc($result2)){
          $selected2  = $row2['person_id']==$row['person_id']? 'selected="selected"':'';
          echo '<option value="'.$row2['person_id'].'" '.$selected2.'>'.$row2['target'].'</option>';
        }
       ?>
    </select>
  </div>

  <div class="form-group">
    <label>Due date</label><br>
    <input type="date" name="due" value="<?php echo isset ($row['due'])?$row['due']:''; ?>">
  </div>

  <div class="form-group">
    <input type="hidden" name="task_id" value="<?php echo $row['task_id']?>" />
    <input type="submit" name="submit" class="btnsml" value="Submit">
    <input type="reset" class="btnsml" value="Reset">
    <a href="task.php" class="btnsml">Back</a>
  </div>

</form>
</body>
</html>
