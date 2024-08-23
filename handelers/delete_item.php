<?php

session_start();
require_once '../src/config.php'; 
require_once ROOT_PATH . "core/functions.php";

// Check if user is logged in and set user_id
if (!isset($_SESSION['customer_id'])) {
    redirect(url("login")); // Or redirect to another appropriate page
    exit;
}
$user_id = $_SESSION['customer_id'];

// Retrieve item_id from the form
$item_id = $_POST["item_id"] ?? null;

if ($item_id) {
    $conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Start the transaction
    mysqli_begin_transaction($conn);

    try {
        // Delete the item from the cart
        $sql_delete = "DELETE FROM `cart` WHERE id = ? AND user_id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("ii", $item_id, $user_id);
        $stmt_delete->execute();

        // Check if the deletion was successful
        if ($stmt_delete->affected_rows > 0) {
            // Count the number of distinct products in the cart
            $sql_count = "SELECT COUNT(DISTINCT `product_id`) as total_products FROM `cart` WHERE `user_id` = ?";
            $stmt_count = $conn->prepare($sql_count);
            $stmt_count->bind_param("i", $user_id);
            $stmt_count->execute();
            $result_count = $stmt_count->get_result();
            $row_count = $result_count->fetch_assoc();
            $_SESSION['cart_count'] = $row_count['total_products'];

            // Commit the transaction
            mysqli_commit($conn);
        } else {
            echo "Item not found or already removed.";
        }
    } catch (Exception $e) {
        // If an error occurs, rollback the transaction
        mysqli_rollback($conn);
        echo "Failed to delete item: " . $e->getMessage();
    }

    mysqli_close($conn);
    
    redirect(url("cart")); // Ensure the redirect() function and url() are correctly implemented
} else {
    echo "Invalid item ID.";
}
?>
