<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $rotesPath = ROOT.'/config/routes.php';
        $this->routes = include($rotesPath);
    }

    /**
     * Returns request string
     * @return string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
        return true;
    }

    public function run()
    {
        //try {

            // Получить строку запроса
            $uri = $this->getURI();

            // Проверить наличия такого запроса в routes.php
            foreach ($this->routes as $uriPattern => $path) {
                //  Сравниваем $uriPattern и $uri
                if (preg_match("~$uriPattern~", $uri)) {
                    //Фильтр от некорректного адресса -> на главную
                    if ($uriPattern == "") {
                        $uri = "";
                   }
                    // Получаем внутренний путь из внешнего согласно правилу.
                    $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                    // Определяем какой контроллер, action, параметры
                    $segments = explode('/', $internalRoute);

                    $controllerName = array_shift($segments).'Controller';
                    $controllerName = ucfirst($controllerName);
                    $actionName = 'action'.ucfirst(array_shift($segments));
                    $parameters = $segments;

                    // Подключить файл класса-контроллера
                    $controllerFile = ROOT . '/controllers/' .
                        $controllerName . '.php';

                    if (file_exists($controllerFile)) {
                        include_once($controllerFile);
                    }

                    //Создать объект, вызвать метод (т.е. action)
                    $controllerObject = new $controllerName;
                    $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                    if ($result != null) {
                        exit();
                    }
                }
            }
//        }catch (Throwable $throwable){
//            echo '<h1>Something went wrong.</h1>';
//           if($GLOBALS['env']==='dev') {
//                echo $throwable->getMessage();
//           }
//            file_put_contents('log.log', $throwable->getTraceAsString());
//        }

    }
}


