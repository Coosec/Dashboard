<?php

/**
 * Jakub "Jacob" Kadzielawa
 * programujemy.net
 * 25.03.17
 */


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL );
define('APP_PATH',$_SERVER['DOCUMENT_ROOT']."/Jacob/");
define('APP_PATH_VIEWS',$_SERVER['DOCUMENT_ROOT']."/Jacob/Views/");
//twitter autoloader
require_once "Libs/twitter/twitteroauth/autoload.php";

spl_autoload_register(function($className)
{

    $namespace=str_replace("\\","/",__NAMESPACE__);
    $className=str_replace("\\","/",$className);
    $class=__DIR__."/".(empty($namespace)?"":$namespace."/")."{$className}.php";

    if(file_exists($class))
    include_once($class);
 });

$request = new \Jacob\Core\Request($_REQUEST);
$router = new \Jacob\Core\Router($request);

