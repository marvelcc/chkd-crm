<?php
  require_once('../conn.php');

  $person_id = isset($_GET['person_id'])? $_GET['person_id'] : '';
  $address_id = isset($_GET['address_id'])? $_GET['address_id'] : '';

  $sql = "SELECT * FROM person natural join address natural join person_address where person_id = '$person_id' AND address_id = '$address_id' ";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  mysqli_close($conn);

?>

<?php include_once ('../page/head.php') ?>

<h1 style="text-align: center; font-weight:bolder;">CHKD e. V. CRM System</h1>

<?php include_once ('../page/menu.php') ?>

<h3 style="text-align: center; font-weight:bolder;"><b> Edit address information</b></h3>

<form method="post" action="update_person_address.php" class="wrapper1">
  <div class="form-group">
    <label>Address Type</label>
    <br>
    <select name="type" value="<?php echo $row['type']; ?>">
      <option value="Invoice" <?php if($row['type'] == 'Invoice') echo 'selected="selected"'; ?>>Invoice</option>
      <option value="Shipping" <?php if($row['type'] == 'Shipping') echo 'selected="selected"'; ?>>Shipping</option>
      <option value="Site" <?php if($row['type'] == 'Site') echo 'selected="selected"'; ?>>Site</option>
      <option value="Mailing" <?php if($row['type'] == 'Mailing') echo 'selected="selected"'; ?>>Mailing</option>
    </select>
  </div>

  <div class="form-group">
    <label>Street</label>
    <input type="text" name="street" class="form-control" value="<?php echo isset ($row['street'])?$row['street']:''; ?>">
  </div>

  <div class="form-group">
    <label>ZIP</label>
    <input type="text" name="zip" class="form-control" value="<?php echo isset ($row['zip'])?$row['zip']:''; ?>">
  </div>

  <div class="form-group">
    <label>City</label>
    <input type="text" name="city" class="form-control" value="<?php echo isset ($row['city'])?$row['city']:''; ?>">
  </div>

  <div class="form-group">
    <label>State/Province</label>
    <input type="text" name="state" class="form-control" value="<?php echo isset ($row['state'])?$row['state']:''; ?>">
  </div>

  <div class="form-group">
    <label>Country</label>
    <input type="text" name="country" class="form-control" value="<?php echo isset ($row['country'])?$row['country']:''; ?>">
  </div>

  <div class="form-group">
    <input type="hidden" name="person_id" value="<?php echo $row['person_id']?>" />
    <input type="hidden" name="address_id" value="<?php echo $row['address_id']?>" />
    <input type="submit" name="submit" class="btnsml" value="Submit">
    <input type="reset" class="btnsml" value="Reset">
    <a href="person_address.php?person_id=<?php echo $row['person_id']?>" class="btnsml">Back</a>
  </div>


</form>
