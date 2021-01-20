<?php

class CartController
{
    public function actionIndex()
    {
        $categories = array();
        $categories = Category::getCategoriesList();
        $categoryId = 0;

        $productsInCart = array();
        $productsInCart = Cart::getProducts();
        //$productsInCart = Cart::getRelevanceProducts();
        if ($productsInCart) {
            //Получаем полную информацию о товарах для списка
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);
            $_SESSION['productsInCartWithAllParameters'] = $products;
            $totalPrice = Cart::getTotalPriceProductsCart($products);
            //TODO:Удаление не актуальных товаров из корзины(без обращения к БД оптимизировать)
            //Cart::updateRelevanceCartProducts($products);
        }
        require_once(ROOT . '/views/cart/index.php');
        return true;
    }

    public function actionAddProductAjax($id)

    {   $countIdProduct = 1;
        //если добавить нужно несколько товаров одной категории
        if (isset($_POST['countIdProduct']) && is_numeric($_POST['countIdProduct'])) {
            if (is_int($_POST['countIdProduct'] *= 1)) {
                $countIdProduct = $_POST['countIdProduct'];
            }
        }
        //создаем массив для передачи в формате JSON
        $arrayAjaxCart = array();
        //добавляем товар в корзину
        $arrayAjaxCart['cartCountIdProduct'] = Cart::addProduct($id, $countIdProduct);
        //узнаем количество товаров в корзине
        $arrayAjaxCart['cartCountItems'] = Cart::countItems();
        //узнаем общую стоимость всех товаров в корзине
        if (substr_count($_SERVER['HTTP_REFERER'], '/cart/')) {
            $arrayAjaxCart['cartTotalProduct'] = $_SESSION['productsInCart'];
            $arrayAjaxCart['cartTotalPrice'] = Cart::getTotalPriceProductsCart($_SESSION['productsInCartWithAllParameters']);
            }
        $stringJson = json_encode($arrayAjaxCart);
        echo $stringJson;
        return true;
    }

    public function actionSubtractAjax($id)
    {
        //если убрать из корзины нужно все товары одной категории
        $deleteAllProduct = 0;
        if (isset($_POST['deleteAllProduct'])) {
            if ($_POST['deleteAllProduct'] == 1) {
                $deleteAllProduct = 1;
            }
        }
        //создаем массив для передачи в формате JSON
        $arrayAjaxCart = array();
        //убавляем товар из корзины
        $arrayAjaxCart['cartCountIdProduct'] = Cart::subtractProduct($id, $deleteAllProduct);
        //узнаем количество товаров в корзине
        $arrayAjaxCart['cartCountItems'] = Cart::countItems();
        //узнаем общую стоимость всех товаров в корзине
        $arrayAjaxCart['cartTotalPrice'] = Cart::getTotalPrice();
        $stringJson = json_encode($arrayAjaxCart);
        echo $stringJson;
        return true;
    }

    public function actionCheckOut()
    {
        // Список категорий для левого меню
        $categories = array();
        $categories = Category::getCategoriesList();
        $categoryId = 0;

        // Статус успешного оформления заказа
        $result = false;
        //Форма отправлена?
        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            //Валидация полей
            $errors = [];
            if (!User::checkName($userName)) {
                $errors[] = 'Неправильное имя';
            }
            if (!User::checkPhone($userPhone)) {
                $errors[] = 'Неправильный номер телефона';
            }
            //Форма заполнена корректно?
            if (count($errors) == 0) {
                //Сохраняем заказ в базе данных
                $userId = User::getUserId();
                //Сохраняем заказ в БД
                $result = Order::save($userName, $userPhone, $userComment, $userId);

                if ($result) {
                    //Оповещаем администратора о новом заказе

                    //Очищаем козину
                    Cart::clear();
                }
            } else {
                //Форма заполнена корректно? - Нет
                //Итоги: общая стоимость, количество товаров
                $totalPrice = Cart::getTotalPrice();
                $totalQuantity = Cart::countItems();
            }
        } else {
            //Форма отправлена? - Нет
            //Получаем данные из корзины
            if (!Cart::countItems()) {
                header(" Location: /");
            } else {
                //В корзине есть товары? - Да
                //Итоги: общая стоимость, количество товаров
                $totalPrice = Cart::getTotalPrice();
                $totalQuantity = Cart::countItems();

                $userName = User::getUserName();
                $userPhone = '';
                $userComment = '';
            }
        }
        require_once(ROOT . '/views/cart/checkout.php');
        return true;
    }
}
