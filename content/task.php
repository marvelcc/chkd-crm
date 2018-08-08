<?php

  session_start();
  include_once '../conn.php';
  $sessionname = $_SESSION['username'];
 ?>
<!-- Head -->

<?php
include_once('../page/head.php');

?>

<!-- Body -->
<h1 style="text-align: center; font-weight:bolder;">CHKD e. V. CRM System</h1>

<!-- Menü -->
<?php include_once('../page/menu.php'); ?>

<!-- Main code -->
<h3 style="padding-left:15px; font-weight:bolder;">Upcoming Tasks</h3>

<div>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Task owner</th>
        <th>Task description</th>
        <th>Task type</th>
        <th>Task target</th>
        <th>Due date</th>
        <th> </th>
      </tr>
    </thead>
    <tbody>
      <?php
       $sql = "SELECT u.username, t.task_id, CONCAT(`u_first_name`,' ', `u_last_name`) AS task_owner, task_desc, task_type, CONCAT(`first_name`,' ', `last_name`) AS target, due, tt.person_id  FROM user u JOIN user_has_task ut on u.user_id = ut.user_id JOIN task t on ut.task_id = t.task_id JOIN task_target tt on tt.task_id = t.task_id JOIN person p on p.person_id = tt.person_id WHERE t.completed='0' ORDER BY due";
       $result = mysqli_query($conn, $sql);
       while($row = mysqli_fetch_assoc($result)){
                echo '<tr>';
                echo '<td>'. $row['task_owner'] . '</td>';
                echo '<td>'. $row['task_desc'] . '</td>';
                echo '<td>'. $row['task_type'] . '</td>';
                echo '<td>'. $row['target'] . '</td>';
                echo '<td>'. $row['due']. '</td>';
                echo '<td>';
                echo '<a class="btnsml" href="edit_task.php?task_id='.$row['task_id'].'">Edit</a>';
                echo '<a class="btnsml" href="complete_task.php?task_id='.$row['task_id'].'">Completed</a>';
                echo '</td>';
                echo '</tr>';
       }

      ?>
    </tbody>
  </table>
  <form>
      <input type="button" value="Add new task" onclick="window.location.href='add_task.php'" class="btnsml"/>
  </form>
</div>
<br>
<br>
<h3 style="padding-left:15px; font-weight:bolder;">My Upcoming Tasks</h3>
<div>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Task owner</th>
        <th>Task description</th>
        <th>Task type</th>
        <th>Task target</th>
        <th>Due date</th>
      </tr>
    </thead>
    <tbody>
      <?php
       $sql3 = "SELECT t.task_id, CONCAT(`u_first_name`,' ', `u_last_name`) AS task_owner, task_desc, task_type, CONCAT(`first_name`,' ', `last_name`) AS target, due, tt.person_id  FROM user u JOIN user_has_task ut on u.user_id = ut.user_id JOIN task t on ut.task_id = t.task_id JOIN task_target tt on tt.task_id = t.task_id JOIN person p on p.person_id = tt.person_id WHERE t.completed='0' AND u.username= '$sessionname' ";
       $result3 = mysqli_query($conn, $sql3);
       while($row3 = mysqli_fetch_assoc($result3)){
                echo '<tr>';
                echo '<td>'. $row3['task_owner'] . '</td>';
                echo '<td>'. $row3['task_desc'] . '</td>';
                echo '<td>'. $row3['task_type'] . '</td>';
                echo '<td>'. $row3['target'] . '</td>';
                echo '<td>'. $row3['due']. '</td>';
                echo '</tr>';
       }

      ?>
    </tbody>
  </table>
</div>
<br>
<br>
<h3 style="padding-left:15px; font-weight:bolder;">Completed Tasks</h3>
<div>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Task owner</th>
        <th>Task description</th>
        <th>Task type</th>
        <th>Task target</th>
        <th>Due date</th>
      </tr>
    </thead>
    <tbody>
      <?php
       $sql2 = "SELECT t.task_id, CONCAT(`u_first_name`,' ', `u_last_name`) AS task_owner, task_desc, task_type, CONCAT(`first_name`,' ', `last_name`) AS target, due, tt.person_id  FROM user u JOIN user_has_task ut on u.user_id = ut.user_id JOIN task t on ut.task_id = t.task_id JOIN task_target tt on tt.task_id = t.task_id JOIN person p on p.person_id = tt.person_id WHERE t.completed='1'";
       $result2 = mysqli_query($conn, $sql2);
       while($row2 = mysqli_fetch_assoc($result2)){
                echo '<tr>';
                echo '<td>'. $row2['task_owner'] . '</td>';
                echo '<td>'. $row2['task_desc'] . '</td>';
                echo '<td>'. $row2['task_type'] . '</td>';
                echo '<td>'. $row2['target'] . '</td>';
                echo '<td>'. $row2['due']. '</td>';
                echo '</tr>';
       }
       mysqli_close($conn);
      ?>
    </tbody>
  </table>
</div>


<?php include_once('../page/footer.php'); ?>
