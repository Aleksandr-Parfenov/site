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
    <p style="line-height: normal;font-weight: normal">-> <a href="/admin">Главная</a> -> <a href="/admin/category">Управление категориями</a><b> -> Добавление новой категории</b></p>
    <br/>
    <h2>Введите описание новой категории:</h2>
    <form action="#" method="post" enctype="multipart/form-data">
        <p>
            Название категории<br/>
            <input type="text" name="name" size="50" placeholder="" value="">
        </p>
        <p>
            Приоритет сортировки(натуральные числа)<br/>
            <input type="text" name="sort_order" size="50" placeholder="" value="0">
        </p>
        <p>
            Отображение<br/>
            <select name="status">
                <option value="1" selected="selected">Да</option>
                <option value="0">Нет</option>
            </select>
        </p>
        <p>
            <input  class="long" type="submit" name="submit" value="Сохранить">
        </p>
        <p>
            <form method="post">
                <input formaction="/admin/category" class="long" type="submit" name="exit" value="Назад       ">
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
