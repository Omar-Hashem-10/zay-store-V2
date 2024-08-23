<?php
session_start();

require_once("../../core/functions.php");

if (isset($_GET["id"]) && $_SERVER["REQUEST_METHOD"] == "GET") {
    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

    $id = $_GET["id"];

    // Query to select the product
    $sql = "SELECT * FROM `products` WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_row($result);

    if (!$row) {
        $_SESSION["errors"] = "Data does not exist";
    } else {
        // Query to delete the product
        $sql = "DELETE FROM `products` WHERE id = $id";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn)) {
            $_SESSION["success"] = "Data deleted successfully";
        }

        // Calculate the number of orders for the user in the orders table
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
    }

    mysqli_close($conn);

    redirect("../view_products.php");
}
?>
