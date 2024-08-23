<?php 
session_start(); 
require_once '../src/config.php'; 
require_once("../core/functions.php"); 
require_once("../core/validations.php"); 

$errors = []; 

// Check if the request method is POST and the necessary inputs are provided
if (check_request_method("POST") && check_post_input("email") && check_post_input("password")) {
    // Sanitize the input to prevent SQL injection and XSS attacks
    $email = sanitize_input($_POST["email"]);
    $password = sanitize_input($_POST["password"]);

    // Validate email input
    if (required_val($email)) {
        $errors[] = "Email Is Required";
    } elseif (email_val($email)) {
        $errors[] = "Please Type A Valid Email";
    }

    // Validate password input
    if (required_val($password)) {
        $errors[] = "Password Is Required";
    } elseif (min_val($password, 3)) {
        $errors[] = "Password Must Be Greater Than 3 Chars";
    } elseif (max_val($password, 20)) {
        $errors[] = "Password Must Be Smaller Than 20 Chars";
    }

    // If no validation errors, proceed to database operations
    if (empty($errors)) {
        $conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

        // Check for successful database connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare the SQL statement to fetch user information based on the provided email
        $sql = "SELECT `id`, `email`, `password`, `role` FROM `users` WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind the email parameter and execute the query
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if the email exists in the database
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Check if the provided password matches the stored password
                if ($password == $row["password"]) { 
                    // Save user ID in session and redirect based on the role
                    if ($row["role"] == "admin") {
                        $_SESSION['admin_id'] = $row['id'];
                        redirect("../admin/index.php");
                    } else {
                        $_SESSION['customer_id'] = $row['id'];
                        $_SESSION["insert"] = "good";
                        redirect(url("home"));
                    }
                } else {
                    // If password does not match, store an error message and redirect to login
                    $_SESSION["errors"] = ["Invalid Email or Password"];
                    redirect(url("login"));
                }
            } else {
                // If email is not found, store an error message and redirect to login
                $_SESSION["errors"] = ["Invalid Email or Password"];
                redirect(url("login"));
            }

            // Close the statement
            $stmt->close();
        } else {
            // If statement preparation fails, output an error
            die("Statement preparation failed: " . $conn->error);
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        // If there are validation errors, store them in session and redirect to login
        $_SESSION["errors"] = $errors;
        redirect(url("login"));
    }
}
?>
