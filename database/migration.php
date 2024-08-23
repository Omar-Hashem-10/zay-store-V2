<?php

// $conn = mysqli_connect("localhost", "root", "");

// $sql = "CREATE DATABASE `zay-store-v2`";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

$conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

// $sql = "CREATE TABLE `slider` (
//   `id` INT PRIMARY KEY AUTO_INCREMENT,
//   `title` VARCHAR(200) NOT NULL,
//   `sub_title` VARCHAR(200) NOT NULL,
//   `description` VARCHAR(200) NOT NULL,
//   `image` VARCHAR(200) NOT NULL
// )";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "INSERT INTO `slider` (`title`, `sub_title`, `description`, `image`) 
// VALUES
//   (
//     'Zay eCommerce',
//     'Tiny and Perfect eCommerce Template',
//     'Zay Shop is an eCommerce HTML5 CSS template with latest version of Bootstrap 5 (beta 1). This template is 100% free provided by TemplateMo website. Image credits go to Freepik Stories, Unsplash and Icons 8.',
//     'banner_img_01.jpg'
//   ),
//   (
//     'Proident occaecat',
//     'Aliquip ex ea commodo consequat',
//     'You are permitted to use this Zay CSS template for your commercial websites. You are not permitted to re-distribute the template ZIP file in any kind of template collection websites.',
//     'banner_img_03.jpg'
//   ),
//   (
//     'Repr in voluptate',
//     'Ullamco laboris nisi ut',
//     'We bring you 100% free CSS templates for your websites. If you wish to support TemplateMo, please make a small contribution via PayPal or tell your friends about our website. Thank you.',
//     'banner_img_02.jpg'
//   )
// ";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "CREATE TABLE `categories`(
//   `id` INT PRIMARY KEY AUTO_INCREMENT,
//   `name` VARCHAR(200) NOT NULL,
//   `image` VARCHAR(200) NULL
// )"; 

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "INSERT INTO `categories` (`name`, `image`) 
// VALUES
//   (
//     'Watches',
//     'category_img_01.jpg'
//   ),
//   (
//     'Shoes',
//     'category_img_02.jpg'
//   ),
//   (
//     'Accessories',
//     'category_img_03.jpg'
//   )
// ";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "CREATE TABLE products (
//     `id` INT AUTO_INCREMENT PRIMARY KEY,
//     `title` VARCHAR(255) NOT NULL,
//     `featured_product` BOOLEAN DEFAULT FALSE,
//     `price` DECIMAL(10, 2) NOT NULL,
//     `rating` DECIMAL(3, 2),
//     `review` INT NOT NULL,
//     `description` TEXT,
//     `image` VARCHAR(255),
//     `gender` ENUM('men', 'women', 'children')  NULL,
//     `category_id` INT,
//     FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
// )";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "INSERT INTO `products` (`title`, `featured_product`, `price`, `rating`, `review`, `description`, `image`,`category_id`)
// VALUES
//   (
//     'Gym Weight',
//     1,
//     240,
//     3,
//     24,
//     'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt in culpa qui officia deserunt.',
//     'feature_prod_01.jpg',
//     4
//   ),
//   (
//   'Cloud Nike Shoes',
//   1,
//   480,
//   4,
//   48,
//   'Aenean gravida dignissim finibus. Nullam ipsum diam, posuere vitae pharetra sed, commodo ullamcorper.',
//   'feature_prod_02.jpg',
//   2
//   ),
//   (
//   'Mont Blanc Sunglass',
//   1,
//   360,
//   5,
//   74,
//   'Curabitur ac mi sit amet diam luctus porta. Phasellus pulvinar sagittis diam, et scelerisque ipsum lobortis nec.',
//   'feature_prod_03.jpg',
//   3
//   )
// ";

// mysqli_query($conn, $sql);

// mysqli_close($conn);


// $sql = "INSERT INTO `categories` (`name`, `image`) 
// VALUES
//   (
//     'Fitness Gym',
//     NULL
//   )";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "ALTER TABLE categories
// ADD category_month INT";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "CREATE TABLE users (
//   id INT AUTO_INCREMENT PRIMARY KEY,
//   username VARCHAR(50) NOT NULL ,
//   password VARCHAR(255) NOT NULL,
//   email VARCHAR(100) NOT NULL UNIQUE,
//   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//   role ENUM('user', 'admin') DEFAULT 'user'
// )";



// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "INSERT INTO `products` (`title`,`price`, `rating`, `review`, `description`, `image`, `gender`,`category_id`)
// VALUES
//   (
//     'Oupidatat non',
//     250,
//     4,
//     50,
//     'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse. Donec condimentum elementum convallis. Nunc sed orci a diam ultrices aliquet interdum quis nulla.',
//     'shop_01.jpg',
//     'women',
//     5
//   ),
//   (
//     'Oupidatat non',
//     350,
//     5,
//     75,
//     'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse. Donec condimentum elementum convallis. Nunc sed orci a diam ultrices aliquet interdum quis nulla.',
//     'shop_02.jpg',
//     'women',
//     6
//   ),
//   (
//     'Oupidatat non',
//     400,
//     5,
//     150,
//     'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse. Donec condimentum elementum convallis. Nunc sed orci a diam ultrices aliquet interdum quis nulla.',
//     'shop_03.jpg',
//     'women',
//     7
//   ),
//   (
//     'Oupidatat non',
//     300,
//     3,
//     100,
//     'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse. Donec condimentum elementum convallis. Nunc sed orci a diam ultrices aliquet interdum quis nulla.',
//     'shop_04.jpg',
//     'men',
//     8
//   ),
//   (
//     'Oupidatat non',
//     150,
//     5,
//     60,
//     'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse. Donec condimentum elementum convallis. Nunc sed orci a diam ultrices aliquet interdum quis nulla.',
//     'shop_05.jpg',
//     'men',
//     9
//   ),
//   (
//     'Oupidatat non',
//     500,
//     4,
//     200,
//     'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse. Donec condimentum elementum convallis. Nunc sed orci a diam ultrices aliquet interdum quis nulla.',
//     'shop_06.jpg',
//     'women',
//     10
//   ),
//   (
//     'Oupidatat non',
//     470,
//     5,
//     250,
//     'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse. Donec condimentum elementum convallis. Nunc sed orci a diam ultrices aliquet interdum quis nulla.',
//     'shop_07.jpg',
//     'men',
//     11
//   ),
//   (
//     'Oupidatat non',
//     340,
//     4,
//     60,
//     'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse. Donec condimentum elementum convallis. Nunc sed orci a diam ultrices aliquet interdum quis nulla.',
//     'shop_08.jpg',
//     'women',
//     12
//   ),
//   (
//     'Oupidatat non',
//     280,
//     3,
//     90,
//     'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse. Donec condimentum elementum convallis. Nunc sed orci a diam ultrices aliquet interdum quis nulla.',
//     'shop_011.jpg',
//     'women',
//     5
//   )
// ";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "INSERT INTO `categories` (`name`)
// VALUES
//   (
//     'collar shirts'
//   ),
//   (
//     'blouses'
//   ),
//   (
//     'dresss'
//   ),
//   (
//     'Shirt'
//   ),
//   (
//     'Blazer'
//   ),
//   (
//     'Abaya'
//   ),
//   (
//     'suit'
//   ),
//   (
//     'Sportswear'
//   )
// ";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "CREATE TABLE `services`(
//   `id` INT PRIMARY KEY AUTO_INCREMENT,
//   `name` VARCHAR(200) NOT NULL,
//   `image` VARCHAR(200) NOT NULL
// )";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "INSERT INTO `services` (`name`, `image`)
// VALUES
//   (
//     'Delivery Services',
//     'fa fa-truck fa-lg'
//   ),
//   (
//     'Shipping & Return',
//     'fas fa-exchange-alt'
//   ),
//   (
//     'Promotion',
//     'fa fa-percent'
//   ),
//   (
//     '24 Hours Service',
//     'fa fa-user'
//   )
// ";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "CREATE TABLE `brands`(
//   `id` INT PRIMARY KEY AUTO_INCREMENT,
//   `image` VARCHAR(200) NOT NULL
// )";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "INSERT INTO `brands` (`image`)
// VALUES
//   (
//     '01.png'
//   ),
//   (
//     '02.png'
//   ),
//   (
//     '03.png'
//   ),
//   (
//     '04.png'
//   )
// ";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "CREATE TABLE `contact`(
//   `id` INT PRIMARY KEY AUTO_INCREMENT,
//   `name` VARCHAR(200) NOT NULL,
//   `email` VARCHAR(200) NOT NULL,
//   `subject` ENUM('General Inquiry', 'Support', 'Feedback', 'Other') NOT NULL,
//   `message` TEXT NOT NULL,
//   `customer_id` INT,
//   FOREIGN KEY (`customer_id`) REFERENCES `users`(`id`)
// )";


// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "CREATE TABLE `cart` (
//   `id` INT PRIMARY KEY AUTO_INCREMENT,
//   `user_id` INT NOT NULL,
//   `product_id` INT NOT NULL,
//   `quantity` INT NOT NULL DEFAULT 1,
//   FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
//   FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
// )";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql ="CREATE TABLE `orders` (
//     `id` INT AUTO_INCREMENT PRIMARY KEY,
//     `user_id` INT NOT NULL,
//     `order_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     `total_amount` DECIMAL(10, 2) NOT NULL,
//     `status` ENUM('pending', 'processing', 'completed', 'canceled') DEFAULT 'pending',
//     FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
// )";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "CREATE TABLE `order_items` (
//     `id` INT AUTO_INCREMENT PRIMARY KEY,
//     `order_id` INT NOT NULL,
//     `product_id` INT NOT NULL,
//     `quantity` INT NOT NULL,
//     `price` DECIMAL(10, 2) NOT NULL,
//     FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
//     FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
// )";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "ALTER TABLE cart
// ADD size ENUM('S', 'M', 'L', 'XL') NULL ;
// ";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "ALTER TABLE `order_items`
// ADD COLUMN `size` VARCHAR(10) NULL
// ";

// mysqli_query($conn, $sql);

// mysqli_close($conn);

// $sql = "ALTER TABLE `orders`
// ADD COLUMN `payment_method` ENUM('Credit Card', 'Debit Card', 'PayPal', 'Bank Transfer') NOT NULL DEFAULT 'Credit Card',
// ADD COLUMN `shipping_address` TEXT NOT NULL 
// ";

// mysqli_query($conn, $sql);

// mysqli_close($conn);