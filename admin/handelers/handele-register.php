<?php session_start(); ?>
<?php require_once("../../core/functions.php"); ?>
<?php require_once("../../core/validations.php"); ?>
<?php $errors = []; ?>

<?php
if(check_request_method("POST") && check_post_input("username") && check_post_input("email") && check_post_input("password"))
{
  $name = sanitize_input($_POST["username"]);

  $email = sanitize_input($_POST["email"]);

  $password = sanitize_input($_POST["password"]);

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
  }elseif(email_val($email))
  {
    $errors[] = "Please Type A Valid Email";
  }

  if(required_val($password))
  {
    $errors[] = "Password Is Required";
  }elseif(min_val($password, 3))
  {
    $errors[] = "Password Must Be Greater Than 3 Chars";
  }elseif(max_val($password, 20))
  {
    $errors[] = "Password Must Be Smaller Than 20 Chars";
  }

  if(empty($errors))
  {
    $conn = mysqli_connect("localhost", "root", "", "zay-store-v2");
    $sql = "INSERT INTO `users` (`username`, `password`, `email`, `role`)
    VALUES
    (
      '$name',
      '$password',
      '$email',
      'admin'
    )
    ";
    mysqli_query($conn, $sql);
    if(mysqli_affected_rows($conn))
    {
      $_SESSION["success"] = "admin added successfully";
    }
    redirect("../profile_admin.php");
    mysqli_close($conn);
  }else{
    $_SESSION["errors"] = $errors;
    redirect("../register.php");
  }
}

