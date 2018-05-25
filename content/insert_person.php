<!-- Neuer Kontakt hinzufügen -->
<?php
  require_once '../conn.php';

  // Variablen definieren
  $first_name=$err_first_name="";
  $last_name=$err_last_name="";
  $media_type=$err_media_type="";
  $magazine_sub=$newsletter_sub="";
  $birthday="";
  $priority=$err_priority="";
  $p_remark="";
  $address_type=$err_address_type="";
  $street=$err_street="";
  $city=$err_city="";
  $state=$err_state="";
  $zip=$err_zip="";
  $country=$err_country="";
  $p_tel="";
  $mobile=$err_mobile="";
  $p_email=$err_p_email="";
  $wechat="";
  $fax="";
  $department=$err_department="";
  $position=$err_position="";
  $name_de=$err_name_de="";



if($_SERVER["REQUEST_METHOD"] == "POST"){

  // Vorname
  if(empty(trim($_POST["first_name"]))){
      $err_first_name = 'Please enter contacts first name!';
  }
  else {
    $first_name = trim($_POST["first_name"]);
  }

  // Nachname
  if(empty(trim($_POST["last_name"]))){
      $err_last_name = 'Please enter contacts last name!';
  }
  else {
    $last_name = trim($_POST["last_name"]);
  }

  // Unternehmen
  if(empty(trim($_POST["name_de"]))){
      $err_name_de = "Please enter contact's company!";
  }
  else {
    $name_de = trim($_POST["name_de"]);
  }

  // Abteilung
  if(empty(trim($_POST["department"]))){
      $err_department = "Please enter contact's department!";
  }
  else {
    $department = trim($_POST["department"]);
  }


  // Position
  if(empty(trim($_POST["position"]))){
      $err_position = "Please enter contact's position!";
  }
  else {
    $position = trim($_POST["position"]);
  }

  // Medientyp
  if(isset($_POST["media_type"]) && $_POST["media_type"] == 'empty'){
    $err_media_type = "Please select which type of media this contact is!";
  }
  else {
    $media_type = $_POST["media_type"];
  }

  // Magazin Abonnent
  $magazine_sub = isset($_POST["magazine_sub"]) ? 1:0;

  // Newsletter Abonnent
  $newsletter_sub = isset($_POST["newsletter_sub"]) ? 1:0;

  // Geburtstag
  $birthday = date("Y-m-d", strtotime($_POST["birthday"]));

  // Priorität
  if(isset($_POST["priority"]) && $_POST["priority"] == 'not_selected'){
    $err_priority = "Please assign the priority level!";
  }
  else {
    $priority = $_POST["priority"];
  }

  // Anmerkung
  $p_remark = $_POST["p_remark"];

  //Telefonnummer
  $p_tel = trim($_POST["p_tel"]);

  //Handynummer
  if(empty(trim($_POST["mobile"]))){
    $err_mobile = "Please enter contact's mobile phone number!";
  }
  else {
    $mobile = trim($_POST["mobile"]);
  }

  //Email
  if(empty(trim($_POST["p_email"]))){
    $err_p_email = "Please enter contact's email address!";
  }
  else {
    $p_email = trim($_POST["p_email"]);
  }

  // Wechat-Konto
  $wechat = trim($_POST["wechat"]);

  //Fax
  $fax = trim($_POST["fax"]);


  // Adresstyp
  if(isset($_POST["type"]) && $_POST["type"] == 'x'){
    $err_address_type = "Please choose address type!";
  }
  else {
    $address_type = $_POST["type"];
  }

  // Straße
  if(empty(trim($_POST["street"]))){
    $err_street = "Please enter a valid address!";
  }
  else {
    $street = trim($_POST["street"]);
  }

  // Stadt
  if(empty(trim($_POST["city"]))){
    $err_city = "Please enter a valid city!";
  }
  else {
    $city = trim($_POST["city"]);
  }

  // Provinz/Staat
  if(empty(trim($_POST["state"]))){
    $err_state = "Please enter a valid province or state!";
  }
  else {
    $state = trim($_POST["state"]);
  }

  // PLZ
  if(empty(trim($_POST["zip"]))){
    $err_zip = "Please enter the ZIP code!";
  }
  else {
    $zip = trim($_POST["zip"]);
  }

  // Land
  if(empty(trim($_POST["country"]))){
    $err_country = "Please enter a valid country!";
  }
  else {
    $country = trim($_POST["country"]);
  }

  // Daten in MySQL einschreiben
  if(empty($err_first_name) && empty($err_last_name) && empty($err_media_type) && empty($err_priority)){


    //AutoCommit ausschalten
    mysqli_autocommit($conn, FALSE);

    // Prepared Statement zum Einschreiben
    $sql1 = "INSERT INTO person (first_name, last_name, media_type, magazine_sub, newsletter_sub, birthday, priority, p_remark, p_tel, mobile, fax, p_email, wechat)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt1 = mysqli_prepare($conn, $sql1)) {
          mysqli_stmt_bind_param($stmt1, 'sssiissssssss', $param_first_name, $param_last_name, $param_media_type, $param_magazine_sub, $param_newsletter_sub, $param_birthday, $param_priority, $param_p_remark, $param_p_tel, $param_mobile, $param_fax, $param_p_email, $param_wechat);

          $param_first_name = $first_name;
          $param_last_name = $last_name;
          $param_media_type = $media_type;
          $param_magazine_sub = $magazine_sub;
          $param_newsletter_sub = $newsletter_sub;
          $param_birthday = $birthday;
          $param_priority = $priority;
          $param_p_remark = $p_remark;
          $param_p_tel = $p_tel;
          $param_mobile = $mobile;
          $param_fax = $fax;
          $param_p_email = $p_email;
          $param_wechat = $wechat;
        }
          mysqli_stmt_execute($stmt1);
          $person_id = mysqli_insert_id($conn);
          mysqli_stmt_close($stmt1);



    $sql2 = "INSERT INTO address (type, street, city, state, zip, country)
             VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt2 = mysqli_prepare($conn, $sql2) or die(mysqli_error($conn))) {
          mysqli_stmt_bind_param($stmt2, 'ssssss', $param_address_type, $param_street, $param_city, $param_state, $param_zip, $param_country);

          $param_address_type = $address_type;
          $param_street = $street;
          $param_city = $city;
          $param_state = $state;
          $param_zip = $zip;
          $param_country = $country;
        }

        mysqli_stmt_execute($stmt2);
        $address_id = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt2);



  $sql3 = "INSERT INTO company (name_de)
           VALUES (?)";
      if ($stmt3 = mysqli_prepare($conn, $sql3) or die(mysqli_error($conn))){
        mysqli_stmt_bind_param($stmt3, 's', $param_name_de);

        $param_name_de = $name_de;
      }

      mysqli_stmt_execute($stmt3);
      $company_id = mysqli_insert_id($conn);
      mysqli_stmt_close($stmt3);


  $sql4 = "INSERT INTO job (person_id, company_id, department, position)
           VALUES ($person_id, $company_id, ?, ?)";
      if ($stmt4 = mysqli_prepare($conn, $sql4) or die(mysqli_error($conn))){
        mysqli_stmt_bind_param($stmt4, 'ss', $param_dep, $param_pos);

        $param_dep = $department;
        $param_pos = $position;
      }

      mysqli_stmt_execute($stmt4);
      mysqli_stmt_close($stmt4);



  $sql5 = "INSERT INTO person_address (person_id, address_id)
           VALUES ($person_id, $address_id)";

  mysqli_query($conn, $sql5)  or die(mysqli_error($conn));

  header("location: person.php");

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

