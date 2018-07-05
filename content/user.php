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
<h3 style="padding-left:15px; font-weight:bolder;">Users</h3>

<div>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Roles</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
       $sql = "SELECT user.user_id, u_first_name, u_last_name, email, mobile, GROUP_CONCAT(role_name) FROM user join role join user_role on user.user_id = user_role.user_id AND role.role_id = user_role.role_id GROUP BY user.user_id ASC";
       $result = mysqli_query($conn, $sql);
       while($row = mysqli_fetch_assoc($result)){
                echo '<tr>';
                echo '<td>'. $row['u_first_name'] . '</td>';
                echo '<td>'. $row['u_last_name'] . '</td>';
                echo '<td>'. $row['email'] . '</td>';
                echo '<td>'. $row['mobile'] . '</td>';
                echo '<td>'. $row['GROUP_CONCAT(role_name)']. '<br><a class="btnsml" href="edit_user.php?user_id='.$row['user_id'].'">Edit</a></td>';
                echo '<td>';
                echo ' ';
                echo '<a class="btnsml" href="delete_user.php?user_id='.$row['user_id'].'">Delete</a>';
                echo '</td>';
                echo '</tr>';
       }
       mysqli_close($conn);
      ?>
    </tbody>
  </table>

</div>
