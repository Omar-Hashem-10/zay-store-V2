<?php

require_once("../../core/functions.php");

// Check if the ID is present and valid
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("Invalid order ID.");
}

$order_id = intval($_GET["id"]);

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

// Check connection success
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to delete the row
$sql = "DELETE FROM `orders` WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $order_id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        redirect("../view_orders.php");
    } else {
        die("Error executing query: " . mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);
} else {
    die("Error preparing statement: " . mysqli_error($conn));
}

mysqli_close($conn);
?>
