<?php

class CabinetController
{
    public function actionIndex()
    {
        if (!isset($_SESSION['user'])) {
            require_once(ROOT . '/views/cabinet/index.php');
            return true;
        } else {
            require_once(ROOT . '/views/cabinet/index.php');
            return true;
        }
    }

    public function actionEditName()
    {
        $result = '';

        if (isset($_POST['submit'])) {
            $newName = $_POST['name'];
            $errors = [];

            //Валидация поля
            if (!User::checkName($newName)) {
                $errors[] = 'Имя не может быть кароче двух символов';
            }
            if (count($errors) == 0) {

                $id = $_SESSION["id"];
                //Изменяем имя в БД и в сессии
                $result = User::editName($id, $newName);
                if ($result) {
                    //Перенаправляем пользователя в закрытую часть - кабинет
                    $_SESSION['name'] = $newName;
                    require_once (ROOT . '/views/cabinet/index.php');
                    return true;
                }
            }
        }
        require_once (ROOT . '/views/cabinet/edit_name.php');
        return true;
    }
}


