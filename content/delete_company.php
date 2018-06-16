<?php
	require_once '../conn.php';

  $company_id = isset($_GET['company_id'])? $_GET['company_id'] : '';

  $sql = "SELECT * FROM company natural join company_address natural join address WHERE company_id ='{$company_id}'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($conn);

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

<h3 style="padding-left:700px; font-weight:bolder;">Delete company</h3>
<h4 style="padding-left:700px; font-weight:bolder;">Are you sure to delete the company?</h4>

<form action="confirm_delete_company.php" method="post" class="wrapper1">
  <div class="form-group">
    <input type="hidden" name="company_id" value="<?php echo $row['company_id']?>" />
    <input type="submit" name="delete" class="btnsml" value="Confirm">
    <a href="company.php" class="btnsml">Back</a>
  </div>
</form>
