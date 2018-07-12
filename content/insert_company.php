<?php
  require_once '../conn.php';

  $name_de=$err_name_de= "";
  $website="";
  $c_tel=$err_c_tel="";
  $c_email=$err_c_email="";
  $service_region=$err_service_region="";
  $employee_count="";
  $c_remark ="";
  $registration_nr="";
  $annual_revenue="";
  $member_type=$err_member_type="";
  $parent_company="";
  $address_type=$err_address_type="";
  $street=$err_street="";
  $city=$err_city="";
  $state=$err_state="";
  $zip=$err_zip="";
  $country=$err_country="";
  $industry=$err_industry="";




if($_SERVER["REQUEST_METHOD"] == "POST"){

  // deut. Name
  if(empty(trim($_POST["name_de"]))){
      $err_name_de = "Please enter company's name!";
  }
  else {
    $query1 = "SELECT company_id FROM company where name_de = ?";
    if($val1 = mysqli_prepare($conn, $query1)){
      mysqli_stmt_bind_param($val1, 's', $val_name);
      $val_name= trim($_POST['name_de']);
      if(mysqli_stmt_execute($val1)){
        mysqli_stmt_store_result($val1);
        if(mysqli_stmt_num_rows($val1) == 1){
          $err_name_de="This company already exists in the system!";
        }
        else{
          $name_de = trim($_POST['name_de']);
        }
      }
    }
  }

  // Webseite
  $website = trim($_POST["website"]);

  // Telefonnummer
  if(empty(trim($_POST["c_tel"]))){
      $err_c_tel = "Please enter company's telephone number!";
  }
  else {
    $c_tel = trim($_POST["c_tel"]);
  }

  // Email-Adresse
  if(empty(trim($_POST["c_email"]))){
      $err_c_email = "Please enter company email!";
  }
  else {
    $c_email = trim($_POST["c_email"]);
  }




  //Industry
  if(isset($_POST["industry"]) && $_POST["industry"] == 'not_selected'){
    $err_industry = "Please choose the industry!";
  }
  else {
    $industry = $_POST["industry"];
  }




  //Service Region
  if(isset($_POST["service_region"]) && $_POST["service_region"] == 'not_selected'){
    $err_service_region = "Please choose the service region!";
  }
  else {
    $service_region = $_POST["service_region"];
  }

  //Employee count
  $employee_count = $_POST["employee_count"];

  //Registration number
  $registration_nr = trim($_POST["registration_nr"]);

  //Annual revenue
  $annual_revenue = trim($_POST["annual_revenue"]);

  //Member type
  if(isset($_POST["member_type"]) && $_POST["member_type"] == 'not_selected'){
    $err_member_type = "Please choose the member type for this company!";
  }
  else {
    $member_type = $_POST["member_type"];
  }

  //Remark
  $c_remark = $_POST['c_remark'];

  //Parent company
  $parent_company = $_POST["parent_company"];

  // Address type
  if(isset($_POST["type"]) && $_POST["type"] == 'not_selected'){
    $err_address_type = "Please choose address type!";
  }
  else {
    $address_type = $_POST["type"];
  }

  // Street
  if(empty(trim($_POST["street"]))){
    $err_street = "Please enter a valid address!";
  }
  else {
    $street = trim($_POST["street"]);
  }

  // City
  if(empty(trim($_POST["city"]))){
    $err_city = "Please enter a valid city!";
  }
  else {
    $city = trim($_POST["city"]);
  }

  // Province/State
  if(empty(trim($_POST["state"]))){
    $err_state = "Please enter a valid province or state!";
  }
  else {
    $state = trim($_POST["state"]);
  }

  // ZIP
  if(empty(trim($_POST["zip"]))){
    $err_zip = "Please enter the ZIP code!";
  }
  else {
    $zip = trim($_POST["zip"]);
  }

  // Country
  if(empty(trim($_POST["country"]))){
    $err_country = "Please enter a valid country!";
  }
  else {
    $country = trim($_POST["country"]);
  }

  if(empty($err_name_de) && empty($err_c_tel) &&empty($err_c_email) &&empty($err_service_region) &&empty($err_industry) &&empty($err_member_type) &&empty($err_address_type) &&empty($err_street) &&empty($err_state) &&empty($err_city) &&empty($err_state) &&empty($err_zip) &&empty($err_country)){

    mysqli_autocommit($conn, FALSE);

    $sql1 = "INSERT INTO company (name_de, website, c_tel, c_email, service_region, employee_count, registration_nr, annual_revenue, member_type, industry, c_remark, parent_company)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

          if($stmt1 = mysqli_prepare($conn, $sql1)){
            mysqli_stmt_bind_param($stmt1, 'sssssisssssi', $param_name_de, $param_website, $param_c_tel, $param_c_email, $param_service_region, $param_employee_count, $param_reg_nr, $param_annual_revenue, $param_member_type, $param_industry, $param_c_remark, $param_parent_company);

            $param_name_de = $name_de;
            $param_website = $website;
            $param_c_tel = $c_tel;
            $param_c_email = $c_email;
            $param_service_region = $service_region;
            $param_employee_count = $employee_count;
            $param_reg_nr = $registration_nr;
            $param_annual_revenue = $annual_revenue;
            $param_industry = $industry;
            $param_member_type = $member_type;
            $param_c_remark = $c_remark;
            $param_parent_company = $parent_company;
          }
          mysqli_stmt_execute($stmt1) or die(mysqli_error($conn));
          $company_id = mysqli_insert_id($conn);
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

      $sql3 = "INSERT INTO company_address (company_id, address_id)
               VALUES ($company_id, $address_id)";

      mysqli_query($conn, $sql3);

      header("location: company.php");
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

<h3 style="text-align: center; font-weight:bolder;">Add new company</h3>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>" method="post" class="wrapper1">

  <!--Company name-->
  <div class="form-group <?php echo (!empty($err_name_de)) ? 'has-error' : ''; ?>">
    <label>Company name</label>
    <input type="text" name="name_de" class="form-control" value="<?php echo $name_de ?>">
    <span class="help-block"><?php echo $err_name_de; ?></span>
  </div>

  <!--Website-->
  <div class="form-group">
    <label>Website</label>
    <input type="text" name="website" class="form-control" value="<?php echo $website ?>">
  </div>

  <!--Telephone-->
  <div class="form-group <?php echo (!empty($err_c_tel)) ? 'has-error' : ''; ?>">
    <label>Telephone</label>
    <input type="text" name="c_tel" class="form-control" value="<?php echo $c_tel ?>">
    <span class="help-block"><?php echo $err_c_tel; ?></span>
  </div>

  <!--Email-->
  <div class="form-group <?php echo (!empty($err_c_email)) ? 'has-error' : ''; ?>">
    <label>Email</label>
    <input type="text" name="c_email" class="form-control" value="<?php echo $c_email ?>">
    <span class="help-block"><?php echo $err_c_email; ?></span>
  </div>

  <!-- Member type -->
  <div class="form-group <?php echo (!empty($err_member_type)) ? 'has-error' : ''; ?>">
    <label>Member type</label>
    <br>
    <select name="member_type">
      <option value="not_selected">Please select</option>
      <option value="Board">Board member</option>
      <option value="Council">Council member</option>
      <option value="Class A">Class A member</option>
      <option value="Class B">Class B member</option>
      <option value="Automotive committee">Automotive committee member</option>
      <option value="Support">Support member</option>
      <option value="Not">Not a member</option>
    </select>
    <span class="help-block"><?php echo $err_member_type; ?></span>
  </div>

  <!-- Industry -->
  <div class="form-group <?php echo (!empty($err_industry)) ? 'has-error' : ''; ?>">
    <label>Industry</label>
    <br>
    <select name="industry">
      <option value="not_selected">Please select</option>
      <option value="Agro">Agro</option>
      <option value="Electronics">Electronics</option>
      <option value="Metal">Metal</option>
      <option value="Manufacturing">Manufacturing</option>
      <option value="Automobile">Automobile</option>
      <option value="IT">IT</option>
      <option value="Finance">Finance</option>
      <option value="Legal">Legal</option>
      <option value="Textile">Textile</option>
      <option value="Construction">Construction</option>
      <option value="Pharma">Pharma</option>
      <option value="Media">Media</option>
      <option value="Publishing">Publishing</option>
      <option value="Logistic">Logistic</option>
      <option value="Trading">Trading</option>
      <option value="Energy">Energy</option>
      <option value="Other">Other</option>
    </select>
    <span class="help-block"><?php echo $err_industry; ?></span>
  </div>


  <!--Service region-->
  <div class="form-group <?php echo (!empty($err_service_region)) ? 'has-error' : ''; ?>">
    <label>Service region</label>
    <br>
    <select name="service_region">
      <option value="not_selected">Please select</option>
      <option value="EU">European Union</option>
      <option value="Western Europe">Western Europe</option>
      <option value="Germany and German-speaking region">Germany and German-speaking region</option>
      <option value="Other">Other</option>
    </select>
    <span class="help-block"><?php echo $err_service_region; ?></span>
  </div>

  <!-- Employee count -->
  <div class="form-group">
    <label>Employee count</label>
    <input type="text" name="employee_count" class="form-control">
  </div>

  <!-- Registration number -->
  <div class="form-group">
    <label>Registration number</label>
    <input type="text" name="registration_nr" class="form-control">
  </div>

  <!-- Annual revenue -->
  <div class="form-group">
    <label>Annual revenue</label>
    <input type="text" name="annual_revenue" class="form-control">
  </div>


  <!-- Parent company -->
  <div class="form-group">
    <label>Parent company(if exists)</label>
    <br>
    <?php
      echo '<select name="parent_company">';
      echo '<option value="1">n/a</option>';
      $result = mysqli_query($conn, "SELECT company_id, name_de FROM company ORDER BY name_de ASC LIMIT 1, 5000");
      while ($row = mysqli_fetch_assoc($result)){
        echo '<option value = "'.$row['company_id'].'">'.$row['name_de'].'</option>';
      }
      echo '</select>';
     ?>
  </div>

  <!-- Address type -->
  <div class="form-group <?php echo(!empty($err_address_type)) ? 'has-error' : ''; ?>">
    <label>Address Type</label>
    <br>
    <select name="type">
      <option value="not_selected">Please select</option>
      <option value="Invoice">Invoice</option>
      <option value="Mailing">Mailing</option>
      <option value="Shipping">Shipping</option>
      <option value="Site">Site</option>
    </select>
    <span class="help-block"><?php echo $err_address_type; ?></span>
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
    <label>Country</label>
    <input type="text" name="country" class="form-control">
    <span class="help-block"><?php echo $err_country; ?></span>
  </div>

  <!-- Remark -->
  <div class="form-group">
    <label>Remark</label>
    <br>
    <textarea rows="5" cols="50" name="c_remark"></textarea>
  </div>

  <div class="form-group">
    <input type="submit" class="btnsml" value="Add company">
    <input type="reset" class="btnsml" value="Reset">
  </div>
</form>



</form>
<?php include_once('../page/footer.php'); ?>
