<?php

class AdminProductController extends AdminBase
{
    public function actionIndex()
    {
        //Проверка доступа
        self::checkAdmin();

        //Получаем список товаров
        $productList = Product::getProductsList();

        require_once(ROOT . '/views/admin_product/index.php');
        return true;
    }

    public function actionCreate()
    {
        //Проверка доступа
        self::checkAdmin();
        //Получаем список категорий для всплывающего списка
        $categoriesList = Category::getCategoriesListAdmin();
        if (isset($_POST['submit'])) {
            //Если форма отправлена
            //Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];
            //Ошибки в форме
            $errors = [];
            //Валидация значений
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Зполните поля';
            }
            if (count($errors) == 0) {
                //Если ошибок нет
                //Добавляем новый товар
                $id = Product::createProduct($options);
                //Если запись добавлена
                if ($id) {
                    //Проверяем, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        //Если загружалосьб переместим его в нужную папкуб дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']
                            . "/template/images/cart/{$id}.jpg");
                    } else {
                        copy('template/images/cart/0.jpg', "template/images/cart/{$id}.jpg");
                    }
                }
                // Перенаправляем пользователя на страницу управлениями товарами
                header("Location: /admin/product");
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_product/create.php');
        return true;
    }

    public function actionDelete($id)
    {
        if (isset($_REQUEST['delete'])) {
            //Если кнопка удалить нажата
            //Проверка доступа
            self::checkAdmin();
            //Удаляем товар
            $GLOBALS['date_catalog'] = 0;
            if (Product::deleteProductById($id)) {
                $GLOBALS['date_catalog'] = 1;
            }
            header("Location: /admin/product");
            return true;
        }
        $product = Product::getProductById($id);
        $categories = Category::getCategoriesList();
        //Подключаем вид
        require_once (ROOT . '/views/admin_product/delete.php');
        return true;
    }

    public function actionUpdate($id)
    {
        //Проверка доступа
        self::checkAdmin();
        //Получаем список категорий для всплывающего списка
        $categoriesList = Category::getCategoriesListAdmin();
        $product = Product::getProductById($id);
        if (isset($_POST['submit'])) {
            //Если форма отправлена
            //Получаем данные из формы
            $options['id'] = $product['id'];
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];
            //Ошибки в форме
            $errors = [];
            //Валидация значений
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Зполните поля';
            }
            if (count($errors) == 0) {
                //Если ошибок нет
                //Добавляем новый товар
                $id = Product::updateProduct($options);
                //Если запись добавлена
                if ($id) {
                    //Проверяем, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        //Если загружалосьб переместим его в нужную папкуб дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']
                            . "/template/images/cart/{$id}.jpg");
                    }
                }
                // Перенаправляем пользователя на страницу управлениями товарами
                header("Location: /admin/product");
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_product/update.php');
        return true;
    }
}
