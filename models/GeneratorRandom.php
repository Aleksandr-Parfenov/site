<?php

class GeneratorRandom

{
    private static $productsIds = array();
    private static $productsPrice = array();

    public static function getProductsIdsList()
    {
        $sql = 'SELECT id, price FROM product';
        $idsPrice = array();
        $idsPrice = Db::executeQuerySelect($sql);
        $productsIsd = array();
        $productsPrice = array();
        foreach ($idsPrice as $key => $value) {
            self::$productsIds[] = $value['id'];
            self::$productsPrice[$value['id']] = $value['price'];
        }
        return true;
    }

    public static function order($quantity)
    {
        self::getProductsIdsList();
        $productsIds = array();
        $productsPrice = array();

        for ($a = 1;$a <= $quantity; ++$a) {
            $productsIds = self::$productsIds;
            $productsPrice = self::$productsPrice;
            $name = ['Александр', 'Сергей', 'Иван', 'Макисим', 'Андрей', 'Игорь', 'Богдан', 'Марк', 'Семён'];
            $surname = ['Александрович', 'Сергеевич', 'Макисимыч', 'Иванович', 'Федорович', 'Евгеньевич',
                '', '', '', '', '', '', '', '', '', '', '', ''];
            $patronymic = ['Иванов', 'Сидоров', 'Петров', 'Филипов', 'Богданов', 'Анисимов', 'Казлов', 'Петров', 'Иванов'];
            $params['user_name'] = $patronymic[rand(0, count($patronymic) - 1)] . ' '
                . $name[rand(0, count($name) -1)] . ' '
                . $surname [rand(0, count($surname) - 1)];

            $codeMobile = ['+375', '80', '+375', '80', ''];
            $symbolMobile = [' ', '-', ''];
            $symbol = $symbolMobile[rand(0, count($symbolMobile) -1)];
            $codeOperator = ['29', '33', '25', '44'];
            $params['user_phone'] = $codeMobile[rand(0, count($codeMobile) -1)]. $symbol
                . $codeOperator[rand(0, count($codeOperator) -1)]. $symbol
                . rand(112, 989) . $symbol
                . rand(10, 99) . $symbol
                . rand(10, 99);

            $satusBase = [0,0,0,1,2,3,4];
            $params['status_id'] = $satusBase[rand(0, count($satusBase) -1)];

            $products = array();
            $quantityProducts = rand(1, 10);
            $orderPrice = 0;
            for ($i = 1; $i <= $quantityProducts; $i++) {
                $keyId = rand(0, count($productsIds) - 1);
                $id = $productsIds[$keyId];
                $products[$id]['id'] = $id;
                $products[$id]['quantity'] = rand(1, 10);
                $products[$id]['price'] = $productsPrice[$id];
                $orderPrice += $products[$id]['quantity'] * $products[$id]['price'];
                unset($productsIds[$keyId]);
                sort($productsIds);
            }
            $params['products'] = json_encode($products);
            $params['order_price'] = $orderPrice;

            $commentBase = ['Привизите поскорее!', 'Доставте до подьезда!', 'Перезвоните, пожалуйста.', 'Мне нагрубил ваш продавец!' , 'Очень жду.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''];
            $params['user_comment'] = $commentBase[rand(0, count($commentBase) -1)];

            $start = mktime(0,0,0,1,1,2015);
            $end  = time();
            $randomStamp = rand($start,$end);
            $params['date'] = date('Y-m-d H:i:s',$randomStamp);

            $sql = 'INSERT INTO product_order SET '
                . 'user_name = :user_name, '
                . 'user_phone = :user_phone, '
                . 'user_comment = :user_comment, '
                . 'order_price = :order_price, '
                . 'date = :date, '
                . 'status_id = :status_id, '
                . 'products = :products';
            Db::executeQuery($sql, $params);
        }


        return true;
    }


}