<h3 style="padding-left:15px; font-weight:bolder;">Create new contacts</h3>


<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>" method="post" style="padding-left:15px">


  <!--First name-->
  <div class="form-group <?php echo (!empty($err_first_name)) ? 'has-error' : ''; ?>">
    <label>First Name</label>
    <input type="text" name="first_name" class="form-control" value="<?php echo $first_name ?>">
    <span class="help-block"><?php echo $err_first_name; ?></span>
  </div>

  <!-- Last Name -->
  <div class="form-group <?php echo (!empty($err_last_name)) ? 'has-error' : ''; ?>">
    <label>Last Name</label>
    <input type="text" name="last_name" class="form-control" value="<?php echo $last_name ?>">
    <span class="help-block"><?php echo $err_last_name; ?></span>
  </div>

  <!-- Abteilung -->
  <div class="form-group <?php echo (!empty($err_department)) ? 'has-error' : ''; ?>">
    <label>Department</label>
    <input type="text" name="department" class="form-control" value="<?php echo $department ?>">
    <span class="help-block"><?php echo $err_department; ?></span>
  </div>

  <!-- Position -->
  <div class="form-group <?php echo (!empty($err_position)) ? 'has-error' : ''; ?>">
    <label>Position</label>
    <input type="text" name="position" class="form-control" value="<?php echo $position ?>">
    <span class="help-block"><?php echo $err_position; ?></span>
  </div>

  <!-- Company -->
  <div class="form-group <?php echo (!empty($err_name_de)) ? 'has-error' : ''; ?>">
    <label>Company name</label>
    <input type="text" name="name_de" class="form-control" value="<?php echo $name_de ?>">
    <span class="help-block"><?php echo $err_name_de; ?></span>
  </div>

  <!-- Media type -->
  <div class="form-group <?php echo (!empty($err_media_type)) ? 'has-error' : ''; ?>">
    <label>Media Type</label>
    <select name="media_type">
      <option value="empty">Please select</option>
      <option value="german">German</option>
      <option value="chinese">Chinese</option>
      <option value="foreign">Foreign</option>
      <option value="not">Not</option>
    </select>
    <span class="help-block"><?php echo $err_media_type; ?></span>
  </div>

  <!-- Magazine subscription -->
  <div class="form-group">
    <label>Magazine subscription:</label>

    <input type="checkbox" name="magazine_sub" value="1"/>
  </div>

  <!-- Newsletter subscription -->
  <div class="form-group">
    <label>Newsletter subscription:</label>
    <input type="checkbox" name="newsletter_sub" value="1"/>
  </div>

  <!-- Birthday -->
  <div class="form-group">
    <label>Birthday</label>
    <input type="date" name="birthday">
  </div>

  <!-- Priority -->
  <div class="form-group <?php echo (!empty($err_priority)) ? 'has-error' : ''; ?>">
    <label>Priority</label>
    <select name="priority">
      <option value="not_selected">Please select</option>
      <option value="High">High</option>
      <option value="Medium">Medium</option>
      <option value="Low">Low</option>
      <option value="None">None</option>
    </select>
    <span class="help-block"><?php echo "$err_priority"; ?></span>
  </div>

  <!-- Telephone -->
  <div class="form-group">
    <label>Telephone</label>
    <input type="text" name="p_tel" class="form-control">
  </div>

  <!-- Fax -->
  <div class="form-group">
    <label>Fax</label>
    <input type="text" name="fax" class="form-control">
  </div>

  <!-- Mobile -->
  <div class="form-group <?php echo(!empty($err_mobile)) ? 'has-error' : ''; ?>">
    <label>Mobile</label>
    <input type="text" name="mobile" class="form-control">
    <span class="help-block"><?php echo $err_mobile; ?></span>
  </div>

  <!-- Email -->
  <div class="form-group <?php echo(!empty($err_p_email)) ? 'has-error' : ''; ?>">
    <label>Email</label>
    <input type="text" name="p_email" class="form-control">
    <span class="help-block"><?php echo $err_p_email; ?></span>
  </div>

  <!-- Wechat -->
  <div class="form-group">
    <label>Wechat</label>
    <input type="text" name="wechat" class="form-control">
  </div>


  <!-- Street -->
  <div class="form-group <?php echo(!empty($err_street)) ? 'has-error' : ''; ?>">
    <label>Street</label>
    <input type="text" name="street" class="form-control">
    <span class="help-block"><?php echo $err_street; ?></span>
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

  <!-- Zip -->
  <div class="form-group <?php echo(!empty($err_zip)) ? 'has-error' : ''; ?>">
    <label>ZIP</label>
    <input type="text" name="zip" class="form-control">
    <span class="help-block"><?php echo $err_zip; ?></span>
  </div>

  <!-- Country -->
  <div class="form-group <?php echo(!empty($err_country)) ? 'has-error' : ''; ?>">
    <label>Country</label>
    <input type="text" name="country" class="form-control">
    <span class="help-block"><?php echo $err_country; ?></span>
  </div>

  <!-- Address type -->
  <div class="form-group <?php echo(!empty($err_address_type)) ? 'has-error' : ''; ?>">
    <label>Address Type</label>
    <select name="type">
      <option value="x">Please select</option>
      <option value="invoice">Invoice</option>
      <option value="mailing">Mailing</option>
      <option value="shipping">Shipping</option>
      <option value="site">Site</option>
    </select>
    <span class="help-block"><?php echo $err_address_type; ?></span>
  </div>

  <!-- Remark -->
  <div class="form-group">
    <label>Remark</label>
    <input type="text" name="p_remark">
  </div>

  <div class="form-group">
    <input type="submit" class="btnsml" value="Add Contact">
    <input type="reset" class="btnsml" value="Reset">
  </div>
</form>

<?php include_once('../page/footer.php'); ?>
