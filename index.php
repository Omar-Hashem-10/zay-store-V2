<?php
session_start(); // Make sure to start the session at the top of the page

require_once 'src/config.php'; 
require_once ROOT_PATH . 'core/functions.php'; 

// Check session status
if (!isset($_SESSION["insert"])) {
    // If the session is not active, display only the welcome page
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Zay-Store</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            .container {
                background-color: #fff;
                padding: 40px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center;
                width: 100%;
                max-width: 400px;
                box-sizing: border-box;
            }

            .logo {
                margin-bottom: 30px;
                color: #333;
                font-size: 36px; /* Increase font size */
            }

            .logo .text-success {
                color: #28a745; /* Color the word Zay in green */
            }

            .btn {
                display: block;
                width: 80%;
                padding: 15px;
                margin: 15px auto;
                background-color: #007bff;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            .btn:hover {
                background-color: #0056b3;
            }

            .btn-secondary {
                background-color: #6c757d;
            }

            .btn-secondary:hover {
                background-color: #5a6268;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1 class="logo">Welcome to <span class="text-success">Zay</span></h1>
            <a href="login.php" class="btn">Login</a>
            <a href="register.php" class="btn btn-secondary">Register</a>
        </div>
    </body>
    </html>
    <?php
} else {
    // If the session is active, display content based on the request
    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case 'home':
                require_once 'views/home.php';
                break;
            case 'about':
                require_once 'views/about.php';
                break;
            case 'contact':
                require_once 'views/contact.php';
                break;
            case 'shop':
                require_once 'views/shop.php';
                break;
            case 'shop-single':
                require_once 'views/shop-single.php';
                break;
            case 'shop-men':
                require_once 'views/shop-men.php';
                break;
            case 'shop-women':
                require_once 'views/shop-women.php';
                break;
            case 'shop-category':
                require_once 'views/shop-category.php';
                break;
            case 'profile':
                require_once 'views/profile.php';
                break;
            case 'cart':
                require_once 'views/cart.php';
                break;
            case 'order':
                require_once 'views/order.php';
                break;
            case 'login':
                require_once 'views/login.php';
                break;
            case 'checkout':
                require_once 'views/checkout.php';
                break;
            default:
                require_once 'views/404.php';
                break;
        }
    } else {
        require_once 'views/home.php';
    }
}
?>
