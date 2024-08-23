<?php
session_start();
require_once '../src/config.php'; 
require_once ROOT_PATH . "core/functions.php";

if (!isset($_SESSION['customer_id'])) {
    header("Location: " . BASE_URL . "views/login.php");
    exit;
}

if (!isset($_SESSION['checkout'])) {
    die("Checkout details not found.");
}

$user_id = $_SESSION['customer_id'];
$checkout = $_SESSION['checkout'];

$conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start transaction
mysqli_begin_transaction($conn);

try {
    // Calculate the total amount of the order
    $sql_total = "SELECT SUM(p.price * c.quantity) AS total_amount FROM `cart` c 
                    JOIN `products` p ON c.product_id = p.id 
                    WHERE c.user_id = ?";
    $stmt_total = $conn->prepare($sql_total);
    $stmt_total->bind_param("i", $user_id);
    $stmt_total->execute();
    $result_total = $stmt_total->get_result();
    $row_total = $result_total->fetch_assoc();
    $total_amount = $row_total['total_amount'];

    // Insert the order into the orders table
    $sql_order = "INSERT INTO `orders` (`user_id`, `total_amount`, `payment_method`, `shipping_address`) VALUES (?, ?, ?, ?)";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->bind_param("idss", $user_id, $total_amount, $checkout['payment_method'], $checkout['shipping_address']);
    $stmt_order->execute();

    // Get the new order ID
    $order_id = $conn->insert_id;

    // Insert order details into the order_items table
    $sql_items = "INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`, `price`, `size`) 
                SELECT ?, c.product_id, c.quantity, p.price, c.size 
                FROM `cart` c 
                JOIN `products` p ON c.product_id = p.id 
                WHERE c.user_id = ?";
    $stmt_items = $conn->prepare($sql_items);
    $stmt_items->bind_param("ii", $order_id, $user_id);
    $stmt_items->execute();

    // Delete items from the cart
    $sql_delete_cart = "DELETE FROM `cart` WHERE `user_id` = ?";
    $stmt_delete_cart = $conn->prepare($sql_delete_cart);
    $stmt_delete_cart->bind_param("i", $user_id);
    $stmt_delete_cart->execute();

    // Count the number of orders for the user
    $sql_count_orders = "SELECT COUNT(*) AS order_count FROM `orders` WHERE user_id = ?";
    $stmt_count_orders = $conn->prepare($sql_count_orders);
    $stmt_count_orders->bind_param("i", $user_id);
    $stmt_count_orders->execute();
    $result_count_orders = $stmt_count_orders->get_result();
    $row_count_orders = $result_count_orders->fetch_assoc();
    $total_orders = $row_count_orders['order_count'];

    // Store the number of orders in the session
    $_SESSION["order_count"] = $total_orders;

    // Commit the transaction
    mysqli_commit($conn);

    // Count the number of products in the cart
    $sql_count = "SELECT COUNT(DISTINCT `product_id`) as total_products FROM `cart` WHERE `user_id` = ?";
    $stmt_count = $conn->prepare($sql_count);
    $stmt_count->bind_param("i", $user_id);
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    $row_count = $result_count->fetch_assoc();
    $_SESSION['cart_count'] = $row_count['total_products'];

    mysqli_close($conn);

    // Clear the session checkout data
    unset($_SESSION['checkout']);
    redirect(url("cart"));
} catch (Exception $e) {
    // If an error occurs, rollback the transaction
    mysqli_rollback($conn);
    echo "Failed to process order: " . $e->getMessage();
}

?>
