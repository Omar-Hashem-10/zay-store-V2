<?php
session_start();
include_once("../../core/functions.php");
$conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

$name = $_POST["name"];

$email = $_POST["email"];

$id = $_GET["id"];

$sql = "SELECT * FROM `users` WHERE id = $id";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_row($result);

if(!$row)
{
  $_SESSION["errors"] = "Data is not exists";
}else{
  $sql = "UPDATE `users` SET `username` = '$name', email = '$email' WHERE id = $id";

  mysqli_query($conn, $sql);
  
  if(mysqli_affected_rows($conn))
  {
    $_SESSION["success"] = "data updated successfully";
  }
}

redirect("../profile_admin.php");