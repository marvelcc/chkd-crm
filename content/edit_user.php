<?php
  require_once('../conn.php');

  $user_id = isset($_GET['user_id'])? $_GET['user_id'] : '';



  $sql1 = "SELECT * FROM user natural join user_role natural join role WHERE user_id ='$user_id'";
  $result = mysqli_query($conn, $sql1);
  $row = mysqli_fetch_assoc($result);


?>

<?php include_once ('../page/head.php') ?>
<h1 style="text-align: center; font-weight:bolder;">CHKD e. V. CRM System</h1>
<?php include_once ('../page/menu.php') ?>
<h3 style="text-align: center; font-weight:bolder;"><b>Edit contact information</b></h3>
<br>
<form  method="post" action="update_user.php" class="wrapper1">
  <div class="form-group">
    <label>First name</label>
    <input type="text" name="first_name" class="form-control" value="<?php echo isset ($row['first_name'])?$row['first_name']:''; ?>">
  </div>

  <!-- Last Name -->
  <div class="form-group">
    <label>Last name</label>
    <input type="text" name="last_name" class="form-control" value="<?php echo isset ($row['last_name'])?$row['last_name']:''; ?>">
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
    $sql="SELECT * from role";
    $list = mysqli_query($conn, $sql);
    while($checkbox = mysqli_fetch_assoc($list)){
      echo'<input type="checkbox" name="roles[]" value="'.$checkbox['role_id'].'">'.$checkbox['role_name'].'</input>';
      echo '<br>';
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
