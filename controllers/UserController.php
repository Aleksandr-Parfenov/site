<?php

class UserController
{
    public function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';
        $result = '';

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = [];
            if (!User::checkName($name)) {
                $errors[] = 'Имя не может быть кароче двух символов';
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть кароче 6-ти символов';
            }
            if (User::checkEmailExist($email)) {
                $errors[] = 'такой email уже используется';
            }
            if (count($errors) == 0) {
                $result = User::register($name, $email, $password);
            }
        }
        require_once (ROOT . '/views/user/register.php');
        return true;
    }

    public function actionLogin()
    {
        $email = '';
        $password = '';
        $userId = '';

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = [];

            //Валидация полей
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть кароче 6-ти символов';
            }

            //Проверяем существует ли пользователь
            $userId = User::checkUserData($email, $password);
            if (!$userId) {
                //Если данные неправильные показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId);
                //Перенаправляем пользователя в закрытую часть - кабинет
                require_once (ROOT . '/views/cabinet/index.php');
                return true;
            }
        }
        require_once (ROOT . '/views/user/login.php');
        return true;
    }

    public function actionLogout ()
    {
        User::saveProductsId();
        session_destroy();
        header("Location: /");
        return true;
    }
}
