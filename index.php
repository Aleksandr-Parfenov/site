<?php
//$GLOBALS['init'] = microtime(true);

//1. Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();

//2. Подключение файлов системы
define('ROOT', dirname(__FILE__));
if ($_SERVER['HTTP_HOST'] == "localhost" OR $_SERVER['HTTP_HOST'] == "pinsk-mebel.by") {
    define('DB_PARAMS', '/config/db_params.php');
} else {
    define('DB_PARAMS', '/config/db_params_web.php');
}
require_once(ROOT.'/components/Autoload.php');


//3. Установим местное время севрера
date_default_timezone_set('Europe/Minsk');




// 4. Вызов Router
$router = new Router();
$router->run();

//var_dump(microtime(true) - $GLOBALS['init']);