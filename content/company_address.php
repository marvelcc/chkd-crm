<?php
  require_once('../conn.php');

  $company_id = isset($_GET['company_id'])? $_GET['company_id'] : '';


  $sql = "SELECT * FROM company natural join address natural join company_address where company_id = '$company_id' ";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  mysqli_close($conn);

?>

<?php include_once ('../page/head.php') ?>

<h1 style="text-align: center; font-weight:bolder;">CHKD e. V. CRM System</h1>

<?php include_once ('../page/menu.php') ?>

<h3 style="text-align: center; font-weight:bolder;"><b> <?php  echo $row['name_de'];?> ---- Address information</b></h3>
<br>


<form>
<?php
echo '<input type="button" value="Add new address" onclick="window.location.href=\'insert_company_address.php?company_id='.$row['company_id'].'\'" class="btnsml"/>'
;?>

</form>


<div>
  <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Address type</th>
      <th>Street</th>
      <th>ZIP</th>
      <th>City</th>
      <th>State/Province</th>
      <th>Country</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
      echo '<tr>';
      echo '<td>'. $row['type'] . '</td>';
      echo '<td>'. $row['street'] . '</td>';
      echo '<td>'. $row['zip'] . '</td>';
      echo '<td>'. $row['city'] . '</td>';
      echo '<td>'. $row['state'] . '</td>';
      echo '<td>'. $row['country'] . '</td>';
      echo '<td>';
      echo '<a class="btnsml" href="edit_company_address.php?company_id='.$row['company_id'].'">Edit</a>';
      echo ' ';
      echo '<a class="btnsml" href="delete_company_address.php?company_id='.$row['company_id'].'">Delete</a>';
      echo '</td>';
      echo '</tr>';
    ?>
  </tbody>
  </table>
</div>


<?php include_once('../page/footer.php'); ?>
