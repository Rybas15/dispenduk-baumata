<?php 
$conn=mysqli_connect("localhost","root","","dispenduk_baumata");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
