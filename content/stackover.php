<?php
  require_once("../conn.php");

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $tel = $_POST["tel"];
    $street = $_POST["street"];
    $city = $_POST["city"];

    $sql1 = "INSERT INTO person (name, tel)
             VALUES (?, ?)";
    if ($stmt1 = mysqli_prepare($conn, $sql1)) {
      mysqli_stmt_bind_param()
    }
    $result1 = mysqli_query($conn, $sql1);
    while ($row=mysqli_fetch_row($result1)){
      $person_id = $row[0];
    }

    $sql2 = "INSERT INTO address (street, city)
             VALUES ($_POST["street"], $_POST["city"])";
    $result2 = mysqli_query($conn, $sql2);
    while ($row=mysqli_fetch_row($result2)){
      $address_id = $row[0];
    }

    $sql3 = "INSERT INTO person_address VALUES ($person_id, $address_id)";

 ?>
<!--HTML...-->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>" method="post">
  <input type="text" name="name">
  <br>
  <input type="text" name="tel">
  <br>
  <input type="text" name="street">
  <br>
  <input type="text" name="city">
  <br>
  <input type="submit" value="Create">
</form>
<!--footer-->
