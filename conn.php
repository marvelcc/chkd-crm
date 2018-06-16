<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chkdcrm";


// Verbindung aufbauen
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verbindung überprüfen
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
