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
    <p>-> <a href="/admin/">Главная</a><b> -> Управление категориями</b></p>
    <br/>
    <br/>
    <a href="/admin/category/create"><input class="long" type="submit" value="+ добавить категорию"></a>
    <br/>
    <br/>
    <h2>Список категорий</h2>
    <table  border="1" cellpadding="4" style="border-collapse: collapse; text-align: center">
        <tr>
            <th>ID <br/>категории</th>
            <th>Название категории</th>
            <th>Приоритет<br/>сортровки</th>
            <th>Отображение</th>
            <th>Удалить</th>
        </tr>
        <?php foreach ($categoryList as $category): ?>
            <tr>
                <td><?= $category['id']; ?></td>
                <td style="text-align: left">
                    <a title="редактировать" href="/admin/category/update/<?= $category['id']; ?>">
                        <?= $category['name']; ?>
                    </a>
                </td>
                <td><?= $category['sort_order']; ?></td>
                <td><?php if ($category['status'] == 1) {echo 'да';} else {echo 'нет';}?></td>
                <td style="text-align: center">
                    <a style="color: #ac1f00" href="/admin/category/delete/<?= $category['id']; ?>">x
                </td>
            </tr>
        <?php endforeach;?>
    </table>
    <p>
        <form method="post">
            <input formaction="/admin" class="long" type="submit" name="exit" value="Назад       ">
        </form>
    </p>

</div>

