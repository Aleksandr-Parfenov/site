<?php

class Category
{

    public static function getCategoriesList()
    {
        $sql = 'SELECT id, name FROM category '
            . 'WHERE status = "1"'
            . 'ORDER BY sort_order ASC ';
        return Db::executeQuerySelect($sql, Db::FETCH_ALL);
    }

    public static function getCategoriesListAdmin()
    {
        $sql = 'SELECT * FROM category '
            . 'ORDER BY sort_order ASC';
        return Db::executeQuerySelect($sql, Db::FETCH_ALL);
    }

    public static function getCategoryById($id)
    {
        $sql = 'SELECT * FROM category WHERE id = :id';
        $params['id'] = $id;
        $pdoIsntruction = 'fetch';
        return Db::executeQuery($sql, $params, $pdoIsntruction);
    }

    /**
     * Удаляет категорию из каталога
     * @param integer $id <p>ID категории, которую нужно удалить</p>
     * @return boolean <p>Результат выполнения</p>
     */
    public static function deleteCategoryById($id)
    {
        $sql = 'DELETE FROM category WHERE id = :id';
        $params['id'] = $id;
        return Db::executeQuery($sql, $params);
    }

    /**
     * Добавляет новую категорию
     * @param array $options <p>Массив с информацией о категории</p>
     * @return boolean <p>Результат выполнения функции</p>
     */
    public static function createCategory($options)
    {
        // Текст запроса к БД
        $sql = 'INSERT INTO category SET '
            .'name = :name, '
            .'sort_order = :sort_order, '
            .'status = :status';
        return Db::executeQuery($sql, $options);
    }

    /**
     * Изменяет информацию в категории
     * @param array $options <p>Массив с информацией о категории</p>
     * @return boolean <p>Результат выполнения функции</p>
     */
    public static function updateCategory($options)
    {
        // Текст запроса к БД
        $sql = 'UPDATE category SET '
            .'name = :name, '
            .'sort_order = :sort_order, '
            .'status = :status '
            .'WHERE id = :id';
        return Db::executeQuery($sql, $options);
    }
}