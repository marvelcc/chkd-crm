<?php
  require_once '../conn.php';

	if ($_POST['delete']) {

    $person_id = isset($_POST['person_id'])? $_POST['person_id'] : '';


    $sql1 = "DELETE p, j, a, pa
             FROM person p join job j on p.person_id = j.person_id
                           join person_address pa on pa.person_id = p.person_id
                           join address a on a.address_id = pa.address_id
             WHERE p.person_id = {$person_id}";

    if(mysqli_query($conn, $sql1)){
        header("location: person.php");
      }
      else{
        die("Update failed".mysqli_error());
      }
  	}
    ?>
