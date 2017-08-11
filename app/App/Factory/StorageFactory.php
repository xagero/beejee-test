<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 19:05
 */

namespace App\Factory;

use App\Storage\AdapterInterface;
use App\Storage\MysqlAdapter;
use Psr\Container\ContainerInterface;
use RuntimeException;

/**
 * Class StorageFactory
 * @package App\Factory
 */
class StorageFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @return AdapterInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $key = 'app/database';
        if (!isset($config[$key])) {
            throw new RuntimeException('Invalid config provided');
        }

        $db = $config[$key];
        $storage = new MysqlAdapter($db['host'], $db['port'], $db['dbname']);
        $storage->connect($db['username'], $db['password']);

        return $storage;
    }
}
