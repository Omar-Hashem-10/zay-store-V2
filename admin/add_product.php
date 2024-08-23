<?php
session_start();
require_once("../src/db.php");
require_once("inc/header.php");
require_once("inc/nav.php");
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="border p-2 my-2 text-center">Add Product</h2>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="handelers/add_product.php" method="POST" enctype="multipart/form-data">
            <?php require_once("inc/errors.php") ?>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="number" class="form-control" id="rating" name="rating" step="0.1" required>
                </div>
                <div class="form-group">
                    <label for="review">Review</label>
                    <textarea class="form-control" id="review" name="review" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" >
                        <option value="">Select Gender</option>
                        <option value="men">men</option>
                        <option value="men">women</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="">Select Category</option>
                        <?php
                        $sql = "SELECT id, name FROM categories";
                        $result = mysqli_query($conn, $sql);
                        while ($category = mysqli_fetch_assoc($result)):
                        ?>
                        <option value="<?= $category['id']; ?>"><?= htmlspecialchars($category['name']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>
</div>
</div>

<?php require_once("inc/scripts.php"); ?>
<?php require_once("inc/footer.php"); ?>