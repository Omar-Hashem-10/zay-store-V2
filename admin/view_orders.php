<?php
require_once '../src/config.php'; 
require_once ROOT_PATH . "core/functions.php";
require_once("inc/header.php");
require_once("inc/nav.php");

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve all orders with their details
$sql = "
    SELECT o.id AS order_id, o.user_id, u.username AS customer_name, o.order_date, o.total_amount, o.status
    FROM orders o
    JOIN users u ON o.user_id = u.id
    ORDER BY o.order_date DESC
";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-4">
    <h2 class="text-center">Order Management</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($order = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($order['order_id']); ?></td>
                    <td><?= htmlspecialchars($order['user_id']); ?></td>
                    <td><?= htmlspecialchars($order['customer_name']); ?></td>
                    <td><?= htmlspecialchars($order['order_date']); ?></td>
                    <td><?= htmlspecialchars($order['total_amount']); ?></td>
                    <td><?= htmlspecialchars($order['status']); ?></td>
                    <td>
                        <a href="view_order_product.php?id=<?= htmlspecialchars($order['order_id']); ?>" class="btn btn-info btn-sm">View</a>
                        <a href="edit_order.php?id=<?= htmlspecialchars($order['order_id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="handelers/delete_order.php?id=<?= htmlspecialchars($order['order_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</div>

<?php
mysqli_close($conn);
require_once("inc/scripts.php"); 
require_once("inc/footer.php"); 
?>
