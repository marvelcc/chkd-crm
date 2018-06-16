<?php
  require_once '../conn.php';

	if ($_POST['submit']) {

    $person_id = isset($_POST['person_id'])? $_POST['person_id'] : '';

    $sql = "UPDATE person natural join company natural join job natural join address natural join person_address SET first_name=? , last_name=? , p_email=?, mobile=?, name_de=?, department=?, position=?, priority=?, p_tel=?, fax=?, wechat=?, media_type=?, newsletter_sub=?, magazine_sub=?, birthday=?, p_remark=?, type=?  WHERE person_id= ?";

      if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, 'ssssssssssssiisssi', $_POST['first_name'], $_POST['last_name'], $_POST['p_email'], $_POST['mobile'], $_POST['name_de'], $_POST['department'], $_POST['position'], $_POST['priority'], $_POST['p_tel'], $_POST['fax'], $_POST['wechat'], $_POST['media_type'], $_POST['newsletter_sub'], $_POST['magazine_sub'], $_POST['birthday'], $_POST['p_remark'], $_POST['type'], $_POST['person_id']);

    }

		if(mysqli_stmt_execute($stmt)){
      header("location: person.php");
    }
    else{
      die("Update failed".mysqli_error());
    }
    mysqli_stmt_close($stmt);
	}
  ?>
