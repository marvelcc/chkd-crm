<?php
  require_once '../conn.php';

  $company_id = isset($_GET['company_id'])? $_GET['company_id'] : '';

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

      $sql1 = "INSERT INTO address (type, street, zip, city, state, country)"

    }














  }
