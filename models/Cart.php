<?php

class Cart
{
    /** Добовляет товар в корзину сессии и вовращает сколько всего в корзине
     * @param array $products
     * @return integer
     */
    public static function addProduct(int $id, int $countIdProduct = 1) : int
    {
        $id = intval($id);
        $productsInCart = array();

        if (isset($_SESSION['productsInCart'])) {
            $productsInCart = $_SESSION['productsInCart'];
        }
        //Если товар есть в корзине, но был добавлен еще раз, увеличием количество
        if (isset($productsInCart[$id])) {
            $productsInCart[$id] += $countIdProduct;
        } else {
            $productsInCart[$id] = $countIdProduct;
        }
        $_SESSION['productsInCart'] = $productsInCart;
        return $productsInCart[$id];
    }

    public static function subtractProduct($id, $deleteAllProduct = 0)
    {
        $id = intval($id);
        $deleteAllProduct = intval($deleteAllProduct);
        $productsInCart = array();

        if (isset($_SESSION['productsInCart'])) {
            $productsInCart = $_SESSION['productsInCart'];
        }
        //Если товар есть в корзине, уменьшим количество
        if (isset($productsInCart[$id])) {
            if ($productsInCart[$id] > 0) {
                $productsInCart[$id] --;
            }
            if ($productsInCart[$id] == 0 or $deleteAllProduct == 1) {
                unset($productsInCart[$id]);
                $_SESSION['productsInCart'] = $productsInCart;
                return 0;
            }
            $_SESSION['productsInCart'] = $productsInCart;
            return $productsInCart[$id];
        }
        return 0;
    }

    public static function countItems()
    {
        if (isset($_SESSION['productsInCart']) && !empty($_SESSION['productsInCart'])) {
            $count = 0;
            foreach ($_SESSION['productsInCart'] as $id => $quantity) {
                $count += $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }

    public static function getProducts()
    {
        return isset($_SESSION['productsInCart']) ? $_SESSION['productsInCart'] : false;
    }

//    TODO:Доделать функцию (обновления товаров в корзине без БД)
//    public static function updateRelevanceCartProducts(array $products = [])
//    {
//        $productsInCart = array();
//        $productsInCart = $_SESSION['productsInCart'];
//        foreach ($products as $product) {
//            if(array_key_exists($product['id'], $productsInCart)) {
//                foreach ($productsInCart as $idProduct) {
//                    if ($)
//                }
//            }
//        }
//        return self::getProducts();
//    }

    public static function clear()
    {
        if (isset($_SESSION['productsInCart'])) {
            unset($_SESSION['productsInCart']);
            return true;
        }
        return true;
    }

    public static function getTotalPrice()
    {
        $productsInCart = array();
        $productsInCart = Cart::getProducts();

        if ($productsInCart) {
            //Получаем полную информацию о товарах для списка
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);
            $total = 0;
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
            return $total;
        }
        return 0;
    }

    /** Возвращает стоимость всех покупок в корзине
     * @param array $products
     * @return integer
     */
    public static function getTotalPriceProductsCart(array $products = [])
    {
        if (!empty($products)) {
            $productsInCart = array();
            $productsInCart = Cart::getProducts();
            $total = 0;
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
            return $total;
        } else {
            return 0;
        }
    }


}