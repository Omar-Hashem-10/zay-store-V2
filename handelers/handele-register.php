<?php
session_start();
require_once '../src/config.php'; 
require_once("../core/functions.php");
require_once("../core/validations.php");
$errors = [];

// Check if the request method is POST and required fields are present
if (check_request_method("POST") && check_post_input("username") && check_post_input("email") && check_post_input("password")) {
    $name = sanitize_input($_POST["username"]);
    $email = sanitize_input($_POST["email"]);
    $password = sanitize_input($_POST["password"]);

    // Validate the inputs
    if (required_val($name)) {
        $errors[] = "Name Is Required";
    } elseif (min_val($name, 3)) {
        $errors[] = "Name Must Be Greater Than 3 Chars";
    } elseif (max_val($name, 25)) {
        $errors[] = "Name Must Be Smaller Than 25 Chars";
    }

    if (required_val($email)) {
        $errors[] = "Email Is Required";
    } elseif (email_val($email)) {
        $errors[] = "Please Type A Valid Email";
    }

    if (required_val($password)) {
        $errors[] = "Password Is Required";
    } elseif (min_val($password, 3)) {
        $errors[] = "Password Must Be Greater Than 3 Chars";
    } elseif (max_val($password, 20)) {
        $errors[] = "Password Must Be Smaller Than 20 Chars";
    }

    if (empty($errors)) {
        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare the SQL query to insert the user
        $sql = "INSERT INTO `users` (`username`, `password`, `email`) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $password, $email);
        $stmt->execute();

        // Get the last inserted ID (user ID)
        $user_id = $stmt->insert_id;

        // Close the database connection
        mysqli_close($conn);

        // Store the user ID in the session
        $_SESSION["customer_id"] = $user_id;
        $_SESSION["insert"] = "good";
        redirect(url("home"));
    } else {
        $_SESSION["errors"] = $errors;
        redirect("../register.php");
    }
}
?>
