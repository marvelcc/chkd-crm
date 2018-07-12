<?php
  require_once '../conn.php';
if (empty(trim($_POST['name_de']))) {
  echo "Please check your input!";
  mysqli_rollback($conn);
	}
  else {
    if ($_POST['submit']) {

      $company_id = isset($_POST['company_id'])? $_POST['company_id'] : '';
      $sql2 = "SELECT company_id FROM company where company_id <> ? AND name_de = ?";
      if ($stmt2 =mysqli_prepare($conn, $sql2)) {
        mysqli_stmt_bind_param($stmt2, 'is', $company_id, $param_name_de);
        $param_name_de  =trim($_POST['name_de']);
        if (mysqli_stmt_execute($stmt2)) {
          mysqli_stmt_store_result($stmt2);
          if (mysqli_stmt_num_rows($stmt2)==1) {
            echo "This company name already exists in the system!";
            mysqli_rollback($conn);
          }
          else {
            $sql = "UPDATE company SET name_de=?, website=?, c_tel=?, c_email=?, service_region=?, employee_count=?, registration_nr=?, annual_revenue=?, member_type=?, industry=?, c_remark=?, parent_company=? WHERE company_id= ?";

            if($stmt = mysqli_prepare($conn, $sql)){
                mysqli_stmt_bind_param($stmt, 'ssssssssssssi', $_POST['name_de'], $_POST['website'], $_POST['c_tel'], $_POST['c_email'], $_POST['service_region'], $_POST['employee_count'], $_POST['registration_nr'], $_POST['annual_revenue'], $_POST['member_type'], $_POST['industry'], $_POST['c_remark'], $_POST['parent_company'], $_POST['company_id']);

                if(mysqli_stmt_execute($stmt)){
                  header("location: company.php");
                }
                else{
                  echo "Update failed!".mysqli_error($conn);
                }
                      mysqli_stmt_close($stmt);
          }
        }
      }

      }



  	}
  }
  ?>
