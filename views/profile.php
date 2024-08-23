<?php
require_once 'src/config.php'; 
require_once ROOT_PATH . "core/functions.php";
require_once ROOT_PATH . "inc/header.php";
require_once ROOT_PATH . "inc/nav.php";

$customer_id = $_SESSION['customer_id'];

$conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

// Fetch customer data from database
$sql = "SELECT * FROM `users` WHERE id = $customer_id";
$result = mysqli_query($conn, $sql);
$customer = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-header {
            background-color: #f8f9fa;
            padding: 20px;
            border-bottom: 1px solid #dee2e6;
        }
        .profile-card {
            margin: 20px auto;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }
        .profile-card img {
            border-radius: 50%;
            max-width: 120px;
            margin-bottom: 20px;
        }
        .profile-card h2 {
            margin-bottom: 20px;
        }
        .btn-edit {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header class="profile-header">
        <div class="container">
            <h1 class="text-center">Profile</h1>
        </div>
    </header>

    <main class="container">
        <div class="profile-card">
            <h2 class="text-center"><?= htmlspecialchars($customer['username']); ?></h2>
            <p><strong>Email:</strong> <?= htmlspecialchars($customer['email']); ?></p>
            <p><strong>Member since:</strong> <?= htmlspecialchars($customer['created_at']); ?></p>

            <!-- Edit profile link -->
            <div class="text-center">
                <a href="<?= BASE_URL . 'views/edit_profile.php'; ?>" class="btn btn-primary btn-edit">Edit Profile</a>
            </div>
        </div>
    </main>

    <footer>
        <?php require_once ROOT_PATH . "inc/footer.php";?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.min.js"></script>
</body>
</html>
