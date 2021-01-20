<?php include ROOT . '/views/layouts/header_admin.php';?>
<div style="margin: 0 10% 0 10%">
<br/>
    <p>-> <a href="/admin">Главная</a> -> <a href="/admin/product">Управление товарами</a><b> -> Удаление товара</b></p>
<br/>
    <p>Вы действительно хотите удалить товар "<?=$product['name'];?>" из каталога магазина?</p>
<p>
    <img src="/template/images/cart/<?=($product['id']); ?>.jpg" alt="" />
    <br/>
    Id = <?=$product['id'];?>;
    <br/>
    Цена <?=$product['price'];?> р.
</p>
<p>
    <form method="post">
        <input class="long" type="submit" name="delete" value="Удалить">
        <input formaction="/admin/product" class="long" type="submit" name="cancel" value="Отмена">
    </form>
</p>
</div>