<?php

class AdminController extends AdminBase
{
    /**
     * Action для главной страницы администратора
     */
    public function actionIndex()
    {
        //Проверка доступа
        self::checkAdmin();
        //Проверка доступа
        require_once(ROOT . '/views/admin/index.php');
        return true;

    }
}