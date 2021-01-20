<?php

class AdminGenerateController
{
    public function actionIndex()
    {
        if (isset($_POST['submit'])) {
            //Если форма отправлена
            //Получаем данные из формы
            $options['quantity'] = $_POST['quantity'];
            if (ctype_digit($options['quantity'])) {
                if(GeneratorRandom::order($options['quantity'])) {
                    $strGenerate = 'Сгенерировано ' . $options['quantity'] . ' ед. заказов';
                }
            }
        }
        require_once(ROOT . '/views/admin_generate/index.php');
        return true;
    }
}
