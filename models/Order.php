<?php

class Order
{
    public const SHOW_BY_DEFAULT = 50;

    /**
     * Сохранение заказа
     * @param type $name
     * @param type $email
     * @param type $password
     * @return type
     */
    public static function save($userName, $userPhone, $userComment, $userId)
    {
        $sql = 'INSERT INTO product_order SET '
            . 'user_name = :user_name, '
            . 'user_phone = :user_phone, '
            . 'user_comment = :user_comment, '
            . 'user_id = :user_id, '
            . 'order_price = :order_price, '
            . 'products = :products';
        $params['user_name'] = $userName;
        $params['user_phone'] = $userPhone;
        $params['user_comment'] = $userComment;
        $params['user_id'] = $userId;
        $orderPrice = 0;
        foreach ($_SESSION['productsInCartWithAllParameters'] as $key => $value) {
            $ProductsInCartWithPriceAndQuantity[$value['id']]['id'] = $value['id'];
            $ProductsInCartWithPriceAndQuantity[$value['id']]['price'] = $value['price'];
            $ProductsInCartWithPriceAndQuantity[$value['id']]['quantity'] = $_SESSION['productsInCart'][$value['id']];
            $orderPrice += $value['price'] * $_SESSION['productsInCart'][$value['id']];
        }
        $params['order_price'] = $orderPrice;
        $params['products'] = json_encode($ProductsInCartWithPriceAndQuantity);
        return Db::executeQuery($sql, $params);
    }

    /**
     * Возвращает список заказов
     * @return array
     */
    public static function getOrdersList()
    {
        $sql = 'SELECT * FROM product_order';
        $params = array();
        return Db::executeQuery($sql, $params, Db::FETCH_ALL);
    }

    /**
     * Возвращает информацию о заказе
     * @return array
     */
    public static function getOrderById($id)
    {
        $sql = 'SELECT * FROM product_order WHERE id = :id';
        $params['id'] = $id;
        return Db::executeQuery($sql, $params, Db::FETCH);
    }

    /**
     * Возвращает имя статуса
     * @param type $status
     * @return string
     */
    public static function statusName($status)
    {
        switch ($status) {
            case 0:
                return 'на рассмотрении';
            case 1:
                return 'собирается';
            case 2:
                return 'отправлен';
            case 3:
                return 'на складе';
            case 4:
                return 'у курьера';
        }
    }

    /**
     * Изменяет информацию в заказе
     * @param array $options <p>Массив с информацией о заказе</p>
     * @return boolean <p>Результат выполнения функции</p>
     */
    public static function updateOrder($options)
    {
        $sql = 'UPDATE product_order SET '
            .'status_id = :status_id, '
            .'user_comment = :user_comment '
            .'WHERE id = :id';
        return Db::executeQuery($sql, $options);
    }

    /**
     * Возвращает общую сумму заказа по Id (через обращения к БД если не передан массив)
     * @param int $id <p>Id корзины</p>
     * @return type <p>Сумма заказа</p>
     */
    public static function getTotalPriceIdOrder(int $id, array $order = [])
    {
        if (empty($order)) {
            $sql = 'SELECT products FROM product_order WHERE id = :id';
            $params['id'] = $id;
            $order = array();
            $order = Db::executeQuery($sql, $params, Db::FETCH);
        }
        $productsInCartWithPrice = array();
        $productsInCartWithPrice = json_decode($order['products'], true);
        $total = 0;
        //Подсчитываем количество
        if ($productsInCartWithPrice) {
            foreach ($productsInCartWithPrice as $key => $value) {
                $total += $value['quantity'] * $value['price'];
            }
        }
        return $total;
    }


    /**
     * Удаляет заказ
     * @param integer $id <p>ID заказа, который нужно удалить</p>
     * @return boolean <p>Результат выполнения</p>
     */
    public static function deleteOrderById($id)
    {
        $sql = 'DELETE FROM product_order WHERE id = :id';
        $params['id'] = $id;
        return Db::executeQuery($sql, $params);
    }

    /**
     *
     * @param string $sortedType
     * @param int $page
     * @param int $showRowCount
     * @return array|bool|mixed|string
     */
    public static function getSortedOrdersList($sortedType = 'date', $page = 1, $showRowCount = self::SHOW_BY_DEFAULT)
    {
        $offset = ($page - 1) * $showRowCount;

        //Полноценный кастыль, т.к. у PDO нет возможности подставлять неименование столбца сортировки.
        $sortOptions = ['date', 'status_id','order_price'];
        $sortedType = in_array($sortedType, $sortOptions) ? $sortedType : 'date';

        $sql = "SELECT * FROM product_order 
                ORDER BY " . $sortedType . " DESC
                LIMIT :offset, :count";

        $params['count'] = $showRowCount;
        $params['offset'] = $offset;
        return Db::executeQuery($sql, $params, Db::FETCH_ALL);

    }

    /**
     * Возвращает массив в виде "статус заказа" - "количество заказов"
     * @return array
     */
    public static function getAllIrdersByStatus() : array
    {
        $sql = 'SELECT s.name, COUNT(p_o.id) count'
            . ' FROM product_order p_o JOIN status s '
            . 'ON s.status_id = p_o.status_id '
            . 'GROUP BY s.name ORDER BY s.status_id';
        return Db::executeQuerySelect($sql, Db::FETCH_ALL);
    }

    /**
     * Возвращает массив в виде "день недели" - "количество заказов"
     * @return array
     */
    public static function geTallOrdersByDayOfTheWeek() : array
    {
        $sql = 'SELECT COUNT(id) count FROM product_order GROUP BY DAYOFWEEK(date)';
        return Db::executeQuerySelect($sql, Db::FETCH_ALL);
    }

    public static function getTotalOrders()
    {
        $sql = 'SELECT count(*) as count FROM product_order';
        return Db::executeQuerySelect($sql, Db::FETCH_COLUMN);
    }

    public static function getTotalOrdersCategory()
    {
        $sql = 'SELECT status, count(*) FROM product_order GROUP BY status';
        return Db::executeQuerySelect($sql, Db::FETCH_COLUMN);
    }

}