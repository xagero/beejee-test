<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 19:59
 */

namespace App\Factory;

use App\Controller\IndexController;
use App\Repository\TaskRepositoryInterface;
use App\Request;
use App\Response;
use App\Service\AuthService;
use App\Service\PaginatorService;
use Psr\Container\ContainerInterface;

/**
 * Class IndexControllerFactory
 * @package App\Factory
 */
class IndexControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        $controller = new IndexController();
        $controller->setRequest($container->get(Request::class));
        $controller->setResponse($container->get(Response::class));
        $controller->setAuth($container->get(AuthService::class));
        $controller->setTaskRepository($container->get(TaskRepositoryInterface::class));
        $controller->setPaginator($container->get(PaginatorService::class));

        return $controller;
    }
}
