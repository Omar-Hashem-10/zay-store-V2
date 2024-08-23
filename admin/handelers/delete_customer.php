<?php
session_start();

require_once("../../core/functions.php");

if(isset($_GET["id"]) && $_SERVER["REQUEST_METHOD"] == "GET")
{
  $conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

  $id = $_GET["id"];

  $sql = "SELECT * FROM `users` WHERE id = $id";

  $result = mysqli_query($conn, $sql);

  $row = mysqli_fetch_row($result);

  if(!$row)
  {
    $_SESSION["errors"] = "Data is not exists";
  }else{
    $sql = "DELETE FROM `users` WHERE id = $id";

    mysqli_query($conn, $sql);
  
    if(mysqli_affected_rows($conn))
    {
      $_SESSION["success"] = "data deleted successfully";
    }
  
  }

  redirect("../profile_customer.php");
}

