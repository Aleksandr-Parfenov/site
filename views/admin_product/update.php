<?php include ROOT . '/views/layouts/header_admin.php';?>
<style>
    p {
        line-height: 1.5;
        font-weight: bold;
    }
    input.long {
        font-size:20px;
    }
</style>
<div style="margin: 0 10% 0 10%">
    <br/>
    <p style="line-height: normal;font-weight: normal">-> <a href="/admin">Главная</a> ->
        <a href="/admin/product">Управление товарами</a><b> -> Редактирование товара</b></p>
    <br/>
    <h2>Введите измение в описание товара:</h2>
    <form action="#" method="post" enctype="multipart/form-data">
        <p>
            Название товара<br/>
            <input type="text" name="name" size="50" placeholder="" value="<?= $product['name'];?>">
        </p>
        <p>
            Артикул<br/>
            <input type="text" name="code" size="50" placeholder="" value="<?= $product['code'];?>">
        </p>
        <p>
            Стоимость, руб<br/>
            <input type="text" name="price" size="50" placeholder="" value="<?= $product['price'];?>">
        </p>
        <p>
            Категория<br/>
            <select name="category_id">
                <?php foreach ($categoriesList as $category): ?>
                <option value="<?= $category['id'];?>"
                    <?php if ($product['category_id'] == $category['id']) {echo 'selected="selected"';} ?>>
                    <?= $category['name'];?></option>
                <?php endforeach;?>
            </select>
        </p>
        <p>
            Производитель<br/>
            <input type="text" name="brand" size="50" placeholder="" value='<?= $product['brand'];?>'>
        </p>
        <p>Изображение товара</p>
        <img src="/template/images/cart/<?=($product['id']); ?>.jpg" alt="" />
        <p>
            <input type="file" name="image" placeholder="" value="<?= $product['id'];?>">
        </p>
        <p>
            Детальное описание<br/>
            <textarea cols="43" rows="10" name="description"><?= $product['description'];?></textarea>
        </p>
        <p>
            Наличие на складе<br/>
            <select name="availability">
                <option value="1"<?php if ($product['availability']) {echo 'selected="selected"';} ?>>Да</option>
                <option value="0"<?php if (!$product['availability']) {echo 'selected="selected"';} ?>>Нет</option>
            </select>
        </p>
        <p>
            Новинка<br/>
            <select name="is_new">
                <option value="1"<?php if ($product['is_new']) {echo 'selected="selected"';} ?>>Да</option>
                <option value="0"<?php if (!$product['is_new']) {echo 'selected="selected"';} ?>>Нет</option>
            </select>
        </p>
        <p>
            Рекомендуемые<br/>
            <select name="is_recommended">
                <option value="1"<?php if ($product['is_recommended']) {echo 'selected="selected"';} ?>>Да</option>
                <option value="0"<?php if (!$product['is_recommended']) {echo 'selected="selected"';} ?>>Нет</option>
            </select>
        </p>
        <p>
            Статус<br/>
            <select name="status">
                <option value="1"<?php if ($product['status']) {echo 'selected="selected"';} ?>>
                    Отображается</option>
                <option value="0"<?php if (!$product['status']) {echo 'selected="selected"';} ?>>Нет</option>
            </select>
        </p>
        <p>
            <input class="long" type="submit" name="submit" value="Сохранить">
        </p>
        <p>
        <form method="post">
            <input formaction="/admin/product" class="long" type="submit" name="exit" value="Назад       ">
        </form>
        </p>
    </form>
</div>
