<?php include ROOT . '/views/layouts/header_admin.php';?>
<style>
    p {
        line-height: 1.5;
        font-weight: bold;
    }
    input.long {
        left: 100px;
    }
</style>
<div style="margin: 0 10% 0 10%">
    <br/>
    <p style="line-height: normal;font-weight: normal">-> <a href="/admin">Главная</a> -> <a href="/admin/product">Управление товарами</a><b> -> Добавление нового товара</b></p>
    <br/>
    <h2>Введите описание нового товара:</h2>
    <form action="#" method="post" enctype="multipart/form-data">
        <p>
            Название товара<br/>
            <input type="text" name="name" size="50" placeholder="" value="">
        </p>
        <p>
            Артикул<br/>
            <input type="text" name="code" size="50" placeholder="" value="">
        </p>
        <p>
            Стоимость, руб<br/>
            <input type="text" name="price" size="50" placeholder="" value="">
        </p>
        <p>
            Категория<br/>
            <select name="category_id">
                <?php foreach ($categoriesList as $category): ?>
                <option value="<?= $category['id'];?>"><?= $category['name'];?></option>
                <?php endforeach;?>
            </select>
        </p>
        <p>
            Производитель<br/>
            <input type="text" name="brand" size="50" placeholder="" value="">
        </p>
        <p>
            Изображение товара<br/>
            <input type="file" name="image" placeholder="" value="">
        </p>
        <p>
            Детальное описание<br/>
            <textarea cols="43" rows="10" name="description"></textarea>
        </p>
        <p>
            Наличие на складе<br/>
            <select name="availability">
                <option value="1" selected="selected">Да</option>
                <option value="0">Нет</option>
            </select>
        </p>
        <p>
            Новинка<br/>
            <select name="is_new">
                <option value="1" selected="selected">Да</option>
                <option value="0">Нет</option>
            </select>
        </p>
        <p>
            Рекомендуемые<br/>
            <select name="is_recommended">
                <option value="1" selected="selected">Да</option>
                <option value="0">Нет</option>
            </select>
        </p>
        <p>
            Статус<br/>
            <select name="status">
                <option value="1" selected="selected">Отображается</option>
                <option value="0">Нет</option>
            </select>
        </p>
        <p>
            <input  class="long" type="submit" name="submit" value="Сохранить">
        </p>
        <p>
        <form method="post">
            <input formaction="/admin/product" class="long" type="submit" name="exit" value="Назад       ">
        </form>
        </p>
    </form>
</div>
