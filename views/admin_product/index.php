<?php include ROOT . '/views/layouts/header_admin.php';?>
<div style="margin: 0 10% 0 10%">
    <br/>
    <p>-> <a href="/admin/">Главная</a><b> -> Управление товарами</b></p>
    <br/>
    <br/>
    <a href="/admin/product/create"><input class="long" type="submit" value="+ добавить товар"></a>
    <br/>
    <br/>
    <h2>Список товаров</h2>
    <table  border="1" cellpadding="4" style="border-collapse: collapse">
        <tr>
            <th>ID товара</th>
            <th>Артикул</th>
            <th>Название товара</th>
            <th>Цена</th>
            <th>Удалить</th>
        </tr>
        <?php foreach ($productList as $product): ?>
        <tr>
            <td><?= $product['id']; ?></td>
            <td><?= $product['code']; ?></td>
            <td>
                <a title="редактировать" href="/admin/product/update/<?= $product['id']; ?>"><?= $product['name']; ?>
                </a>
            </td>
            <td><?= $product['price']; ?></td>
            <td style="text-align: center"><a style="color: #ac1f00" href="/admin/product/delete/<?= $product['id']; ?>">x</td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p>
    <form method="post">
        <input formaction="/admin" class="long" type="submit" name="exit" value="Назад       ">
    </form>
    </p>
</div>