<?php 
session_start(); 
require_once '../src/config.php'; 
require_once ROOT_PATH . "core/functions.php"; 
require_once ROOT_PATH . "core/validations.php"; 
$errors = []; 

if(check_request_method("POST"))
{

  $name = sanitize_input($_POST["name"]);

  $email = sanitize_input($_POST["email"]);

  $subject = sanitize_input($_POST["subject"]);

  $message = sanitize_input($_POST["message"]);

  $customer_id = $_SESSION["customer_id"];

  if(required_val($name))
  {
    $errors[] = "Name Is Required";
  }elseif(min_val($name, 3))
  {
    $errors[] = "Name Must Be Greater Than 3 Chars";
  }elseif(max_val($name, 25))
  {
    $errors[] = "Name Must Be Smaller Than 25 Chars";
  }

  if(required_val($email))
  {
    $errors[] = "Email Is Required";
  } 

  if(required_val($subject))
  {
    $errors[] = "Subject Is Required";
  } 

  if(required_val($message))
  {
    $errors[] = "Message Is Required";
  } 

  if(empty($errors))
  {
  $conn = mysqli_connect("localhost", "root", "", "zay-store-v2");
  $sql = "INSERT INTO `contact` (`name`, `email`, `subject`, `message`, `customer_id`)
  VALUES
    (
      '$name',
      '$email',
      '$subject',
      '$message',
      '$customer_id'
    )
  ";

  mysqli_query($conn, $sql);

  if(mysqli_affected_rows($conn))
  {
    $_SESSION["success"] = "data send successfully";
  } 

  mysqli_close($conn);

  redirect(url('contact'));

}else{
  $_SESSION["errors"] = $errors;

  redirect(url('contact'));
}

}