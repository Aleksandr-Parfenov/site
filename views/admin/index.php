<?php include ROOT . '/views/layouts/header_admin.php';?>
<div style="margin: 0 10% 0 10%">
<br/>
<p><b>-> Главная</b></p>
<br/>
<p>Вам доступны такие возможности:</p>
<ul style="font-size: 18px; line-height: 1.5">
    <li><a href="/admin/product">Управление товарами</a></li>
    <li><a href="/admin/category">Управление категориями</a></li>
    <li><a href="/admin/order/date">Управление заказами</a></li>
    <li><a href="/admin/generate">Генератор заказов</a></li>
</ul>

    <?php

    //    //2) соответствует ли именование переданных параметров?;
    //    foreach ($params as $key => $value) {
    //
    //
    //
    //        if (strripos($query, 'LIMIT') > strripos($query, $key)
    //            or strripos($query, 'IN') > strripos($query, $key)) {
    //            $key = ' :' . $key;
    //        } else {
    //            $key = $key . ' = :' . $key;
    //        }
    //
    //    if (!substr_count($query, $key)) {
    //    $str .= "\n     Не найдено параметра в запросе: " . $key;
    //    }
    //    }
    //
?>
<div/>
