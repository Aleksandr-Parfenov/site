<?php

/**
 * Абстрактный класс AdminBase содержит общую логику дл яконтроллеровб которые
 * исползуются в панели администратора
 */
abstract class AdminBase
{
    /**
     * Метод, который проверяет пользователя на то, является ли он администором
     * @return boolean
     */
    public static function checkAdmin()
    {
        //проверяет является ли пользователь со статусом "admin"
        if (isset($_SESSION['status'])) {
            if ($_SESSION['status'] == 'admin') {
                return true;
            }
        }

        //Иначе завершаем работу с сообщением об закрытие доступа
        die('Access denied');
    }
}