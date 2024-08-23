<?php session_start(); ?>
<?php require_once("inc/header.php"); ?> 
<?php require_once("../src/db.php") ?>
<?php require_once("inc/nav.php"); ?> 


<div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="border p-2 my-2 text-center" >Admins</h2>
                <?php require_once("inc/errors.php"); ?>
                <?php require_once("inc/success.php"); ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>Admin ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registration Date</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $result = get_all('users'); ?>
                        <?php while($user = mysqli_fetch_assoc($result)): ?>
                        <?php if($user["role"] == "admin"): ?>
                    <tr>
                        <td><?= $user["id"]; ?></td>
                        <td><?= $user["username"]; ?></td>
                        <td><?= $user["email"]; ?></td>
                        <td><?= $user["created_at"]; ?></td>
                        <td>
                            <a href="edit_admin.php?id=<?= $user["id"]; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="handelers/delete_admin.php?id=<?= $user["id"]; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once("inc/scripts.php"); ?>
<?php require_once("inc/footer.php"); ?>


