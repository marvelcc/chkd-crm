<?php include_once '../conn.php'; ?>
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

<div>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Company name</th>
        <th>Company homepage</th>
        <th>Telephone</th>
        <th>Email</th>
        <th>Member type</th>
        <th>Industry</th>
        <th>Service region</th>
        <th>Employee count</th>
        <th>Registration number</th>
        <th>Annual revenue</th>
        <th>Parent company</th>
        <th>Remark</th>
        <th>Added on</th>
        <th>Addresses</th>
        <th> </th>
      </tr>
    </thead>
    <tbody>
      <?php
       $sql = "SELECT c1.company_id, c1.name_de, c1.website, c1.c_tel, c1.c_email, c1.member_type, c1.industry, c1.service_region, c1.employee_count, c1.registration_nr, c1.annual_revenue, c1.c_remark, c1.c_date_added, c2.parent_company, c2.name_de AS 'parent'FROM company c1 left join company c2 on c2.company_id = c1.parent_company LIMIT 1, 5000";
       $result = mysqli_query($conn, $sql);
       while($row = mysqli_fetch_assoc($result)){
                echo '<tr>';
                echo '<td>'. $row['name_de'] . '</td>';
                echo '<td>'. $row['website'] . '</td>';
                echo '<td>'. $row['c_tel'] . '</td>';
                echo '<td>'. $row['c_email'] . '</td>';
                echo '<td>'. $row['member_type']. '</td>';
                echo '<td>'. $row['industry']. '</td>';
                echo '<td>'. $row['service_region']. '</td>';
                echo '<td>'. $row['employee_count']. '</td>';
                echo '<td>'. $row['registration_nr']. '</td>';
                echo '<td>'. $row['annual_revenue']. '</td>';
                echo '<td>'. $row['parent']. '</td>';
                echo '<td>'. $row['c_remark']. '</td>';
                echo '<td>'. $row['c_date_added']. '</td>';
                echo '<td>';
                echo '<a class="btnsml" href="company_address.php?company_id='.$row['company_id'].'">Detail</a>';
                echo '</td>';
                echo '<td>';
                echo '<a class="btnsml" href="edit_company.php?company_id='.$row['company_id'].'">Edit</a>';
                echo ' ';
                echo '<a class="btnsml" href="delete_company.php?company_id='.$row['company_id'].'">Delete</a>';
                echo '</td>';
                echo '</tr>';
       }
       mysqli_close($conn);
      ?>
    </tbody>
  </table>

</div>

<?php include_once('../page/footer.php'); ?>
