<?php 
session_start(); 
require_once("../../core/functions.php"); 
require_once("../../core/validations.php"); 
$errors = []; 

if (check_request_method("POST")) {

    $product_id = intval($_GET["id"]);
    $title = sanitize_input($_POST["title"]);
    $price = sanitize_input($_POST["price"]);
    $rating = sanitize_input($_POST["rating"]);
    $review = sanitize_input($_POST["review"]);
    $description = sanitize_input($_POST["description"]);
    $gender = sanitize_input($_POST["gender"]);
    $category_id = $_POST["category_id"];
    $image = $_FILES["image"]["name"];

    if (required_val($title)) {
        $errors[] = "Title Is Required";
    } elseif (min_val($title, 3)) {
        $errors[] = "Title Must Be Greater Than 3 Chars";
    } elseif (max_val($title, 25)) {
        $errors[] = "Title Must Be Smaller Than 25 Chars";
    }

    if (required_val($price)) {
        $errors[] = "Price Is Required";
    }

    if (required_val($rating)) {
        $errors[] = "Rating Is Required";
    } elseif (max_val($rating, 6)) {
        $errors[] = "Rating Must Be Smaller Than 6 Chars";
    }

    if (required_val($review)) {
        $errors[] = "Review Is Required";
    }

    if (required_val($description)) {
        $errors[] = "Description Is Required";
    } elseif (min_val($description, 3)) {
        $errors[] = "Description Must Be Greater Than 3 Chars";
    }

    if (required_val($gender)) {
        $errors[] = "Gender Is Required";
    }

    if (required_val($category_id)) {
        $errors[] = "Category Is Required";
    }

    if(empty($errors))
    {
      $conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

      $sql = "UPDATE `products` SET 
      `title` = '$title', 
      `price` = '$price', 
      `rating` = '$rating', 
      `review` = '$review', 
      `description` = '$description', 
      `image` = '$image',   
      `gender` = '$gender', 
      `category_id` = $category_id
      WHERE `id` = $product_id";

      mysqli_query($conn, $sql);

      if(mysqli_affected_rows($conn))
      {
        $_SESSION["success"] = "product updated successfully";
      }
      mysqli_close($conn);
      redirect("../view_products.php");
    }else{
      $_SESSION["errors"] = $errors;
      redirect("../edit_product.php?id=" . $product_id);
    }

  }