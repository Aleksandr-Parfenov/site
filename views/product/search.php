<?php include ROOT . '/views/layouts/header.php';?>
    <section>
        <div class="container">
            <div class="row">
                <?php include ROOT . '/views/layouts/category.php';?>
                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Поиск</h2>
                        <form  action="#" method="post" enctype="multipart/form-data">
                            <div class="col-sm-6 padding-right">
                                <p>
                                    Название товара:<br>
                                    <input type="text" name="name" size="47" placeholder="" value="<?= $options['name'] ?? ''; ?>">
                                </p>
                                <p>
                                    Стоимость товара, р.:<br>
                                    от: <input type="text" name="price_from" size="6" placeholder="" value="<?= $options['price_from'] ?? '0'; ?>">
                                    до: <input type="text" name="price_to" size="6" placeholder="" value="<?= $options['price_to'] ?? '10000'; ?>">
                                </p>
                                <p>
                                    Категория:
                                    <select name="category_id">
                                        <option value=''>любая</option>
                                        <?php
                                        foreach ($categories as $category): ?>
                                            <option <?= (($options['category_id'] ?? '') == $category['id']) ? 'selected' : ''; ?>
                                                    value="<?= $category['id'];?>"><?= $category['name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </p>

                                <p>
                                    <input  class="long" type="submit" name="submit" value="Найти">
                                </p>
                            </div>

                            <div class="col-sm-6 padding-right">
                                <p>
                                    Бренд: <br/>
                                    <select name="brand">
                                        <option value=''>любой</option>
                                        <?php
                                        foreach ($brands as $brand): ?>
                                            <option <?= (($options['brand'] ?? '') == $brand['brand']) ? 'selected' : ''; ?>
                                                    value='<?= $brand['brand'];?>'><?= $brand['brand'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </p>
                                <p>
                                    Наличие на складе<br/>
                                    <select name="availability">
                                        <option value="1" >Да</option>
                                        <option value="0">Нет</option>
                                    </select>
                                </p>
                                <p>
                                    Изображение товара: <br/>
                                    <select name="status">
                                        <option value="1" selected="selected">Есть</option>
                                        <option value="0">Нет</option>
                                    </select>
                                </p>
                            </div>
                        </form>
                    </div><!--features_items-->
                    <h2 class="title text-center"><?= (($options['category_id'] ?? 'null') == 'null') ? '' : 'РЕЗУЛЬТАТ ПОИСКА'; ?></h2>
                    <?php if (isset($products)) {foreach ($products as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="/product/<?= $product['id'];?>">
                                            <img src="/template/images/cart/<?= $product["id"]; ?>.jpg" alt="" />
                                        </a>
                                        <h2><?= $product["price"]; ?> руб</h2>
                                        <p>
                                            <a href="/product/<?= $product['id'];?>">
                                                <?= $product["name"]; ?>
                                            </a>
                                        </p>
                                        <a href="#" class="btn btn-default add-to-cart" data-btn="add-to-cart" data-id="<?= $product["id"]; ?>"><i class="fa fa-shopping-cart" > </i>В корзину</a>
                                    </div>
                                    <?php if ($product['is_new']): ?>
                                        <img src="/template/images/home/new.png" class="new" alt="" />
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; }?>
                    <?= (!count($products ?? array()) && ($options['category_id'] ?? '')) ? 'По вашему запросу ничего не найдено' : ''; ?>
                </div>
            </div>
        </div>
    </section>
<?php include ROOT . '/views/layouts/footer.php';?>