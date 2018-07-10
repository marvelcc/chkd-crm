<?php
  require_once '../conn.php';

	if ($_POST['submit']) {

    $company_id = isset($_POST['company_id'])? $_POST['company_id'] : '';

    $sql = "UPDATE company SET name_de=?, website=?, c_tel=?, c_email=?, service_region=?, employee_count=?, registration_nr=?, annual_revenue=?, member_type=?, industry=?, c_remark=?, parent_company=? WHERE company_id= ?";

    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, 'ssssssssssssi', $_POST['name_de'], $_POST['website'], $_POST['c_tel'], $_POST['c_email'], $_POST['service_region'], $_POST['employee_count'], $_POST['registration_nr'], $_POST['annual_revenue'], $_POST['member_type'], $_POST['industry'], $_POST['c_remark'], $_POST['parent_company'], $_POST['company_id']);

    }

		if(mysqli_stmt_execute($stmt)){
      header("location: company.php");
    }
    else{
      die("Update failed".mysqli_error());
    }
    mysqli_stmt_close($stmt);
	}
  ?>
