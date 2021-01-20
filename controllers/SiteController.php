<?php

class SiteController
{
    public function actionIndex()
    {
        $categories = array();
        $categories = Category::getCategoriesList();
        $categoryId = 0;

        $latestProducts = array();
        $latestProducts = Product::getLatestProduct();

        $recommendedProducts = array();
        $recommendedProducts = Product::getRecommendedProduct();
        require_once (ROOT . '/views/site/index.php');

        return true;
    }

    public function actionTableTest()
    {

        require_once (ROOT . '/views/site/table_test.php');

        return true;
    }

//    public function actionContact() {
//        $mail = 'parfenov.minsk@gmail.com';
//        $subject = 'Тема письма';
//        $message = 'Содержание письма';
//        $result = mail($mail, $subject, $message);
//
//        return true;
//    }


}
