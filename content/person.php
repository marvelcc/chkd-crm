<?php
          require_once '../conn.php';
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
<form>
    <input type="button" value="Create new contact" onclick="window.location.href='insert_person.php'" class="btnsml" />
</form>

<div>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Company</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
       $sql = "SELECT * FROM person join company join job on person.person_id = job.person_id AND company.company_id = job.company_id";
       $result = mysqli_query($conn, $sql);
       while($row = mysqli_fetch_assoc($result)){
                echo '<tr>';
                echo '<td>'. $row['first_name'] . '</td>';
                echo '<td>'. $row['last_name'] . '</td>';
                echo '<td>'. $row['p_email'] . '</td>';
                echo '<td>'. $row['mobile'] . '</td>';
                echo '<td>'. $row['name_de']. '</td>';
                echo '<td> <a class="btnsml" href="person_detail.php?id='.$row['person_id'].'">Detail</a></td>';
                echo '</tr>';
       }
       mysqli_close($conn);
      ?>
    </tbody>
  </table>

</div>
