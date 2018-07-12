<?php
require_once 'conn.php';

$username = "";
$password = "";
$err_username = "";
$err_password = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $err_username = 'Please enter your username!';
    }
    else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST['password']))){
        $err_password = 'Please enter your password!';
    }
    else{
        $password = trim($_POST['password']);
    }

    if(empty($err_username) && empty($err_password)){
        $sql = "SELECT username, password FROM user WHERE username = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
           mysqli_stmt_bind_param($stmt, 's', $param_username);
            $param_username = $username;
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION['username'] = $username;
                            header("location: ../content/task.php");      // Change welcome.php to homepage of CRM
                        }
                        else{
                            $err_password = 'The password is incorect!';
                        }
                    }
                }
                else{
                    $err_username = 'Username is invalid!';
                }
            }
            else{
                echo "Error: Please contact admin!";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <style type="text/css">
        body{ font: 15px sans-serif; }
        .wrapper{ width: 300px; padding: 20px; margin-left: auto; margin-right: auto;}
        .btn {
          -webkit-border-radius: 10;
          -moz-border-radius: 10;
          border-radius: 10px;
          font-family: Arial;
          color: #ffffff;
          font-size: 20px;
          background: #f03c3c;
          padding: 10px 20px 10px 20px;
          text-decoration: none;
        }

        .btn:hover {
          background: #ff0000;
          text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" accept-charset="gbk">
            <div class="form-group <?php echo (!empty($err_username)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $err_username; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($err_password)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $err_password; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Login">
            </div>
            <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>
