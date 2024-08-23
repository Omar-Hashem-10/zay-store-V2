<?php session_start(); ?>
<?php require_once("../../core/functions.php"); ?>
<?php require_once("../../core/validations.php"); ?>
<?php $errors = []; ?>

<?php

if(check_request_method("POST") )
{

  $title = sanitize_input($_POST["title"]);

  $price = sanitize_input($_POST["price"]);

  $rating = sanitize_input($_POST["rating"]);

  $review = sanitize_input($_POST["title"]);

  $description = sanitize_input($_POST["description"]);

  $image = $_FILES["image"]["name"];

  if(isset($_POST["gender"]))
  {
    $gender = sanitize_input($_POST["gender"]);
  }else{
    $gender = NULL;
  }

  $category_id = sanitize_input($_POST["category_id"]);


  if(required_val($title))
  {
    $errors[] = "Title Is Required";
  }elseif(min_val($title, 3))
  {
    $errors[] = "Title Must Be Greater Than 3 Chars";
  }
  elseif(max_val($name, 25))
  {
    $errors[] = "Title Must Be Smaller Than 25 Chars";
  }

  if(required_val($price))
  {
    $errors[] = "Price Is Required";
  }

  if(required_val($rating))
  {
    $errors[] = "Rating Is Required";
  }elseif(max_val($rating, 6))
  {
    $errors[] = "Rating Must Be Smaller Than 6 Chars";
  }

  if(required_val($review))
  {
    $errors[] = "Review Is Required";
  }

  if(required_val($description))
  {
    $errors[] = "Description Is Required";
  }elseif(min_val($description, 3))
  {
    $errors[] = "Description Must Be Greater Than 3 Chars";
  }

  if(required_val($image))
  {
    $errors[] = "Image Is Required";
  }


  if(required_val($category_id))
  {
    $errors[] = "Category Is Required";
  }

  if(empty($errors))
  {
    $conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

    $sql = "INSERT INTO `products` (`title`, `price`, `rating`, `review`, `description`, `image`, `gender`, `category_id`)
    VALUES
    (
      '$title',
      '$price',
      '$rating',
      '$review',
      '$description',
      '$image',
      '$gender',
      $category_id
    )
    ";

    mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn))
    {
      $_SESSION["success"] = "product added successfully";
    } 

    mysqli_close($conn);

    redirect("../view_products.php");
  }else{
    $_SESSION["errors"] = $errors;
    redirect("../add_product.php");
  }

}