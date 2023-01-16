<?php
/**
 * 程序引导文件
 */

define('PROJECT_DIR', dirname(dirname(__FILE__)));
define('MODULE_DIR', dirname(__FILE__));
defined('DS') || define('DS', DIRECTORY_SEPARATOR);

//引入composer
$composerAutoload = MODULE_DIR . DS . 'vendor' . DS . 'autoload.php';
if (file_exists($composerAutoload)) {
    require $composerAutoload;
}

$moduleAutoloader = MODULE_DIR . DS . 'autoloader' . DS . 'Autoloader.php';
$projectAutoloader = PROJECT_DIR . DS . 'autoloader' . DS . 'Autoloader.php';
if (file_exists($moduleAutoloader)) {
    require $moduleAutoloader;
} else if (file_exists($projectAutoloader)) {
    require $projectAutoloader;
} else {
    throw new \Exception("Autoloader Not Found!");
}

/**
 * todo 添加当前模块的命名空间
 */
$autoloader = Autoloader::getInstance();
$autoloader->addNamespace('module', MODULE_DIR);
$autoloader->register();