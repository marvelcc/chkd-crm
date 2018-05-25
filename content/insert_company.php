<?php
  require_once '../conn.php';

  $name_de=$err_name_de= "";
  $name_cn="";
  $website="";
  $tel=$err_tel="";
  $email=$err_email="";
  $service_region=$err_service_region="";
  $employee_count="";
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




if($_SERVER["REQUEST_METHOD"] == "POST"){

  // deut. Name
  if(empty(trim($_POST["name_de"]))){
      $err_name_de = "Please enter company's German name!";
  }
  else {
    $name_de = trim($_POST["name_de"]);
  }

  // chn. Name
  $name_cn = trim($_POST["name_cn"]);

  // Webseite
  $website = trim($_POST["website"]);

  // Telefonnummer
  if(empty(trim($_POST["tel"]))){
      $err_tel = "Please enter company's telephone number!";
  }
  else {
    $tel = trim($_POST["tel"]);
  }

  // Email-Adresse
  if(empty(trim($_POST["email"]))){
      $err_email = "Please enter company email!";
  }
  else {
    $email = trim($_POST["email"]);
  }

  //Service Region
  if(isset($_POST["service_region"]) && $_POST["service_region"] == '100'){
    $err_service_region = "Please choose the service region!";
  }
  else {
    $service_region = $_POST["service_region"];
  }







}
?>



<?php
include_once('head.php');
?>


<h1 style="text-align: center; font-weight:bolder;">CHKD e. V. CRM System</h1>

<?php include_once('menu.php'); ?>


<?php
 //contents
?>
<?php include_once('footer.php'); ?>
