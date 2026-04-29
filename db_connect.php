<?php
$host = "localhost";
$user = "root"; // default for XAMPP
$pass = "";
$dbname = "agropark";

//create connection
$conn = new mysqli($host, $user, $pass, $dbname);

//check connection
if ($conn->connect_error) {
  die("Connection failed: " .htmlspecialchars( $conn->connect_error));
}
//set charset (important for special characters and utf-8), create a  secure reusable DB connection , handles encoding (UTF-8), stops the whole script if connection fails
$conn->set_charset("utf8mb4");
?>
