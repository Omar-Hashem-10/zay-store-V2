<?php
require_once 'src/config.php'; 
require_once ROOT_PATH . "core/functions.php";
require_once ROOT_PATH . "inc/header.php";
require_once ROOT_PATH . "inc/nav.php";

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: " . BASE_URL . "views/login.php");
    exit;
}

$user_id = $_SESSION['customer_id'];

$conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch cart items with product details
$sql = "SELECT c.id as cart_id, p.*, c.quantity, c.size FROM `cart` c JOIN `products` p ON c.product_id = p.id WHERE c.user_id = '$user_id'";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Calculate the number of distinct products in the cart
$sql_count = "SELECT COUNT(DISTINCT `product_id`) as total_products FROM `cart` WHERE `user_id` = ?";
$stmt_count = $conn->prepare($sql_count);
$stmt_count->bind_param("i", $user_id);
$stmt_count->execute();
$result_count = $stmt_count->get_result();
$row_count = $result_count->fetch_assoc();
$_SESSION['cart_count'] = $row_count['total_products'];

mysqli_close($conn);
?>

<div class="container mt-4">
    <h2 class="text-center">Your Cart</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Product Name</th>
                <th>Size</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                <td>
                    <img src="<?php echo BASE_URL . "../public/images/products/" . htmlspecialchars($row['image']); ?>" alt="Product Image" style="width: 100px; height: auto;">
                </td>
                    <td><?= htmlspecialchars($row['title']); ?></td>
                    <td><?= htmlspecialchars($row['size']); ?></td>
                    <td>$<?= htmlspecialchars($row['price']); ?></td>
                    <td><?= htmlspecialchars($row['quantity']); ?></td>
                    <td>$<?= htmlspecialchars($row['price'] * $row['quantity']); ?></td>
                    <td>
                        <!-- Form for deleting the item -->
                        <form action="handelers/delete_item.php" method="post" style="display:inline;">
                            <input type="hidden" name="item_id" value="<?= htmlspecialchars($row['cart_id']); ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
        <div class="text-right">
        <a href="<?= url("checkout"); ?>" class="btn btn-primary">Proceed to Order</a>
    </div>
</div>

<?php require_once ROOT_PATH . 'inc/footer.php'; ?>
