<?php include ROOT . '/views/layouts/header_admin.php';?>
<style>
    p {
        line-height: 1.5;
    }
    input.long {
        left: 100px;
    }
</style>
<div style="margin: 0 10% 0 10%">
    <br/>
    <p style="line-height: normal;font-weight: normal">-> <a href="/admin">Главная</a> ->
        <a href="/admin/order">Управление заказами</a><b> -> Редактирование статуса заказа</b></p>
    <br/>
    <h2>Введите изменения статуса заказа:</h2>
    <form action="#" method="post" enctype="multipart/form-data">
        <p>
            Статус:<br/>
            <select name="status">
                <?php for($i = 0; $i <= 3; $i++): ?>
                <option value="<?=$i;?>"<?php if ($i == $order['status_id']) {echo 'selected="selected"';}?>>
                    <?=Order::statusName($i);?>
                </option>
                <?php endfor; ?>
            </select>
        </p>
    <p>ID заказа: <b><?=$order['id'];?></b></p>
    <p>Имя покупателя: <b><?=$order['user_name'];?></b></p>
    <p>Дата заказа: <b><?=$order['date'];?></b></p>
    <p>Товары заказаны: </p>
        <table  border="1" cellpadding="4" style="border-collapse: collapse; text-align: center">
            <tr>
                <th>Код<br/>товара</th>
                <th>Изображение</th>
                <th>Название</th>
                <th>Стоимость,<br/>руб</th>
                <th>Количество,<br/>шт</th>
            </tr>
            <?php foreach ($products as $product):
                $i = 0;
                ?>
            <tr>
                <td><?= $product["id"]; ?></td>
                <td>
                    <a  href="/product/<?php echo $product['id'];?>">
                        <img src="/template/images/cart/<?=($product['id']); ?>.jpg" alt="" />
                    </a>
                </td>
                <td><?= $product["name"]; ?></td>
                <td><?= $productsInOrder[$product['id']]['price']; ?></td>
                <td><?= $productsInOrder[$product['id']]['quantity'];?></td>
            </tr>
            <?php
            $i += 1;
            endforeach;?>
            <tr>
                <td colspan="4">Общая стоимость:</td>
                <td><b style="font-size: 18px"><?= $totalPrice;?></b></td>
            </tr>
        </table>
        <p>
            Комментарии покупателя<br/>
            <textarea cols="43" rows="5" name="description"><?= $order['user_comment'];?></textarea>
        </p>
        <p>
            <input  class="long" type="submit" name="submit" value="Сохранить">
        </p>
        <p>
    </form>
    <form method="post">
        <input formaction="/admin/order" class="long" type="submit" name="exit" value="Назад       ">
    </form>
    </p>
    </form>
</div>
<font color="red">
    <?php if (isset($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li> - <?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</font>
