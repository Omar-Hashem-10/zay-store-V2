<?php session_start(); ?>
<?php require_once("inc/header_register.php"); ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card o-hidden border-0 shadow-lg" style="width: 100%; max-width: 700px;">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form action="handelers/handele-register.php" method="POST" class="user">
                        <?php if (isset($_SESSION["errors"])): ?>
                        <?php foreach ($_SESSION["errors"] as $errors): ?>
                            <div class="alert alert-danger text-center">
                                <?php echo $errors; ?>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php unset($_SESSION["errors"]); ?>
                            <div class="form-group ">
                                    <input type="text" class="form-control form-control-user" name="username" id="exampleFirstName"
                                        placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail"
                                    placeholder="Email">
                            </div>
                            <div class="form-group ">
                                    <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password">
                            </div>
                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Register">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>