<?php
  require_once '../conn.php';

	if ($_POST['submit']) {
    mysqli_autocommit($conn, FALSE);

    $person_id = isset($_POST['person_id'])? $_POST['person_id'] : '';

    $sql1 = "UPDATE person SET first_name=? , last_name=? , p_email=?, mobile=?, priority=?, p_tel=?, fax=?, wechat=?, media_type=?, newsletter_sub=?, magazine_sub=?, birthday=?, p_remark=? WHERE person_id= ?";

      if($stmt1 = mysqli_prepare($conn, $sql1)){
        mysqli_stmt_bind_param($stmt1, 'sssssssssiissi', $_POST['first_name'], $_POST['last_name'], $_POST['p_email'], $_POST['mobile'], $_POST['priority'], $_POST['p_tel'], $_POST['fax'], $_POST['wechat'], $_POST['media_type'], $_POST['newsletter_sub'], $_POST['magazine_sub'], $_POST['birthday'], $_POST['p_remark'], $_POST['person_id']);

    }
    mysqli_stmt_execute($stmt1) or die(mysqli_error($conn));
    mysqli_stmt_close($stmt1);

    $sql2 = "UPDATE job SET company_id=?, department=?, position=? WHERE person_id=?";
    if($stmt2 = mysqli_prepare($conn, $sql2)){
      mysqli_stmt_bind_param($stmt2, 'issi', $_POST['name_de'], $_POST['department'], $_POST['position'], $_POST['person_id']);
    }
    mysqli_stmt_execute($stmt2) or die(mysqli_error($conn));
    mysqli_stmt_close($stmt2);


    header("location: person.php");

    mysqli_commit($conn) or mysqli_rollback($conn);
    mysqli_close($conn);
	}
  ?>
