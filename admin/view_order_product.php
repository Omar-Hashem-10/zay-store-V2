<?php
require_once '../src/config.php'; 
require_once ROOT_PATH . "core/functions.php";
require_once("inc/header.php");
require_once("inc/nav.php");

// Validate and retrieve the order ID
$order_id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

// Prepare and execute the SQL query
$sql_items = "
    SELECT p.title, oi.quantity, oi.price, oi.size
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = ?
";
$stmt = $conn->prepare($sql_items);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result_items = $stmt->get_result();
?>

<div class="container">
    <h1 class="text-center">Product Details for Order Number <?php echo htmlspecialchars($order_id); ?></h1>

    <?php if ($result_items->num_rows > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Size</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_items->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                        <td>$<?php echo htmlspecialchars($row['price']); ?></td>
                        <td>$<?php echo htmlspecialchars($row['price'] * $row['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($row['size']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No products found for this order.</p>
    <?php endif; ?>

    <?php $stmt->close(); ?>
    <?php $conn->close(); ?>
</div>
</div>

<?php require_once("inc/scripts.php"); ?>
<?php require_once("inc/footer.php"); ?>
