<?php
  require_once('../conn.php');

  $company_id = isset($_GET['company_id'])? $_GET['company_id'] : '';


  $sql = "SELECT * FROM company WHERE company_id = '$company_id' ";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  mysqli_close($conn);

?>

<?php include_once ('../page/head.php') ?>
<h1 style="text-align: center; font-weight:bolder;">CHKD e. V. CRM System</h1>
<?php include_once ('../page/menu.php') ?>
<h3 style="text-align: center; font-weight:bolder;"><b>Edit company information</b></h3>
<br>
<form method="post" action="update_company.php" class="wrapper1">
  <div class="form-group">
    <label>Company name</label>
    <input type="text" name="name_de" class="form-control" value="<?php echo isset ($row['name_de'])?$row['name_de']:''; ?>">
  </div>

  <div class="form-group">
    <label>Website</label>
    <input type="text" name="website" class="form-control" value="<?php echo isset ($row['website'])?$row['website']:''; ?>">
  </div>

  <div class="form-group">
    <label>Telephone</label>
    <input type="text" name="c_tel" class="form-control" value="<?php echo isset ($row['c_tel'])?$row['c_tel']:''; ?>">
  </div>

  <div class="form-group">
    <label>Email</label>
    <input type="text" name="c_email" class="form-control" value="<?php echo isset ($row['c_email'])?$row['c_email']:''; ?>">
  </div>

  <div class="form-group">
    <label>Member Type</label>
    <br>
    <select name="member_type" value="<?php echo $row['member_type']; ?>">
      <option value="Board" <?php if($row['member_type'] == 'Board') echo 'selected="selected"'; ?>>Board member</option>
      <option value="Council" <?php if($row['member_type'] == 'Council') echo 'selected="selected"'; ?>>Council member</option>
      <option value="Class A" <?php if($row['member_type'] == 'Class A') echo 'selected="selected"'; ?>>Class A member</option>
      <option value="Class B" <?php if($row['member_type'] == 'Class B') echo 'selected="selected"'; ?>>Class B member</option>
      <option value="Automotive Committee" <?php if($row['member_type'] == 'Automotive Committee') echo 'selected="selected"'; ?>>Automotive Committee</option>
      <option value="Support" <?php if($row['member_type'] == 'Support') echo 'selected="selected"'; ?>>Supporting member</option>
      <option value="Not" <?php if($row['member_type'] == 'Not') echo 'selected="selected"'; ?>>Not a member</option>
    </select>
  </div>

  <div class="form-group">
    <label>Industry</label>
    <br>
    <select name="industry" value="<?php echo $row['industry']; ?>">
      <option value="Agro" <?php if($row['industry'] == 'Agro') echo 'selected="selected"'; ?>>Agro</option>
      <option value="Electronics" <?php if($row['industry'] == 'Electronics') echo 'selected="selected"'; ?>>Electronics</option>
      <option value="Metal" <?php if($row['industry'] == 'Metal') echo 'selected="selected"'; ?>>Metal</option>
      <option value="Manufacturing" <?php if($row['industry'] == 'Manufacturing') echo 'selected="selected"'; ?>>Manufacturing</option>
      <option value="Automobile" <?php if($row['industry'] == 'Automobile') echo 'selected="selected"'; ?>>Automobile</option>
      <option value="IT" <?php if($row['industry'] == 'IT') echo 'selected="selected"'; ?>>IT</option>
      <option value="Finance" <?php if($row['industry'] == 'Finance') echo 'selected="selected"'; ?>>Finance</option>
      <option value="Pharma" <?php if($row['industry'] == 'Pharma') echo 'selected="selected"'; ?>>Pharma</option>
      <option value="Media" <?php if($row['industry'] == 'Media') echo 'selected="selected"'; ?>>Media</option>
      <option value="Publishing">Publishing</option>
      <option value="Logistic" <?php if($row['industry'] == 'Logistic') echo 'selected="selected"'; ?>>Logistic</option>
      <option value="Trading" <?php if($row['industry'] == 'Trading') echo 'selected="selected"'; ?>>Trading</option>
      <option value="Energy" <?php if($row['industry'] == 'Energy') echo 'selected="selected"'; ?>>Energy</option>
      <option value="Other" <?php if($row['industry'] == 'Other') echo 'selected="selected"'; ?>>Other</option>
    </select>
  </div>

  <div class="form-group">
    <label>Service region</label>
    <br>
    <select name="service_region" value="<?php echo $row['service_region']; ?>">
      <option value="EU" <?php if($row['service_region'] == 'EU') echo 'selected="selected"'; ?>>European Union</option>
      <option value="Western Europe" <?php if($row['service_region'] == 'Western Europe') echo 'selected="selected"'; ?>>Western Europe</option>
      <option value="Germany and German-speaking region" <?php if($row['service_region'] == 'Germany and German-speaking region') echo 'selected="selected"'; ?>>Germany and German-speaking region</option>
      <option value="Other" <?php if($row['service_region'] == 'Other') echo 'selected="selected"'; ?>>Other</option>
    </select>
  </div>

  <div class="form-group">
    <label>Employee count</label>
    <input type="text" name="employee_count" class="form-control" value="<?php echo isset ($row['employee_count'])?$row['employee_count']:''; ?>">
  </div>

  <div class="form-group">
    <label>Registration number</label>
    <input type="text" name="registration_nr" class="form-control" value="<?php echo isset ($row['registration_nr'])?$row['registration_nr']:''; ?>">
  </div>

  <div class="form-group">
    <label>Annual revenue</label>
    <input type="text" name="annual_revenue" class="form-control" value="<?php echo isset ($row['annual_revenue'])?$row['annual_revenue']:''; ?>">
  </div>

  <div class="form-group">
    <label>Parent company(if exists)</label>
    <br>
    <?php
      echo '<select name="parent_company">';
      echo '<option value="1">n/a</option>';
      $result1 = mysqli_query($conn, "SELECT company_id, name_de FROM company ORDER BY name_de ASC LIMIT 1, 5000");
      while ($row2 = mysqli_fetch_assoc($result1)){
        echo '<option value = "'.$row2['company_id'].'">'.$row2['name_de'].'</option>';
      }
      echo '</select>';
     ?>
  </div>

  <div class="form-group">
    <label>Remark</label>
    <br>
    <textarea rows="5" cols="50" name="c_remark"><?php echo isset ($row['c_remark'])?$row['c_remark']:''; ?></textarea>
  </div>

  <div class="form-group">
    <input type="hidden" name="company_id" value="<?php echo $row['company_id']?>" />
    <input type="submit" name="submit" class="btnsml" value="Submit">
    <input type="reset" class="btnsml" value="Reset">
    <a href="company.php" class="btnsml">Back</a>
  </div>


</form>
</body>
</html>
