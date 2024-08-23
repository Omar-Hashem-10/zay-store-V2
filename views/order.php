<?php
require_once 'src/config.php'; 
require_once ROOT_PATH . "core/functions.php";
require_once ROOT_PATH . "inc/header.php";
require_once ROOT_PATH . "inc/nav.php";

// الاتصال بقاعدة البيانات
$conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// الحصول على جميع المنتجات الخاصة بالمستخدم
$user_id = $_SESSION['customer_id'];
$sql = "SELECT p.title, p.price, oi.quantity, (oi.quantity * oi.price) AS total, oi.size, o.order_date, p.image, o.status, oi.id AS order_item_id
        FROM `order_items` oi 
        JOIN `products` p ON oi.product_id = p.id 
        JOIN `orders` o ON oi.order_id = o.id
        WHERE o.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id); // استبدال ? بمعرف المستخدم
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "No products found for this user.";
}

mysqli_close($conn);
?>

<div class="container mt-4">
    <h2 class="text-center">All Products Ordered by You</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Size</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <?php 
                        $image_path = BASE_URL . "public/images/products/" . htmlspecialchars($row['image']);
                        ?>
                        <img src="<?= $image_path; ?>" alt="Product Image" style="width: 100px; height: auto;">
                    </td>
                    <td><?= htmlspecialchars($row['title']); ?></td>
                    <td><?= htmlspecialchars($row['price']); ?></td>
                    <td><?= htmlspecialchars($row['quantity']); ?></td>
                    <td><?= htmlspecialchars($row['size']) ?: 'N/A'; ?></td>
                    <td><?= htmlspecialchars($row['total']); ?></td>
                    <td><?= htmlspecialchars($row['order_date']); ?></td>
                    <td><?= htmlspecialchars($row['status']); ?></td>
                    <td>
                        <form method="POST" action="../handelers/delete_product.php">
                        <input type="hidden" name="order_item_id" value="<?= htmlspecialchars($row['order_item_id']); ?>" />
                        <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require_once ROOT_PATH . "inc/footer.php"; ?>
