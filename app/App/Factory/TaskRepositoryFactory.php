<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 19:52
 */

namespace App\Factory;

use App\Repository\TaskRepository;
use App\Storage\AdapterInterface;
use Psr\Container\ContainerInterface;

/**
 * Class TaskRepositoryFactory
 * @package App\Factory
 */
class TaskRepositoryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        $adapter = $container->get(AdapterInterface::class);

        $repository = new TaskRepository();
        $repository->setStorage($adapter);

        return $repository;
    }
}

