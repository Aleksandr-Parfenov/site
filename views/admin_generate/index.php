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
    <p>-> <a href="/admin/">Главная</a><b> -> Генератор заказов</b></p>
    <br/>
    <br/>
    <h2>Сгенерируй заказы:</h2>
    <form action="#" method="post" enctype="multipart/form-data">
        <p>
            <input type="text" name="quantity" size="6" placeholder="" value="">  шт.
        </p>
        <p>
            <input  class="long" type="submit" name="submit" value="Выполнить">
        </p>
    </form>
    <form method="post">
        <input formaction="/admin" class="long" type="submit" name="exit" value="Назад        ">
    </form>
    </p>
</div>