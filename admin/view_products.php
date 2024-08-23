<?php
session_start();
require_once("../src/db.php");
require_once("inc/header.php");
require_once("inc/nav.php");

// Define the number of products per page
$products_per_page = 5;

// Get the page number from the URL parameters, defaulting to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $products_per_page;

// Query to get products with pagination using LIMIT and OFFSET
$sql = "SELECT * FROM products LIMIT ? OFFSET ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'ii', $products_per_page, $offset);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Query to get the total number of products to determine the number of pages
$sql_total = "SELECT COUNT(*) FROM products";
$result_total = mysqli_query($conn, $sql_total);
$total_products = mysqli_fetch_array($result_total)[0];
$total_pages = ceil($total_products / $products_per_page);
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="border p-2 my-2 text-center">Products</h2>
            <?php require_once("inc/success.php"); ?>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Description</th>
                        <th>Gender</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($product = mysqli_fetch_assoc($result)):
                        // Find category name using category ID
                        $category_id = $product['category_id'];
                        $sql_category = "SELECT name FROM categories WHERE id = ?";
                        $stmt_category = mysqli_prepare($conn, $sql_category);
                        mysqli_stmt_bind_param($stmt_category, 'i', $category_id);
                        mysqli_stmt_execute($stmt_category);
                        mysqli_stmt_bind_result($stmt_category, $category_name);
                        mysqli_stmt_fetch($stmt_category);
                        mysqli_stmt_close($stmt_category);
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($product["id"]); ?></td>
                        <td><?= htmlspecialchars($product["title"]); ?></td>
                        <td><?= htmlspecialchars($product["price"]); ?></td>
                        <td><?= htmlspecialchars($product["rating"]); ?></td>
                        <td><?= htmlspecialchars($product["review"]); ?></td>
                        <td><?= htmlspecialchars($product["description"]); ?></td>
                        <td><?= htmlspecialchars($product["gender"]); ?></td>
                        <td><?= htmlspecialchars($category_name); ?></td>
                        <td>
                            <a href="edit_product.php?id=<?= $product["id"]; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="handelers/delete_product.php?id=<?= $product["id"]; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <!-- Pagination links -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
</div>

<?php require_once("inc/scripts.php"); ?>
<?php require_once("inc/footer.php"); ?>
