<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 10.08.2017 13:29
 */

namespace App\Factory;

use App\Controller\TaskController;
use App\Repository\TaskRepositoryInterface;
use App\Request;
use App\Response;
use App\Service\AuthService;
use App\Service\PaginatorService;
use App\Service\UploadImageService;
use Psr\Container\ContainerInterface;

/**
 * Class TaskControllerFactory
 * @package App\Factory
 */
class TaskControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @return TaskController
     */
    public function __invoke(ContainerInterface $container)
    {
        $controller = new TaskController();
        $controller->setRequest($container->get(Request::class));
        $controller->setResponse($container->get(Response::class));
        $controller->setAuth($container->get(AuthService::class));
        $controller->setTaskRepository($container->get(TaskRepositoryInterface::class));
        $controller->setUpload($container->get(UploadImageService::class));
        $controller->setPaginator($container->get(PaginatorService::class));

        return $controller;
    }
}
