<?php
  require_once('../conn.php');

  $task_id = isset($_GET['task_id'])? $_GET['task_id'] : '';



  $sql1 = "SELECT t.task_id, CONCAT(`u_first_name`,' ', `u_last_name`) AS task_owner, task_desc, task_type, CONCAT(`first_name`,' ', `last_name`) AS target, due, tt.person_id  FROM user u JOIN user_has_task ut on u.user_id = ut.user_id JOIN task t on ut.task_id = t.task_id JOIN task_target tt on tt.task_id = t.task_id JOIN person p on p.person_id = tt.person_id WHERE t.task_id = '$task_id'";
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
    <label>Task owner</label>
    <select name="task_owner">
      <option value="not_selected">Please select</option>
    <?php
      echo '<option value="'.$row['task_id'].'">'.$row['task_owner'].'</option>';
     ?>
   </select>
  </div>

  <!-- Last Name -->
  <div class="form-group">
    <label>Last name</label>
    <input type="text" name="u_last_name" class="form-control" value="<?php echo isset ($row['u_last_name'])?$row['u_last_name']:''; ?>">
  </div>


  <!-- Mobile -->
  <div class="form-group">
    <label>Mobile</label>
    <input type="text" name="mobile" class="form-control" value="<?php echo isset ($row['mobile'])?$row['mobile']:''; ?>">
  </div>

  <!-- Email -->
  <div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control" value="<?php echo isset ($row['email'])?$row['email']:''; ?>">
  </div>

  <!-- Roles -->
  <div class="form-group">
    <label>Roles</label><br>
    <?php
      $sql2 = mysqli_query($conn, "SELECT group_concat(role_id) as rid FROM role natural join user_role where user_id = $user_id");
      $array=array();
      while($row2 = mysqli_fetch_assoc($sql2)){
        $rid= $row2['rid'];
        $array = explode(",", $rid);
      }
     ?>

    <?php
    $select = mysqli_query($conn, "SELECT group_concat(role_id) as rid FROM role");
    $array2=array();
    while ($row4=mysqli_fetch_assoc($select)) {
      $rid2 = $row4['rid'];
      $array2= explode(",", $rid2);
    }

    $query = mysqli_query($conn, "SELECT * from role");
    while($list = mysqli_fetch_assoc($query)){
      foreach($array2 as $value){
        $checked = in_array($list['role_id'], $array)? 'checked="checked"':'';
      }
      echo'<input type="checkbox" name="roles[]" value="'.$list['role_id'].'" '.$checked.';>'.$list['role_name'].'</input><br>';
    }
     ?>
 </div>

  <div class="form-group">
    <input type="hidden" name="user_id" value="<?php echo $row['user_id']?>" />
    <input type="submit" name="submit" class="btnsml" value="Submit">
    <input type="reset" class="btnsml" value="Reset">
    <a href="user.php" class="btnsml">Back</a>
  </div>

</form>
</body>
</html>
