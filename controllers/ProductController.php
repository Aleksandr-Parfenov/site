<?php

class ProductController
{
    public function actionIndex($productId)
    {
        $categories = array();
        $categories = Category::getCategoriesList();
        $categoryId = 0;

        $product = Product::getProductById($productId);

        require_once(ROOT . '/views/product/index.php');
        return true;
    }

    public function actionCategory($categoryId, $page = 1)
    {

        $categories = array();
        $categories = Category::getCategoriesList();

        $latestProducts = array();
        $latestProducts = Product::getProductsListByCategory($categoryId, $page);

        $total = Product::getTotalProductsInCategory($categoryId);

        //Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');


        require_once(ROOT . '/views/product/category.php');
        return true;
    }

    public function actionSearch()
    {
        $categories = array();
        $categories = Category::getCategoriesList();
        $brands = array();
        $brands = Product::getBrandsList();
        $categoryId = 0;
        if (isset($_POST['submit'])) {
            //Если форма отправлена
            //Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['price_from'] = $_POST['price_from'];
            $options['price_to'] = $_POST['price_to'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['status'] = $_POST['status'];

            //Ошибки в форме
            $errors = [];
            if (count($errors) == 0) {
                //Если ошибок нет
                //Выполняем поиск
                $products = array();
                $products = Product::getProductBySearch($options);
            }

        }
        require_once(ROOT . '/views/product/search.php');
        return true;
    }
}
