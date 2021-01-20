<?php include ROOT . '/views/layouts/header.php';?>
    <section>
        <div class="container">
            <div class="row">
                <?php include ROOT . '/views/layouts/category.php';?>

                <div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="view-product">
                                    <img src="/template/images/cart/<?=($product['id']); ?>.jpg" alt="" />
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="product-information"><!--/product-information-->
                                    <?php if ($product['is_new'] == 1) {?>
                                        <img src="/template/images/product-details/new.jpg" class="newarrival" alt="" />
                                    <?php } ?>
                                    <h2><?= $product['name']; ?></h2>
                                    <p>Код товара: <?= $product['code']; ?></p>
                                    <span>
                                            <span><?= $product['price']; ?> руб</span>
                                            <label>Количество:</label>
                                            <input data-btn="add-to-cart-value" type="text" value="1" />
                                            <a href="#" class="btn btn-default cart"  data-btn="add-to-cart" data-id="<?= $product["id"]; ?>"><i class="fa fa-shopping-cart" > </i> В корзину</a>
                                    </span>
                                    <p><b>Наличие:</b>
                                        <?php if ($product['availability']==0) echo "На складе";
                                        else echo "Под заказ - 1 неделя" ?></p>
                                    <p><b>Состояние:</b> Новое</p>
                                    <p><b>Производитель:</b> <?= $product['brand']; ?></p>
                                </div><!--/product-information-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>Описание товара</h5>
                                <p><?= $product['description']; ?></p>
                            </div>
                        </div>
                    </div><!--/product-details-->

                </div>
            </div>
        </div>
    </section>
<?php include ROOT . '/views/layouts/footer.php';?>