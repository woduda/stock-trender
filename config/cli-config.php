<?php
require_once "config/bootstrap.php";

use Doctrine\Common\ClassLoader;
use WoDuda\StockTrender\EntityManager;

$classLoader = new ClassLoader('WoDuda\StockTrender\Migration', ROOTPATH.'src');
$classLoader->register();

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(
    EntityManager::instance()
);
