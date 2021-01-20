<?php include ROOT . '/views/layouts/header_admin.php';?>
<div style="margin: 0 10% 0 10%">
<br/>
    <p>-> <a href="/admin">Главная</a> -> <a href="/admin/category">Управление категориями</a><b> -> Удаление категории</b></p>
<br/>
    <p>Вы действительно хотите удалить категорию "<b><?=$category['name'];?></b>" из каталога магазина?</p>
<p>
    <p>
        ID категории = <b><?=$category['id'];?>;</b>
    </p>
    <p>
        Приоритет сортировки: <b><?=$category['sort_order'];?></b>
    </p>
    <p>
        Отображение:
        <b>
            <?php if ($category['status'] == 1) {
            echo 'Да';} else {echo 'нет';}?>
        </b>
    </p>
</p>
<p>
    <form method="post">
        <input class="long" type="submit" name="delete" value="Удалить">
        <input formaction="/admin/category" class="long" type="submit" name="cancel" value="Отмена">
    </form>
</p>
</div>