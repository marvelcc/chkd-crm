<?php
require_once ('../conn.php');
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
<h3 style="padding-left:15px; font-weight:bolder;">Contacts</h3>
<!-- <form>
    <input type="button" value="Create new contact" onclick="window.location.href='insert_person.php'" class="btnsml" />
</form> -->

<div>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Company</th>
        <th>Department</th>
        <th>Position</th>
        <th>Priority</th>
        <th>Telephone</th>
        <th>Fax</th>
        <th>Addresses</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
       $sql = "SELECT * FROM person natural join company natural join job";
       $result = mysqli_query($conn, $sql);
       while($row = mysqli_fetch_assoc($result)){
                echo '<tr>';
                echo '<td>'. $row['first_name'] . '</td>';
                echo '<td>'. $row['last_name'] . '</td>';
                echo '<td>'. $row['p_email'] . '</td>';
                echo '<td>'. $row['mobile'] . '</td>';
                echo '<td>'. $row['name_de']. '</td>';
                echo '<td>'. $row['department']. '</td>';
                echo '<td>'. $row['position']. '</td>';
                echo '<td>'. $row['priority']. '</td>';
                echo '<td>'. $row['p_tel']. '</td>';
                echo '<td>'. $row['fax']. '</td>';
                echo '<td>';
                echo '<a class="btnsml" href="person_address.php?person_id='.$row['person_id'].'">Detail</a>';
                echo '</td>';
                echo '<td>';
                echo '<a class="btnsml" href="edit_person.php?person_id='.$row['person_id'].'">Edit</a>';
                echo ' ';
                echo '<a class="btnsml" href="delete_person.php?person_id='.$row['person_id'].'">Delete</a>';
                echo '</td>';
                echo '</tr>';
       }
       mysqli_close($conn);
      ?>
    </tbody>
  </table>
  <form>
      <input type="button" value="Create new contact" onclick="window.location.href='insert_person.php'" class="btnsml" />
  </form>

</div>
