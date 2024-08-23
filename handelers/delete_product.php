<?php
session_start();
require_once '../src/config.php'; 
require_once ROOT_PATH . "core/functions.php";

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check for delete request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $order_item_id = $_POST['order_item_id'];
    $user_id = $_SESSION['customer_id']; // Ensure user_id is set

    // Start the transaction
    mysqli_begin_transaction($conn);

    try {
        // Fetch order_id for the item to be deleted
        $sql_get_order_id = "SELECT order_id FROM `order_items` WHERE id = ?";
        $stmt_get_order_id = $conn->prepare($sql_get_order_id);
        $stmt_get_order_id->bind_param("i", $order_item_id);
        $stmt_get_order_id->execute();
        $result_get_order_id = $stmt_get_order_id->get_result();

        // Check if results are found
        if ($result_get_order_id->num_rows > 0) {
            $row = $result_get_order_id->fetch_assoc();
            $order_id = $row['order_id'];

            // Delete the item from order_items
            $sql_delete_item = "DELETE FROM `order_items` WHERE id = ?";
            $stmt_delete_item = $conn->prepare($sql_delete_item);
            $stmt_delete_item->bind_param("i", $order_item_id);
            $stmt_delete_item->execute();

            // Check if there are other items left in the same order_id
            $sql_check_items = "SELECT COUNT(*) AS count FROM `order_items` WHERE order_id = ?";
            $stmt_check_items = $conn->prepare($sql_check_items);
            $stmt_check_items->bind_param("i", $order_id);
            $stmt_check_items->execute();
            $result_check_items = $stmt_check_items->get_result();
            $row_check_items = $result_check_items->fetch_assoc();

            if ($row_check_items['count'] == 0) {
                // If no other items left, delete the order from orders
                $sql_delete_order = "DELETE FROM `orders` WHERE id = ?";
                $stmt_delete_order = $conn->prepare($sql_delete_order);
                $stmt_delete_order->bind_param("i", $order_id);
                $stmt_delete_order->execute();
            }

            // Count the number of orders for the user in the orders table
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

            // Redirect the user after deletion
            redirect(url("order"));
        } else {
            echo "Order item not found.";
        }
    } catch (Exception $e) {
        // If an error occurs, rollback the transaction
        mysqli_rollback($conn);
        echo "Failed to process request: " . $e->getMessage();
    }

    mysqli_close($conn);
}
?>
