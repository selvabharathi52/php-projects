 <?php

$hostName ="localhost";
$dbuser = "root";
$dbPassword = "";
$dbName = "login-register";
$conn = mysqli_connect($hostName, $dbuser, $dbPassword, $dbName,3308);
 if (!$conn) {
 die("Something went wrong; ");
}

 ?>