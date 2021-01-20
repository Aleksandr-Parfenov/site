<?php

class Product
{
    const SHOW_BY_DEFAULT = 6;
    const SHOW_RECOMMENDED_BY_DEFAULT = 6;

    /**
     * Returns an array of categories
     */
    public static function getLatestProduct($count = self::SHOW_BY_DEFAULT)
    {
        $sql = 'SELECT id, name, price, image, is_new FROM product '
            . 'WHERE status = "1" '
            . 'ORDER BY is_new DESC '
            . 'LIMIT :count';
        $params['count'] = $count;
        return Db::executeQuery($sql, $params, Db::FETCH_ALL);
    }

    /**
     * Returns an array all products
     */
    public static function getProductsList()
    {
        $sql = 'SELECT * FROM product '
            . 'ORDER BY id';
        $params = array();
        return Db::executeQuery($sql, $params, Db::FETCH_ALL);
    }


    /**
     * Возвращает список брендов существующих товаров
     */
    public static function getBrandsList()
    {
        $sql = 'SELECT DISTINCT brand FROM product '
            . 'ORDER BY brand';
        $params = array();
        return Db::executeQuery($sql, $params, Db::FETCH_ALL);
    }

    /**
     * Returns an array  of recommended
     */
    public static function getRecommendedProduct($count = self::SHOW_RECOMMENDED_BY_DEFAULT)
    {
        $sql = 'SELECT id, name, price, image, is_recommended, is_new FROM product '
            . 'WHERE status = "1"'
            . 'ORDER BY is_recommended DESC '
            . 'LIMIT :count';
        $params['count'] = $count;
        return Db::executeQuery($sql, $params, Db::FETCH_ALL);
    }

     /**
     * Returns an array product by categories
     */
     public static function getProductsListByCategory($categoryId = false, $page = 1)
     {
         if ($categoryId) {
             $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
             $sql = 'SELECT id, name, price, image, is_new FROM product '
                 . 'WHERE status = "1" AND category_id = :category_id '
                 . 'ORDER BY id DESC '
                 . 'LIMIT :count '
                 . 'OFFSET :offset ';
             $params['category_id'] = $categoryId;
             $params['count'] = self::SHOW_BY_DEFAULT;
             $params['offset'] = $offset;
             return Db::executeQuery($sql, $params, Db::FETCH_ALL);
         }
     }

    /**
     * Returns product item by id
     */
    public static function getProductById($id)
    {
        $sql = 'SELECT * FROM product WHERE id = :id';
        $params['id'] = $id;
        return Db::executeQuery($sql, $params, Db::FETCH);
    }

    /**
     * Returns product item by id
     */
    public static function getTotalProductsInCategory($categoryId)
    {
        $sql = 'SELECT count(id) AS count FROM product '
            . 'WHERE status="1" AND category_id = :category_id';
        $params['category_id'] = $categoryId;
        $row = Db::executeQuery($sql, $params, Db::FETCH);
        return $row['count'];
    }

    /**
     * Returns product item by id
     */
    public static function getProductsByIds($idsArray)
    {
        $sql = 'SELECT * FROM product WHERE status="1" AND id IN';
        $paramsIn=$idsArray;
        return Db::executeQueryIn($sql, $paramsIn);
    }

    /**
     * Добавляет новый товар
     * @param array $options <p>Массив с информацией о товаре</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createProduct($options)
    {
        // Текст запроса к БД
        $sql = 'INSERT INTO product SET '
            .'name = :name, '
            .'code = :code, '
            .'price = :price, '
            .'category_id = :category_id, '
            .'brand = :brand, '
            .'availability = :availability, '
            .'description = :description, '
            .'is_new = :is_new, '
            .'is_recommended = :is_recommended, '
            .'status = :status';

        return Db::executeQuery($sql, $options, DB::LAST_INSERT_ID);
    }

    /**
     * Ищет товары по введенным кретериям
     * @param array $options <p>Массив с информацией о товаре</p>
     * @return array <p>Массив с описанием найденных товаров</p>
     */
    public static function getProductBySearch($options)
    {
        //TODO: Защитить от SQL инъекций, если будешь выкладывать в сеть
        $params = array();
        $brand = '';
        $category_id = '';
        $name = '';
        if ($options['brand'] != '') {
            $brand = ' AND brand = :brand ';
            $params['brand'] = $options['brand'];
        }
        if ($options['category_id'] != '') {
            $category_id = ' AND category_id = :category_id ';
            $params['category_id'] = $options['category_id'];
        }
        if ($options['name'] != '') {
            $name = ' AND name LIKE "%' . $options['name'] .'%" ';
        }

        $sql = 'SELECT id, name, price, image, is_new FROM product 
                WHERE status = :status AND
                price > :price_from AND 
                price < :price_to AND 
                availability = :availability '
                . $category_id
                . $brand
                . $name
                . 'ORDER BY is_new DESC';
        $params['price_from'] = $options['price_from'];
        $params['price_to'] = $options['price_to'];
        $params['status'] = $options['status'];
        $params['availability'] = $options['availability'];

        return Db::executeQuery($sql, $params, Db::FETCH_ALL);
    }

    /**
     * Обновляем информацию о товаре
     * @param array $options <p>Массив с информацией о товаре</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function updateProduct($options)
    {
        // Текст запроса к БД
        $sql = 'UPDATE product SET '
            .'name = :name, '
            .'code = :code, '
            .'price = :price, '
            .'category_id = :category_id, '
            .'brand = :brand, '
            .'availability = :availability, '
            .'description = :description, '
            .'is_new = :is_new, '
            .'is_recommended = :is_recommended, '
            .'status = :status '
            .'WHERE id = :id';

        return Db::executeQuery($sql, $options);
    }

    /**
     * Удаляет товар и каталога
     * @param integer $шв <p>ID товара, который нужно удалить</p>
     * @return boolean <p>Результат выполнения</p>
     */
    public static function deleteProductById($id)
    {
        $sql = 'DELETE FROM product WHERE id = :id';
        $params['id'] = $id;
        if (Db::executeQuery($sql, $params)) {
            unlink("template/images/cart/{$id}.jpg");
            return true;
        }
        return false;
    }


//    /**
//     * Проверяет что выбирал пользователь
//     * @param string
//     * @return string
//     */
//    public static function showPreviousSelection(string $param)
//    {
//        if (isset($options[$param])) {
//            if ($options[$param])
//        }
//
//        if (Db::executeQuery($sql, $params)) {
//            unlink("template/images/cart/{$id}.jpg");
//            return true;
//        }
//        return false;
//    }
}
