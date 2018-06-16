<?php
require_once 'conn.php';
//User-Account neu anmelden
// Variablen mit Nullwerte definieren
$username = "";
$err_username = "";
$password = "";
$err_password = "";
$password_repeat= "";
$err_password_repeat = "";
$first_name ="";
$err_first_name="";
$last_name ="";
$err_last_name="";
$email="";
$err_email="";
$mobile="";
$err_mobile="";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Benutzername überprüfen
    if(empty(trim($_POST["username"]))){   //Leere Benutzername Fehler
        $err_username = "Username cannot be empty!";
    }
    else{
        // Prepared Statement um zu prüfen ob Benutzername schon genommen wurde
        $sql = "SELECT user_id FROM user WHERE username = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Variablen als Parameter binden
            mysqli_stmt_bind_param($stmt, 's', $param_username);

            // Parameter definieren
            $param_username = trim($_POST["username"]);

            // Prepared Statement ausführen
            if(mysqli_stmt_execute($stmt)){
               mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){         //Wenn 1 dann wurde Benutzername genommen
                    $err_username = "This username already exists!";
                }
                else{
                    $username = trim($_POST["username"]);
                }
            }
            else{
                echo "Error: Please contact admin!";
            }
        }

        mysqli_stmt_close($stmt);
    }

    // Passwort überprüfen
    if(empty(trim($_POST['password']))){
        $err_password = "Password cannot be empty!";
    }
    elseif(strlen(trim($_POST['password'])) < 8){
        $err_password = "Password should be at least 8 characters!";
    }
    else{
        $password = trim($_POST['password']);
    }

    // Passwort nochmals eingeben und überprüfen
    if(empty(trim($_POST["password_repeat"]))){
        $err_password_repeat = 'Please repeat the password!';
    }
    else{
        $password_repeat = trim($_POST['password_repeat']);

        if($password != $password_repeat){
            $err_password_repeat = 'Both password did not match. Please try again!';
        }
    }

    //Vorname Validierung
    if(empty(trim($_POST["first_name"]))){
      $err_first_name = 'Please enter your first name!';
    }
    else{
        $first_name = trim($_POST['first_name']);
    }

    //Nachname Validierung
    if(empty(trim($_POST["last_name"]))){
      $err_last_name = 'Please enter your last name!';
    }
    else{
        $last_name = trim($_POST['last_name']);
    }

    //Email Validierung
    if(empty(trim($_POST["email"]))){
      $err_email = 'Please enter your work email address!';
    }
    else{
        $email = trim($_POST['email']);
    }

    //Handynummer Validierung
    if(empty(trim($_POST["mobile"]))){
      $err_mobile = 'Please enter your mobile phone number!';
    }
    else{
        $mobile = trim($_POST['mobile']);
    }

    if(empty($err_username) && empty($err_password) && empty($err_password_repeat) && empty($err_first_name) && empty($err_last_name) && empty($err_email) && empty($err_mobile)){

        // Prepared Statement zum Einschreiben der Kontodetails
        $sql = "INSERT INTO user (first_name, last_name, email, mobile, username, password)  VALUES (?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, 'ssssss', $param_first_name, $param_last_name, $param_email, $param_mobile, $param_username, $param_password);
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            $param_mobile = $mobile;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 15px sans-serif; }
        .wrapper{ width: 300px; padding: 20px; margin-left: auto; margin-right: auto;}

        .btn {                                  /*Button style*/
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

        .btn:hover {                        /*Button hover style*/
          background: #ff0000;
          text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h3>Sign up for an account</h3>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>" accept-charset="gbk">
            <!--Username-->
            <div class="form-group <?php echo (!empty($err_username)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo "$err_username"; ?></span>
            </div>
            <!--Passwort-->
            <div class="form-group <?php echo (!empty($err_password)) ? 'has-error' : ''; ?>">
                <label> Password <sub>(*must be at least 8 characters)</sub></label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $err_password; ?></span>
            </div>
            <!--Passwort nochmals eingeben-->
            <div class="form-group <?php echo (!empty($err_password_repeat)) ? 'has-error' : ''; ?>">
                <label>Repeat Password</label>
                <input type="password" name="password_repeat" class="form-control" value="<?php echo $password_repeat; ?>">
                <span class="help-block"><?php echo $err_password_repeat; ?></span>
            </div>
            <!--Vorname-->
            <div class="form-group <?php echo (!empty($err_first_name)) ? 'has-error' : ''?>">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control "value="<?php echo $first_name; ?>">
                <span class="help-block"><?php echo $err_first_name ?></span>
            </div>
            <!--Nachname-->
            <div class="form-group <?php echo (!empty($err_last_name)) ? 'has-error' : ''?>">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control "value="<?php echo $last_name; ?>">
                <span class="help-block"><?php echo $err_last_name ?></span>
            </div>
            <!--Email-->
            <div class="form-group <?php echo (!empty($err_email)) ? 'has-error' : ''?>">
                <label>Work Email</label>
                <input type="text" name="email" class="form-control "value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $err_email ?></span>
            </div>
            <!--Mobile-->
            <div class="form-group <?php echo (!empty($err_mobile)) ? 'has-error' : ''?>">
                <label>Mobile Phone Number</label>
                <input type="text" name="mobile" class="form-control "value="<?php echo $mobile; ?>">
                <span class="help-block"><?php echo $err_mobile ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn" value="Submit">
                <input type="reset" class="btn" value="Reset">
            </div>

            <p>Already have an account? <a href="login.php">Login here</a>.</p>
          </form>
    </div>
</body>
</html>
