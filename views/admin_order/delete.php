<?php include ROOT . '/views/layouts/header_admin.php';?>
<div style="margin: 0 10% 0 10%">
<br/>
    <p>-> <a href="/admin">Главная</a> -> <a href="/admin/order/data">Управление заказами</a><b> -> Удаление заказа</b></p>
<br/>
    <p>Вы действительно хотите удалить этот заказ?</p>
<p>
    <p>
        ID заказа = <b><?=$order['id'];?>;</b>
    </p>
    <p>
        Имя покупателя: <b><?=$order['user_name'];?></b>
    </p>
    <p>
        Телефон покупателя: <b><?=$order['user_phone'];?></b>
    </p>
    <p>
        Дата заказа: <b><?=$order['date'];?></b>
    </p>
    <p>
        Сумма заказа: <b><?=$totalPrice;?></b>
    </p>
</p>
<p>
    <form method="post">
        <input class="long" type="submit" name="delete" value="Удалить">
        <input class="long" type="submit" name="cancel" value="Отмена">
    </form>
</p>
</div>