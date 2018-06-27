<?php
  require_once('../conn.php');

  $person_id = isset($_GET['person_id'])? $_GET['person_id'] : '';

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

    $sql = "SELECT * FROM person natural join address natural join person_address where person_id = '$person_id' ";
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
      echo '<a class="btnsml" href="edit_person_address.php?person_id='.$row['person_id'].'&address_id='.$row['address_id'].'">Edit</a>';
      echo ' ';
      echo '<a class="btnsml" href="delete_person_address.php?person_id='.$row['person_id'].'&address_id='.$row['address_id'].'">Delete</a>';
      echo '</td>';
      echo '</tr>';


    }
      mysqli_close($conn);


  echo '</tbody>';
  echo '</table>';
  echo '<form>';

  echo '<input type="button" value="Add new address" onclick="window.location.href=\'insert_person_address.php?person_id='.$person_id.'\'" class="btnsml"/>'
  ;

  echo '</form>';
  echo '</div>';

  ?>


<?php include_once('../page/footer.php'); ?>
