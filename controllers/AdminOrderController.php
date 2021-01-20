<?php
// ссылка на пространство имен
use Dompdf\Dompdf;
class AdminOrderController extends AdminBase
{
    public function actionIndex($sortedType = 'status_id', $page = 1)
    {
        // read user request (route, get params, ets..)
        // generate data for view (with help of user request and models)
        // pass generated data into view (retrieve html or json string)
        // push generated response to user

        //Проверка доступа
        self::checkAdmin();

        $showRowCount = 10;
        $orders = array();
        $orders = Order::getSortedOrdersList($sortedType, $page, $showRowCount);
        $orderList = $orders;
        foreach ($orders as $key => $value) {
            $orderList[$key]['cost'] = Order::getTotalPriceIdOrder($value['id'], $value);
        }

        $total = Order::getTotalOrders();
        $allOrdersByStatus = array();
        $allOrdersByStatus = Order::getAllIrdersByStatus();
        $allOrdersByDayOfTheWeek = array();
        $allOrdersByDayOfTheWeek = Order::geTallOrdersByDayOfTheWeek();
        $daysOfTheWeek[] = array();
        $daysOfTheWeek = ['понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье'];

        //Создаем объект Pagination - постраничная навигация
        $pagination = new PaginationAdmin($total, $page, $showRowCount, 'page-');

        if (isset($_REQUEST['save'])) {
            //Если кнопка скачать в PDF нажата нажата
            //Проверка доступа
            self::checkAdmin();
            $orders = Order::getSortedOrdersList($sortedType, 1, 20);
            $ordersList_PDF = $orders;
            foreach ($orders as $key => $value) {
                $ordersList_PDF[$key]['cost'] = Order::getTotalPriceIdOrder($value['id'], $value);
            }
            $output = '<table  border="1" cellpadding="4" style="font-family: DejaVu Sans; border-collapse: collapse; text-align: center; height: 500px">    
            <tr style="height: 50px">
                <th style="width: 5%">№ <br/>заказа</th>
                <th style="width: 10%">ID <br/>заказа</th>
                <th style="width: 25%">Имя покупателя</th>
                <th style="width: 8%">Сумма заказа</th>
                <th style="width: 17%">Телефон покупателя</th>
                <th style="width: 10%">Дата оформления</th>
                <th style="width: 10%">Статус</th>
            </tr>';
            $n = 0;
            foreach ($ordersList_PDF as $order):
                $n += 1;
                $output .= '
                <tr>
                    <td>'.$n.'</td>
                    <td>'.$order['id'].'</td>
                    <td>'.$order['user_name'].'</td>
                    <td>'.$order['cost'].'</td>
                    <td>'.$order['user_phone'].'</td>
                    <td>'.$order['date'].'</td>
                    <td>'.Order::statusName($order['status_id']).'</a></td>
                </tr>';
            endforeach;
            $output .= '</table>';

            // создаем и используем класс
            $dompdf = new  Dompdf();
            $dompdf -> loadHtml ($output);
            // (Необязательно) Настройка формата и ориентации бумаги
            $dompdf -> setPaper ( 'A4' , 'landscape' );
            // Визуализировать HTML как PDF
            $dompdf -> render ();
            // Вывод сгенерированного PDF в браузер
            $dompdf -> stream ();
        }



        require_once(ROOT . '/views/admin_order/index.php');

        return true;
    }

    public function actionUpdate($id)
    {
        //Проверка доступа
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            //Если форма отправлена
            //Получаем данные из формы
            $options['id'] = $id;
            $options['status_id'] = $_POST['status'];
            $options['user_comment'] = $_POST['description'];
            //Ошибки в форме
            $errors = [];
            //Валидация значений
            if ($options['status_id'] > 6) {
                $errors[] = 'некорретен статус';
            }

            if (count($errors) == 0) {
                //Если ошибок нет
                //Добавляем новый товар
                Order::updateOrder($options);
                // Перенаправляем пользователя на страницу управлениями товарами
                header("Location: /admin/order/date");
            }
        }
        $order = array();
        $order = Order::getOrderById($id);
        $productsInOrder = array();
        $productsInOrder = json_decode($order['products'], true);
        $products = Product::getProductsByIds(array_keys($productsInOrder));
        $totalPrice = Order::getTotalPriceIdOrder($id, $order);
        require_once(ROOT . '/views/admin_order/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        if (!isset($_SESSION['HTTP_REFERER'])) {
            self::checkAdmin();
            $_SESSION['HTTP_REFERER'] = str_replace("http://" . $_SERVER['HTTP_HOST'], '', $_SERVER['HTTP_REFERER']);
        }
        if (isset($_REQUEST['delete'])) {
            //Если кнопка удалить нажата
            //Проверка доступа
            self::checkAdmin();
            //Удаляем товар
            Order::deleteOrderById($id);
            header("Location:" . $_SESSION['HTTP_REFERER']);
            unset($_SESSION['HTTP_REFERER']);
            return true;
        }
        if (isset($_REQUEST['cancel'])) {
            //Если кнопка отмена нажата нажата
            //Проверка доступа
            self::checkAdmin();
            header("Location:" . $_SESSION['HTTP_REFERER']);
            unset($_SESSION['HTTP_REFERER']);
            return true;
        }
        $order = array();
        $order = Order::getOrderById($id);
        $totalPrice = Order::getTotalPriceIdOrder($id);
        //Подключаем вид
        require_once (ROOT . '/views/admin_order/delete.php');
        return true;
    }


}