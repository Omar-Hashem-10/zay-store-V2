<?php
require_once 'src/config.php'; 
require_once ROOT_PATH . "core/functions.php";
require_once ROOT_PATH . "inc/header.php";
require_once ROOT_PATH . "inc/nav.php";
?>
<div class="container mt-5">
    <h2 class="text-center">Checkout Form</h2>
    <form action="handelers/process_checkout.php" method="POST">
        <div class="form-group mb-4">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group mb-4">
          <label for="payment_method">Payment Method</label>
          <select class="form-control" id="payment_method" name="payment_method" required>
              <option value="">Select Payment Method</option>
              <option value="Credit Card">Credit Card</option>
              <option value="Debit Card">Debit Card</option>
              <option value="paypal">PayPal</option>
              <option value="Bank Transfer">Bank Transfer</option>
          </select>
        </div>
        <div class="form-group mb-4">
            <label for="shipping_address">Shipping Address</label>
            <textarea class="form-control" id="shipping_address" name="shipping_address" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php require_once ROOT_PATH . "inc/footer.php"; ?>
