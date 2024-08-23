<?php include_once("inc/header.php"); ?>
<?php

$conn = mysqli_connect("localhost", "root", "", "zay-store-v2");

$id =  $_GET["id"];

$sql = "SELECT * FROM `users` WHERE id = '$id'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

?>


<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <form action="handelers/update_customer.php?id=<?= $row["id"] ?>" method="POST" class="form border p-2 my-5">
        <?php require_once("inc/errors.php"); ?>
        <h2 class="border p-2 my-2 text-center">Update Profile Customer</h2>
        <input type="text" value="<?= $row["username"] ?>" name="name" class="form-control my-3 border border-success" >
        <input type="text" value="<?= $row["email"] ?>" name="email" class="form-control my-3 border border-success" >
        <input type="submit" value="Save" class="form-control btn btn-primary my-3 ">
      </form>
    </div>
  </div>
</div>
</div>


<?php include_once("inc/footer.php"); ?>