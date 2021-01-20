<?php

spl_autoload_register('shopAutoloader');
require_once(ROOT . "/vendor/autoload.php");

function shopAutoloader($class_name)
{
    $array_paths = array(
        '/models/',
        '/components/'
    );

    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}