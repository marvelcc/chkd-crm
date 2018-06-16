<?php
  require_once('../conn.php');

  $person_id = isset($_GET['person_id'])? $_GET['person_id'] : '';



  $sql1 = "SELECT * FROM person natural join company natural join job WHERE person_id ='$person_id'";
  $result = mysqli_query($conn, $sql1);
  $row = mysqli_fetch_assoc($result);


?>

<?php include_once ('../page/head.php') ?>
<h1 style="text-align: center; font-weight:bolder;">CHKD e. V. CRM System</h1>
<?php include_once ('../page/menu.php') ?>
<h3 style="text-align: center; font-weight:bolder;"><b>Edit contact information</b></h3>
<br>
<form  method="post" action="update_person.php" class="wrapper1">
  <div class="form-group">
    <label>First name</label>
    <input type="text" name="first_name" class="form-control" value="<?php echo isset ($row['first_name'])?$row['first_name']:''; ?>">
  </div>

  <!-- Last Name -->
  <div class="form-group">
    <label>Last name</label>
    <input type="text" name="last_name" class="form-control" value="<?php echo isset ($row['last_name'])?$row['last_name']:''; ?>">
  </div>

  <!-- Abteilung -->
  <div class="form-group">
    <label>Department</label>
    <input type="text" name="department" class="form-control" value="<?php echo isset ($row['department'])?$row['department']:''; ?>">
  </div>

  <!-- Position -->
  <div class="form-group">
    <label>Position</label>
    <input type="text" name="position" class="form-control" value="<?php echo isset ($row['position'])?$row['position']:''; ?>">
  </div>

  <!-- Company -->
  <div class="form-group">
    <label>Company name</label>
    <input type="text" name="name_de" class="form-control" value="<?php echo isset ($row['name_de'])?$row['name_de']:''; ?>">
  </div>

  <div class="form-group">
    <label>Company name</label>
    <br>
    <?php
      echo '<select name="name_de">';
      $employer = mysqli_query($conn, "SELECT name_de FROM company ORDER BY name_de ASC");
      while ($row2 = mysqli_fetch_assoc($employer)){
        echo '<option value = "'.$row2['name_de'].'">'.$row2['name_de'].'</option>';
      }
      echo '</select>';
     ?>
  </div>


  <!-- Media type -->
  <div class="form-group">
    <label>Media Type</label>
    <select name="media_type" value="<?php echo $row['media_type']; ?>">
      <option value="German media" <?php if($row['media_type'] == 'German media') echo 'selected="selected"'; ?>>German media</option>
      <option value="Chinese media" <?php if($row['media_type'] == 'Chinese media') echo 'selected="selected"'; ?>>Chinese media</option>
      <option value="Foreign media" <?php if($row['media_type'] == 'Foreign media') echo 'selected="selected"'; ?>>Foreign media</option>
      <option value="Not media" <?php if($row['media_type'] == 'Not media') echo 'selected="selected"'; ?>>Not media</option>
    </select>
  </div>

  <!-- Magazine subscription -->
  <div class="form-group">
    <label for="ms">Magazine subscription:</label>
    <input type="checkbox" name="magazine_sub" value="<?php echo $row['magazine_sub']; ?>" <?php if($row['magazine_sub'] == 1) echo 'checked="checked"'; ?>>
  </div>

  <!-- Newsletter subscription -->
  <div class="form-group">
    <label>Newsletter subscription:</label>
    <input type="checkbox" name="newsletter_sub" value="<?php echo $row['newsletter_sub']; ?>" <?php if($row['newsletter_sub'] == 1) echo 'checked="checked"'; ?>>
  </div>

  <!-- Birthday -->
  <div class="form-group">
    <label>Birthday</label>
    <input type="date" name="birthday" value="<?php echo isset ($row['birthday'])?$row['birthday']:''; ?>">
  </div>

  <!-- Priority -->
  <div class="form-group">
    <label>Priority</label>
    <select name="priority" value="<?php echo $row['priority'];?>">
      <option value="High" <?php if($row['priority'] == 'high') echo 'selected="selected"'; ?>>High</option>
      <option value="Medium" <?php if($row['priority'] == 'medium') echo 'selected="selected"'; ?>>Medium</option>
      <option value="Low" <?php if($row['priority'] == 'low') echo 'selected="selected"'; ?>>Low</option>
      <option value="None" <?php if($row['priority'] == 'none') echo 'selected="selected"'; ?>>None</option>
    </select>
  </div>

  <!-- Telephone -->
  <div class="form-group">
    <label>Telephone</label>
    <input type="text" name="p_tel" class="form-control" value="<?php echo isset ($row['p_tel'])?$row['p_tel']:''; ?>">
  </div>

  <!-- Fax -->
  <div class="form-group">
    <label>Fax</label>
    <input type="text" name="fax" class="form-control" value="<?php echo isset ($row['fax'])?$row['fax']:''; ?>">
  </div>

  <!-- Mobile -->
  <div class="form-group">
    <label>Mobile</label>
    <input type="text" name="mobile" class="form-control" value="<?php echo isset ($row['mobile'])?$row['mobile']:''; ?>">
  </div>

  <!-- Email -->
  <div class="form-group">
    <label>Email</label>
    <input type="text" name="p_email" class="form-control" value="<?php echo isset ($row['p_email'])?$row['p_email']:''; ?>">
  </div>

  <!-- Wechat -->
  <div class="form-group">
    <label>Wechat</label>
    <input type="text" name="wechat" class="form-control" value="<?php echo isset ($row['wechat'])?$row['wechat']:''; ?>">
  </div>

  <!-- Remark -->
  <div class="form-group">
    <label>Remark</label>
    <br>
    <textarea rows="5" cols="50" name="p_remark"><?php echo isset ($row['p_remark'])?$row['p_remark']:''; ?></textarea>
  </div>

  <div class="form-group">
    <input type="hidden" name="person_id" value="<?php echo $row['person_id']?>" />
    <input type="submit" name="submit" class="btnsml" value="Submit">
    <input type="reset" class="btnsml" value="Reset">
    <a href="person.php" class="btnsml">Back</a>
  </div>

</form>
</body>
</html>
