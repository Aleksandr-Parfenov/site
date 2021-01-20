<?php

class User
{
    public  static function register($name, $email, $password)
    {
        $sql = 'INSERT INTO user SET '
            . 'name = :name, '
            . 'email = :email, '
            . 'password = :password';
        $params['name'] = $name;
        $params['email'] = $email;
        $params['password'] = $password;
        return Db::executeQuery($sql, $params);
    }

    public  static function checkName($name) {
        return strlen($name) >= 2 ? true : false;
    }

    public  static function checkPassword($password) {
        return strlen($password) >= 6 ? true : false;
    }

    public  static function checkEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    public static function checkPhone($phone)
    {
        return strlen($phone) >= 11 ? true : false;
    }

    public static function checkEmailExist($email)
    {
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
        $params['email'] = $email;
        return Db::executeQuery($sql, $params, Db::FETCH_COLUMN);
    }

    public static function checkUserData($email, $password)
    {
        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';
        $params['email'] = $email;
        $params['password'] = $password;
        return Db::executeQuery($sql, $params, Db::FETCH_COLUMN);
    }

    public static function auth($userId)
    {
        $sql = 'SELECT * FROM user WHERE id = :id';
        $params['id'] = $userId;
        $user = array();
        $user = Db::executeQuery($sql, $params, Db::FETCH);
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['productsInCart'] = json_decode($user['products'], true);
        if ($user['status'] == 'admin') {
            $_SESSION['status'] = $user['status'];
        }
        return true;
    }

    public static function editName($id, $newName)
    {
        $sql = "UPDATE user SET name = :newName WHERE id = :id";
        $params['newName'] = $newName;
        $params['id'] = $id;
        if (Db::executeQuery($sql, $params)) {
            $_SESSION["name"] = $newName;
            return true;
        }
        return 0;
    }

    public static function getUserId()
    {
        return isset ($_SESSION["id"]) ? $_SESSION["id"] : 0;
    }

    public static function getUserName()
    {
        return isset ($_SESSION["name"]) ? $_SESSION["name"] : 0;
    }

    /**
     * Сохранение данных в корзине пользователя
     */
    public static function saveProductsId()
    {
        $sql = 'UPDATE user SET products = :products WHERE id = :id';
        $params['products'] = json_encode(Cart::getProducts());
        $params['id'] = $_SESSION['id'];
        return Db::executeQuery($sql, $params);
    }
}