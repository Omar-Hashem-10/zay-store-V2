<?php

require_once("../../core/functions.php");

// Check if the ID and status are set and valid
if (!isset($_POST["id"]) || !isset($_POST["status"]) || !is_numeric($_POST["id"])) {
    die("Invalid input.");
}

$order_id = intval($_POST["id"]);
$new_status = $_POST["status"];

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

// Check connection success
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to update the order status
$sql = "UPDATE `orders` SET status = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "si", $new_status, $order_id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Redirect or show success message
        redirect("../view_orders.php"); // Ensure that the redirect function exists and works properly
    } else {
        die("Error executing query: " . mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);
} else {
    die("Error preparing statement: " . mysqli_error($conn));
}

mysqli_close($conn);
?>
