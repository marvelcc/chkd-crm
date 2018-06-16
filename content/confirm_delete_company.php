<?php
  require_once '../conn.php';

	if ($_POST['delete']) {

    $company_id = isset($_POST['company_id'])? $_POST['company_id'] : '';


    $sql1 = "DELETE c, a, ca
             FROM company c join company_address ca on c.company_id = ca.company_id
                            join address a on a.address_id = ca.address_id
             WHERE c.company_id = {$company_id}";

    if(mysqli_query($conn, $sql1)){
        header("location: company.php");
      }
      else{
        die("Update failed".mysqli_error());
      }
  	}
    ?>
