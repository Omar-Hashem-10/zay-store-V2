<?php require_once 'src/config.php'; ?>
<?php require_once ROOT_PATH . 'src/db.php'; ?>
<?php require_once ROOT_PATH . 'core/functions.php'; ?>
<?php require_once ROOT_PATH . 'inc/header.php'; ?>
<?php require_once ROOT_PATH . 'inc/nav.php'; ?>


    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>



    <!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <?php 
                if(isset($_GET["id"]))
                {
                    $_SESSION["id"] = $_GET["id"];
                }
                $id = $_SESSION["id"];
                $result = get_row('products', $id); 
                ?>
                <?php while($product = mysqli_fetch_assoc($result)): ?>
                <div class="col-lg-4 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="<?php echo BASE_URL . "../public/images/products/" . $product["image"]; ?>" alt="Card image cap" id="product-detail">
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2"><?= $product["title"] ?></h1>
                            <p class="h3 py-2">$<?= $product["price"] ?></p>
                            <p class="py-2">
                            <ul class="list-unstyled  mb-1">
                                <li>
                                    <?php echo str_repeat('<i class="text-warning fa fa-star"></i>', $product["rating"]); ?>
                                    <?php echo str_repeat('<i class="text-muted fa fa-star"></i>', 5 - $product["rating"]); ?>
                                    <span class="list-inline-item text-dark">Rating <?= $product["rating"]; ?> | <?= $product["review"]; ?> Comments</span>
                                </li>
                                </ul>
                            </li>
                            </p>
                            <?php 
                            $id = $product["category_id"];
                            $result2 = get_row("categories", $id) ;
                            $category = mysqli_fetch_assoc($result2);
                            ?>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Category:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong><?= $category["name"]; ?></strong></p>
                                </li>
                            </ul>

                            <h6>Description:</h6>
                            <p><?= $product["description"]; ?></p>

                            <form action="../handelers/add-cart.php?id=<?= $product["id"]; ?>" method="POST">
                            <div class="row">
                                <div class="col-auto">
                                    <?php if($product["gender"] == "men" || $product["gender"] == "women"): ?>
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item">Size :</li>
                                        <li class="list-inline-item"><button type="button" class="btn btn-success btn-size" data-size="S">S</button></li>
                                        <li class="list-inline-item"><button type="button" class="btn btn-success btn-size" data-size="M">M</button></li>
                                        <li class="list-inline-item"><button type="button" class="btn btn-success btn-size" data-size="L">L</button></li>
                                        <li class="list-inline-item"><button type="button" class="btn btn-success btn-size" data-size="XL">XL</button></li>
                                    </ul>
                                    <input type="hidden" name="product-size" id="product-size" value="S">
                                    <?php endif; ?>
                                </div>
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item text-right">Quantity</li>
                                        <li class="list-inline-item"><button type="button" class="btn btn-success" id="btn-minus">-</button></li>
                                        <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                        <li class="list-inline-item"><button type="button" class="btn btn-success" id="btn-plus">+</button></li>
                                    </ul>
                                    <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="submit" value="buy">Buy</button>
                                </div>
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="submit" value="add-to-cart">Add To Cart</button>
                                </div>
                            </div>
                        </form>


                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->

    <!-- Start Slider Script -->
    <script src="assets/js/slick.min.js"></script>
    <script>
        $('#carousel-related-product').slick({
            infinite: true,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 3,
            dots: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                }
            ]
        });
    </script>
    <!-- End Slider Script -->
    <?php require_once ROOT_PATH . 'inc/footer.php'; ?>

