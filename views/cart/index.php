<?php include ROOT . '/views/layouts/header.php';?>
<section>
    <div class="container">
        <div class="row">
            <?php include ROOT . '/views/layouts/category.php';?>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Корзина</h2>

                    <?php if ($productsInCart): ?>
                    <p>Вы выбрали такие товары:</p>
                    <table class="table-bordered table-striped table">
                        <tr>
                            <th>Код товара</th>
                            <th>Название</th>
                            <th>Стомость, руб</th>
                            <th>Количество, шт</th>
                        </tr>
                        <?php foreach ($products as $product): ?>
                        <tr data-btn="delete-line-cart-id<?= $product["id"]; ?>">
                            <td><?php echo $product['code'];?></td>
                            <td>
                                <a  href="/product/<?php echo $product['id'];?>">
                                    <div class="col-sm-6">
                                        <div class="view-product-cart" >
                                            <img src="/template/images/cart/<?=($product['id']); ?>.jpg" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6"">
                                    <?php echo $product['name'];?>
                </div>
                </a>
                </td>
                <td><?php echo $product['price'];?></td>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="33%"> </td>
                            <td width="34%" style="text-align: center" >
                                <a title="добавить 1 шт." href="#" data-btn="add-to-cart" data-id="<?= $product["id"]; ?>">
                                    <i style="color: #50ce67" class="fa fa-plus"></i>
                                </a>
                                <br>
                                <span data-btn="subtract-from-cart-id<?= $product["id"]; ?>">
                                                            <?php echo $productsInCart[$product['id']];?>
                                                        </span>
                                <br>
                                <a title="убрать 1 шт." href="#" data-btn="subtract-from-cart" data-id="<?= $product["id"]; ?>">
                                    <i style="color: #ce6044" class="fa fa-minus"></i>
                                </a>
                            </td>
                            <td width="33%" style="text-align: center">
                                <a data-btn="subtract-all-product-from-cart" title="удалить позицию" style="color: #ce0004" href="#" data-id="<?= $product["id"]; ?>">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    </table>

                </td>
                </tr>
                <?php endforeach;?>
                <tr>
                    <td colspan="3">Общая стоимость:</td>
                    <td>
                        <span id="cart-total-price"><?php echo $totalPrice;?></span>  руб
                    </td>
                </tr>

                </table>
                <a href="/cart/checkout" class="btn btn-default add-to-cart""><i class="fa fa-shopping-cart" > </i>Оформить заказ</a>

                    <?php else: ?>
                        <p>Корзина пуста</p>
                        <a class="btn btn-default checkout" href="/"><i class="fa fa-shopping-cart"></i> Вернуться к покупкам</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>

