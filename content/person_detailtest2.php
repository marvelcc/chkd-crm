<?php
    require_once '../conn.php';
    $id="";

    if(!empty($_GET["id"])){
    $id = $_REQUEST["id"];
    }

    if ( null==$id ) {
        header("Location: person.php");
    } else {
        $sql = "SELECT * FROM person join company join job join address join person_address on person.person_id = job.person_id AND company.company_id = job.company_id and person_address.address_id = address.address_id ANd person_address.person_id = person.person_id where person.person_id = ?";
        $q = $conn->prepare($sql);
        $q->execute(array($id));
        $data = mysqli_fetch_assoc($q);
       mysqli_close($conn);
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Read a Customer</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['first_name'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['p_email'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['mobile'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="index.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
