<?php
  require_once '../conn.php';
  $person_id = "";

  if(!empty ($_GET['person_id'] )){
    $person_id = $_REQUEST['person_id'];
  }

 //    if ( $person_id == null ) {
 //    header("location: person.php");
 //    }
 //    else {
 //      $sql = "SELECT * FROM person inner join job where person_id = ?";
 //
 //      if($pstmt = mysqli_prepare($conn, $sql)){
 //        mysqli_stmt_bind_param($pstmt, 'i', $person_id);
 //      }
 //      mysqli_stmt_execute($pstmt);
 //      $row = mysqli_stmt_fetch($pstmt);
 //    }
 //    mysqli_stmt_close($pstmt);
 //
 //
 //    // $q = $pdo->prepare($sql);
 //    // $q->execute(array($id));
 //    // $data = $q->fetch(PDO::FETCH_ASSOC);
 //    // Database::disconnect();
 //
 //  }
 //  mysqli_close($conn);
 //
 // ?>

<?php include_once '../page/head.php' ?>
<h1 style="text-align: center; font-weight:bolder;">CHKD e. V. CRM System</h1>
<?php include_once '../page/menu.php' ?>
<h3 style="padding-left:15px; font-weight:bolder;">Detail information</h3>

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
        <th>Wechat account</th>
        <th>Media type</th>
        <th>Newsletter sub</th>
        <th>Magazine sub</th>
        <th>Birthday</th>
        <th>Remark</th>
        <th>Added on</th>
        <th>Address type</th>
        <th>Street</th>
        <th>City</th>
        <th>State</th>
        <th>ZIP</th>
        <th>Country</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
       $sql = "SELECT * FROM person join company join job join address join person_address on person.person_id = job.person_id AND company.company_id = job.company_id and person_address.address_id = address.address_id ANd person_address.person_id = person.person_id where person.person_id = ?";

       if ($stmt = mysqli_prepare($conn, $sql)) {
         mysqli_stmt_bind_param($stmt, "i", $person_id);
         mysqli_stmt_execute($stmt);
         $result = mysqli_stmt_get_result($stmt);
       }


       while($row = mysqli_fetch_assoc($result) or die (mysqli_error($conn))){

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
                echo '<td>'. $row['wechat']. '</td>';
                echo '<td>'. $row['media_type']. '</td>';
                echo '<td>'. $row['newsletter_sub']. '</td>';
                echo '<td>'. $row['magazine_sub']. '</td>';
                echo '<td>'. $row['birthday']. '</td>';
                echo '<td>'. $row['p_remark']. '</td>';
                echo '<td>'. $row['date_added']. '</td>';
                echo '<td>'. $row['type']. '</td>';
                echo '<td>'. $row['street']. '</td>';
                echo '<td>'. $row['city']. '</td>';
                echo '<td>'. $row['state']. '</td>';
                echo '<td>'. $row['zip']. '</td>';
                echo '<td>'. $row['country']. '</td>';
                echo '</tr>';
       }
       mysqli_close($conn);
      ?>
    </tbody>
  </table>

</div>

<?php include_once('../page/footer.php'); ?>
