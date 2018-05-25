<!-- Head -->
<?php
include_once('../page/head.php');
?>

<!-- Body -->
<h1 style="text-align: center; font-weight:bolder;">CHKD e. V. CRM System</h1>

<!-- Menü -->
<?php include_once('../page/menu.php'); ?>

<!-- Main code -->
<h3 style="padding-left:15px; font-weight:bolder;">Company</h3>
<form>
    <input type="button" value="Add new company" onclick="window.location.href='insert_company.php'" class="btnsml" />
</form>



<?php
 //contents
?>
<?php include_once('../page/footer.php'); ?>
