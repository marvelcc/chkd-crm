<?php
	require_once '../conn.php';

  $company_id = isset($_GET['company_id'])? $_GET['company_id'] : '';
  $address_id = isset($_GET['address_id'])? $_GET['address_id'] : '';
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

<h3 style="padding-left:700px; font-weight:bolder;">Delete address</h3>
<h4 style="padding-left:700px; font-weight:bolder;">Are you sure to delete the address?</h4>

<form action="confirm_delete_company_address.php?address_id=<?php echo $address_id?>" method="post" class="wrapper1">
  <div class="form-group">
    <input type="hidden" name="address_id" value="<?php echo $address_id ?>" />
    <input type="submit" name="delete" class="btnsml" value="Confirm">
    <a href="company_address.php?company_id=<?php echo $company_id?>" class="btnsml">Back</a>
  </div>
</form>
