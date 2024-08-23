<?php if(isset($_SESSION["errors"])): ?>
                    <?php foreach($_SESSION["errors"] as $error): ?>
                    <div class="alert alert-danger text-center">
                        <?= $error?>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                    <?php unset($_SESSION["errors"]); ?>