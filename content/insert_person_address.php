<?php
  require_once '../conn.php';

  $person_id  = isset($_REQUEST['person_id'])? $_REQUEST['person_id']:'';

  $type=$err_type="";
  $street=$err_street="";
  $city=$err_city="";
  $state=$err_state="";
  $zip=$err_zip="";
  $country=$err_country="";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST["type"]) && $_POST["type"] == 'not_selected'){
      $err_type = "Please choose the address type!";
    }
    else {
      $type = $_POST["type"];
    }

    if(empty(trim($_POST["street"]))){
      $err_street = "Please enter the street name!";
    }
    else {
      $street = trim($_POST["street"]);
    }

    if(empty(trim($_POST["zip"]))){
      $err_zip = "Please enter the ZIP code!";
    }
    else {
      $zip = trim($_POST["zip"]);
    }

    if(empty(trim($_POST["city"]))){
        $err_city = "Please enter the city!";
    }
    else {
      $city = trim($_POST["city"]);
    }

    if(empty(trim($_POST["state"]))){
        $err_state = "Please enter the state or province!";
    }
    else {
      $state = trim($_POST["state"]);
    }

    if(empty(trim($_POST["country"]))){
        $err_country = "Please enter the country!";
    }
    else {
      $country = trim($_POST["country"]);
    }


    if (empty($err_type) &&empty($err_street) &&empty($err_state) &&empty($err_city) &&empty($err_state) &&empty($err_zip) &&empty($err_country)) {

      mysqli_autocommit($conn, FALSE);
      $sql1 = "INSERT INTO address (type, street, zip, city, state, country)
               VALUES (?, ?, ?, ?, ?, ?)";

      if ($stmt1 = mysqli_prepare($conn, $sql1)){
        mysqli_stmt_bind_param($stmt1, 'ssssss', $type, $street, $zip, $city, $state, $country);
      }
      mysqli_stmt_execute($stmt1);
      $address_id = mysqli_insert_id($conn);
      mysqli_stmt_close($stmt1);


      $sql2 = "INSERT INTO person_address (person_id, address_id) VALUES (?, ?)";
      if ($stmt2 = mysqli_prepare($conn, $sql2)){

        mysqli_stmt_bind_param($stmt2, 'ii', $person_id, $address_id);
        echo "INSERT INTO person_address (person_id, address_id) VALUES (?, ?) :$person_id, $address_id ";
      }
      mysqli_stmt_execute($stmt2) or die(mysqli_error($conn));
      mysqli_stmt_close($stmt2);


      header("location: person_address.php");

    }
      mysqli_commit($conn);

    mysqli_close($conn);
  }

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

  <h3 style="text-align: center; font-weight:bolder;">Add address information</h3>

  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>" method="post" class="wrapper1">

  <!-- Address type -->
    <div class="form-group <?php echo (!empty($err_type)) ? 'has-error' : ''; ?>">
      <label>Address type</label>
      <br>
      <select name="type">
        <option value="not_selected">Please select</option>
        <option value="Site">Site</option>
        <option value="Mailing">Mailing</option>
        <option value="Invoice">Invoice</option>
        <option value="Shipping">Shipping</option>
      </select>
      <span class="help-block"><?php echo $err_type; ?></span>
    </div>

    <!-- Street -->
    <div class="form-group <?php echo(!empty($err_street)) ? 'has-error' : ''; ?>">
      <label>Street</label>
      <input type="text" name="street" class="form-control">
      <span class="help-block"><?php echo $err_street; ?></span>
    </div>

    <!-- Zip -->
    <div class="form-group <?php echo(!empty($err_zip)) ? 'has-error' : ''; ?>">
      <label>ZIP</label>
      <input type="text" name="zip" class="form-control">
      <span class="help-block"><?php echo $err_zip; ?></span>
    </div>

    <!-- City -->
    <div class="form-group <?php echo(!empty($err_city)) ? 'has-error' : ''; ?>">
      <label>City</label>
      <input type="text" name="city" class="form-control">
      <span class="help-block"><?php echo $err_city; ?></span>
    </div>

    <!-- State/province -->
    <div class="form-group <?php echo(!empty($err_state)) ? 'has-error' : ''; ?>">
      <label>State/Province</label>
      <input type="text" name="state" class="form-control">
      <span class="help-block"><?php echo $err_state; ?></span>
    </div>

    <!-- Country -->
    <div class="form-group <?php echo(!empty($err_country)) ? 'has-error' : ''; ?>">
      <label>Country</label><br><?php var_dump($_REQUEST) ?>
      <input type="text" name="country" class="form-control">
      <span class="help-block"><?php echo $err_country; ?></span>
    </div>

    <div class="form-group">
      <input type="hidden" name="person_id" value="<?php echo $person_id ?>">
      <input type="submit" name="submit" class="btnsml" value="Confirm"/>
      <input type="reset" class="btnsml" value="Reset"/>
    </div>
  </form>

  <?php include_once('../page/footer.php'); ?>
