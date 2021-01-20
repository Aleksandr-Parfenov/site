<?php

class AdminCategoryController extends AdminBase
{
    public function actionIndex()
    {
        //Проверка доступа
        self::checkAdmin();
        $categoryList = Category::getCategoriesListAdmin();
        require_once(ROOT . '/views/admin_category/index.php');
        return true;
    }

    public function actionDelete($id)
    {
        if (isset($_REQUEST['delete'])) {
            //Если кнопка удалить нажата
            //Проверка доступа
            self::checkAdmin();
            //Удаляем товар
            Category::deleteCategoryById($id);
            header("Location: /admin/category");
            return true;
        }
        $category = Category::getCategoryById($id);
        //Подключаем вид
        require_once (ROOT . '/views/admin_category/delete.php');
        return true;
    }

    public function actionCreate()
    {
        //Проверка доступа
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            //Если форма отправлена
            //Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];
            //Ошибки в форме
            $errors = [];
            //Валидация значений
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'заполните название категории';
            }

            if (count($errors) == 0) {
                //Если ошибок нет
                //Добавляем новый товар
                Category::createCategory($options);
                // Перенаправляем пользователя на страницу управлениями товарами
                header("Location: /admin/category");
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_category/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        //Проверка доступа
        self::checkAdmin();
        //Получаем список категорий для всплывающего списка
        $category = Category::getCategoryById($id);
        if (isset($_POST['submit'])) {
            //Если форма отправлена
            //Получаем данные из формы
            $options['id'] = $id;
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];
            //Ошибки в форме
            $errors = [];
            //Валидация значений
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'заполните название категории';
            }

            if (count($errors) == 0) {
                //Если ошибок нет
                //Добавляем новый товар
                Category::updateCategory($options);
                // Перенаправляем пользователя на страницу управлениями товарами
                header("Location: /admin/category");
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_category/update.php');
        return true;
    }

}