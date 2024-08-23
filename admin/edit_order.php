<?php
require_once("../core/functions.php");

// Check if the ID is set and valid
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

// Query to get the current order status
$sql = "SELECT status FROM `orders` WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $order_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $order = mysqli_fetch_assoc($result);
    $current_status = $order['status'];
    mysqli_stmt_close($stmt);
} else {
    die("Error preparing statement: " . mysqli_error($conn));
}

// Close the connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order Status</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Update Order Status</h1>

        <form action="handelers/update_status.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($order_id); ?>">
            <div class="form-group">
                <label for="status">Select New Status:</label>
                <select id="status" name="status" class="form-control">
                    <option value="pending" <?php echo $current_status == 'pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="processing" <?php echo $current_status == 'processing' ? 'selected' : ''; ?>>Processing</option>
                    <option value="shipped" <?php echo $current_status == 'shipped' ? 'selected' : ''; ?>>Shipped</option>
                    <option value="delivered" <?php echo $current_status == 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                    <option value="canceled" <?php echo $current_status == 'canceled' ? 'selected' : ''; ?>>Canceled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Status</button>
        </form>
    </div>
</body>
</html>
