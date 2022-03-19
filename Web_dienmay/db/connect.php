<?php
$con = new mysqli("localhost","root","","bandienmay");

// Check connection
if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $con -> connect_error;
  exit();
}

mysqli_set_charset($con,"utf8");
?>