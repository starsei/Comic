<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function myAutoloader($className)
{
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $defaultPath = __DIR__ ."/$classPath.php";
    $otherPaths = [
        __DIR__. '/options/'. $classPath. '.php',
        __DIR__. '/utils/'. $classPath. '.php'
    ];
    if (file_exists($defaultPath)) {
        require_once $defaultPath;
    } else {
        foreach ($otherPaths as $path) {
            if (file_exists($path)) {
                require_once $path;
                return;
            }
        }
    }
}
spl_autoload_register('myAutoloader');