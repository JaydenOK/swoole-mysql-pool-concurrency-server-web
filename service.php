<?php
/**
 * @author https://github.com/JaydenOK
 */
error_reporting(-1);
ini_set('display_errors', 1);

require 'bootstrap.php';

$manager = new module\server\HttpServerManager();
$manager->run($argv);
