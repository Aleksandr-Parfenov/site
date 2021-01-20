<?php include ROOT . '/views/layouts/header_admin.php';
/** @var string $sortedType */
?>
<style>
    p {
        line-height: 1.5;

    }
    input.long {
        font-size:20px;
    }
    a.pagination {
        font-size:20px;
    }
    div.pagination {
        word-spacing: 20px;
    }
</style>
<div style="margin: 0 10% 0 10%">
    <br/>
    <p>-> <a href="/admin/">Главная</a><b> -> Управление заказами</b></p>
    <br/>
    <br/>
    <h2>Список заказов </h2>
    <p>
    Всего заказов: <?= $total;?> шт.
    (
    <?php foreach ($allOrdersByStatus as $ordersByStatus): ?>
        <?= $ordersByStatus['name'] ?>: <?= $ordersByStatus['count'] ?> шт. -
            <?= round($ordersByStatus['count']/$total*100); ?> %;
    <?php endforeach; ?>
    )
    </p>
    <p>
    Заказы по дням недели:
        <?php foreach ($allOrdersByDayOfTheWeek as $key => $ordersByDayOfTheWeek): ?>
        <?= $daysOfTheWeek[$key]; ?> - <?= $ordersByDayOfTheWeek['count']; ?> шт.
        (<?= round($ordersByDayOfTheWeek['count']/$total*100); ?> %);
        <?php endforeach; ?>
    </p>
<!--            на складе: --><?//= $total;?><!-- шт. - --><?//= $total/$total*100;?><!-- %; у курьера: --><?//= $total;?><!--)-->

    <p>
        Сортировать по:

        <a <?= ViewHelper::highlightWithRed($sortedType ==='date'); ?> href = "/admin/order/date" > дате</a>
        <a <?= ViewHelper::highlightWithRed($sortedType ==='status_id'); ?> href = "/admin/order/status_id" > статусу</a>
        <a <?= ViewHelper::highlightWithRed($sortedType ==='order_price'); ?> href = "/admin/order/order_price" > стоимости</a>

    </p>
    <table  border="1" cellpadding="4" style="border-collapse: collapse; text-align: center; height: 500px">
        <tr style="height: 50px">
            <th style="width: 10%">ID <br/>заказа</th>
            <th style="width: 25%">Имя покупателя</th>
            <th style="width: 8%">Сумма заказа</th>
            <th style="width: 17%">Телефон покупателя</th>
            <th style="width: 10%">Дата оформления</th>
            <th style="width: 10%">Статус</th>
            <th style="width: 10%">Удалить</th>
        </tr>
        <?php foreach ($orderList as $order): ?>
            <tr>
                <td><?= $order['id']; ?></td>
                <td><?= $order['user_name']; ?></td>
                <td><?= $order['cost']; ?></td>
                <td><?= $order['user_phone']; ?></td>
                <td><?= $order['date']; ?></td>
                <td><a href="/admin/order/update/<?=$order['id'];?>"><?= Order::statusName($order['status_id']); ?></a></td>
                <td style="text-align: center">
                    <a style="color: #ac1f00" href="/admin/order/delete/<?= $order['id']; ?>">x
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="pagination">
        <?php echo $pagination->get(); ?>
    </div>
    <p>
        <form method="post">
            <input formaction="/admin" class="long" type="submit" name="exit" value="Назад       ">
            <input class="long" type="submit" name="save" value="Скачать в PDF">
        </form>
    </p>
</div>

