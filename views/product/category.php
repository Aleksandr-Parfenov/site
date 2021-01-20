<?php include ROOT . '/views/layouts/header.php';?>
<section>
    <div class="container">
        <div class="row">
            <?php include ROOT . '/views/layouts/category.php';?>
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Товары категории</h2>
                    <?php foreach ($latestProducts as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="/product/<?= $product['id'];?>">
                                            <img src="/template/images/cart/<?= $product["id"]; ?>.jpg" alt="" />
                                        </a>
                                        <h2><?= $product["price"]; ?> руб</h2>
                                        <p>
                                            <a href="/product/<?= $product["id"];?>">
                                                <?= $product["name"]; ?>
                                            </a>
                                        </p>
                                        <a href="#" class="btn btn-default add-to-cart"  data-btn="add-to-cart" data-id="<?= $product["id"]; ?>"><i class="fa fa-shopping-cart" > </i>В корзину</a>
                                    </div>
                                    <?php if ($product['is_new']): ?>
                                        <img src="/template/images/home/new.png" class="new" alt="" />
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    <?php endforeach;?>
                    <!--Пространство навигации--->
                    <?php echo $pagination->get(); ?>
                </div><!--features_items-->
             </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php';?>

