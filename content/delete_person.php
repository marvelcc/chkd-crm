<?php
	require_once '../conn.php';

  $person_id = isset($_GET['person_id'])? $_GET['person_id'] : '';

  $sql = "SELECT * FROM person natural join company natural join job natural join address natural join person_address WHERE person_id ='{$person_id}'";
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

<h3 style="padding-left:700px; font-weight:bolder;">Delete contact</h3>
<h4 style="padding-left:700px; font-weight:bolder;">Are you sure to delete the contact?</h4>

<form action="confirm_delete_person.php" method="post" class="wrapper1">
  <div class="form-group">
    <input type="hidden" name="person_id" value="<?php echo $row['person_id']?>" />
    <input type="submit" name="delete" class="btnsml" value="Confirm">
    <a href="person.php" class="btnsml">Back</a>
  </div>
</form>
