<?php require_once("inc/header.php"); ?> 
<?php

$conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

$id =  $_GET["id"];

$sql = "SELECT * FROM `products` WHERE id = '$id'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

?>
<?php require_once("inc/nav.php"); ?> 

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="border p-2 my-2 text-center">Edit Product</h2>
            <?php require_once("inc/errors.php"); ?>
            <?php require_once("inc/success.php"); ?>
            <form action="handelers/update_product.php?id=<?= $_GET["id"]; ?>" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $row["title"]; ?>" required>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?= $row["price"]; ?>" required>
                </div>

                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="text" class="form-control" id="rating" name="rating" value="<?= $row["rating"]; ?>" required>
                </div>

                <div class="form-group">
                    <label for="review">Review</label>
                    <textarea class="form-control" id="review" name="review" rows="3" required><?= $row["review"]; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required><?= $row["description"]; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="category_id">Image Confirm: </label>
                        <input type="text" value="<?= htmlspecialchars($row['image']); ?>" disabled>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>

                <div class="form-group">
                    <label for="category_id">Gender Confirm: </label>
                        <input type="text" value="<?= htmlspecialchars($row['gender']); ?>" disabled>
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="men" <?= $row["gender"] == 'male' ? 'selected' : ''; ?>>men</option>
                        <option value="women" <?= $row["gender"] == 'female' ? 'selected' : ''; ?>>women</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="category_id">Category Confirm: </label>
                        <?php
                        $id = $row["category_id"];
                        $sql = "SELECT `id`, `name` FROM categories WHERE id = '$id'";
                        $result = mysqli_query($conn, $sql);
                        $category = mysqli_fetch_assoc($result);
                        ?>
                        <input type="text" value="<?= htmlspecialchars($category['name']); ?>" disabled>
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

                <button type="submit" class="btn btn-primary">Update Product</button>
            </form>
        </div>
    </div>
</div>
</div>

<?php require_once("inc/scripts.php"); ?>
<?php require_once("inc/footer.php"); ?>