<?php
session_start();
require_once '../src/config.php'; 
require_once ROOT_PATH . 'core/functions.php'; 

// Check if user is logged in and product ID is set
if (isset($_SESSION['customer_id']) && isset($_GET['id'])) {
    $user_id = $_SESSION['customer_id'];
    $product_id = intval($_GET['id']);

    // Retrieve values from the form
    $quantity = isset($_POST['product-quanity']) ? intval($_POST['product-quanity']) : 1;
    $size = isset($_POST['product-size']) ? $_POST['product-size'] : 'N/A';

    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the product is already in the cart
    $sql_check = "SELECT * FROM `cart` WHERE `user_id` = ? AND `product_id` = ? AND `size` = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("iis", $user_id, $product_id, $size);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // If the product is already in the cart, increase the quantity
        $row = $result_check->fetch_assoc();
        $new_quantity = $row['quantity'] + $quantity;

        $sql_update = "UPDATE `cart` SET `quantity` = ? WHERE `user_id` = ? AND `product_id` = ? AND `size` = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("iiis", $new_quantity, $user_id, $product_id, $size);
        $stmt_update->execute();
    } else {
        // If the product is not in the cart, add it to the cart
        $sql_insert = "INSERT INTO `cart` (`user_id`, `product_id`, `quantity`, `size`) VALUES (?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("iiis", $user_id, $product_id, $quantity, $size);
        $stmt_insert->execute();
    }

    // Count the number of distinct products in the cart
    $sql_count = "SELECT COUNT(DISTINCT `product_id`) as total_products FROM `cart` WHERE `user_id` = ?";
    $stmt_count = $conn->prepare($sql_count);
    $stmt_count->bind_param("i", $user_id);
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    $row_count = $result_count->fetch_assoc();
    $_SESSION['cart_count'] = $row_count['total_products'];

    mysqli_close($conn);

    // Redirect to the product page or cart page
    redirect(url("shop-single"));
} else {
    // Redirect if the user is not logged in or the product ID is missing
    redirect(url("login"));
}
?>
