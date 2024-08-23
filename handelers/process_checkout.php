<?php
session_start();
require_once '../src/config.php'; 
require_once ROOT_PATH . "core/functions.php";
require_once ROOT_PATH . "core/validations.php";

$errors = [];

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize input
    foreach ($_POST as $key => $value) {
        $$key = sanitize_input($value);
    }

    // Validations
    // Name: required, min: 3, max: 50
    if (required_val($name)) {
        $errors[] = "Name is required";
    } elseif (min_val($name, 3)) {
        $errors[] = "Name must be at least 3 characters long";
    } elseif (max_val($name, 50)) {
        $errors[] = "Name must not exceed 50 characters";
    }

    // Payment Method: required
    if (required_val($payment_method)) {
        $errors[] = "Payment method is required";
    }

    // Shipping Address: required
    if (required_val($shipping_address)) {
        $errors[] = "Shipping address is required";
    }

    // If there are no errors, process the form
    if (empty($errors)) {
        // Here, you can include code to handle successful form submission
        // For example, storing data in a database or redirecting the user

        // Example: Store data in session (if needed)
        $_SESSION['checkout'] = [
            'name' => $name,
            'payment_method' => $payment_method,
            'shipping_address' => $shipping_address
        ];

        // Redirect to a confirmation page or handle the data as needed
        redirect("../handelers/order-confirmation.php");
    } else {
        // If there are errors, redirect back to the form with error messages
        $_SESSION["errors"] = $errors;
        redirect(url("checkout"));
    }
} else {
    echo "Not Supported Method: " . $_SERVER["REQUEST_METHOD"];
}
?>
