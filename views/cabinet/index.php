<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <h1>Кабинет пользователя</h1>
                <h4>Привет, <?php echo $_SESSION['name'];?>!</h4>

                <ul>
                    <li><a href="/cabinet/edit/">Изменить имя</a></li>
                    <li><a href="/cart/">Список покупок</a></li>
                </ul>

            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>