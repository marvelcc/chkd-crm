<?php
  require_once('../conn.php');

  $company_id = isset($_GET['company_id'])? $_GET['company_id'] : '';

?>

<?php include_once ('../page/head.php') ?>

<h1 style="text-align: center; font-weight:bolder;">CHKD e. V. CRM System</h1>

<?php include_once ('../page/menu.php') ?>

<h3 style="text-align: center; font-weight:bolder;"><b>Address information</b></h3>
<br>

<?php
echo '<div>';
echo '<table class="table table-striped table-bordered">';
echo '<thead>';
echo '<tr>';
echo '<th>Address type</th>';
echo '<th>Street</th>';
echo      '<th>ZIP</th>';
echo      '<th>City</th>';
echo      '<th>State/Province</th>';
echo      '<th>Country</th>';
echo     '<th></th>';
echo    '</tr>';
echo  '</thead>';
echo  '<tbody>';

    $sql = "SELECT * FROM company natural join address natural join company_address where company_id = '$company_id' ";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){


      echo '<tr>';
      echo '<td>'. $row['type'] . '</td>';
      echo '<td>'. $row['street'] . '</td>';
      echo '<td>'. $row['zip'] . '</td>';
      echo '<td>'. $row['city'] . '</td>';
      echo '<td>'. $row['state'] . '</td>';
      echo '<td>'. $row['country'] . '</td>';
      echo '<td>';
      echo '<a class="btnsml" href="edit_company_address.php?company_id='.$row['company_id'].'&address_id='.$row['address_id'].'">Edit</a>';
      echo ' ';
      echo '<a class="btnsml" href="delete_company_address.php?company_id='.$row['company_id'].'&address_id='.$row['address_id'].'">Delete</a>';
      echo '</td>';
      echo '</tr>';


    }
      mysqli_close($conn);


  echo '</tbody>';
  echo '</table>';
  echo '<form>';

  echo '<input type="button" value="Add new address" onclick="window.location.href=\'insert_company_address.php?company_id='.$company_id.'\'" class="btnsml"/>'
  ;
  echo '<a href="company.php" class="btnsml">Back</a>';

  echo '</form>';
  echo '</div>';

  ?>


<?php include_once('../page/footer.php'); ?>
