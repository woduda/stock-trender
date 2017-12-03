<?php

namespace WoDuda\StockTrender;

use Doctrine\ORM\Tools\Setup;
use Doctrine\DBAL\Logging\EchoSQLLogger;

class EntityManager
{
    static $instances;

    public static function instance($name = 'default')
    {
        require ROOTPATH."config/doctrine.php";

        if (isset(self::$instances[$name]))
            return self::$instances[$name];

        $conn = $db[$name];

        $entityPaths = [ ROOTPATH."src/WoDuda/StockTrender/Entity" ];

        $config = Setup::createAnnotationMetadataConfiguration($entityPaths, $conn['dev_mode']);

        if ($conn['dev_mode']) {
            $cache = new \Doctrine\Common\Cache\ArrayCache;
            $config->setAutoGenerateProxyClasses(true);
        } else {
            $cache = new \Doctrine\Common\Cache\ApcCache;
            $config->setAutoGenerateProxyClasses(false);
        }
        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);
        $config->addEntityNamespace('e', 'WoDuda\\StockTrender\\Entity');
        $config->setProxyDir(ROOTPATH."src/WoDuda/StockTrender/Proxy");
        // $logger = new EchoSQLLogger;
        // $config->setSQLLogger($logger);

        // obtaining the entity manager
        self::$instances[$name] = \Doctrine\ORM\EntityManager::create($conn, $config);

        return self::$instances[$name];
    }
}
