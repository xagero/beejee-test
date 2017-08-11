<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 10.08.2017 10:48
 */

namespace App\Factory;

use App\Controller\AdminController;
use App\Request;
use App\Response;
use App\Service\AuthService;
use Psr\Container\ContainerInterface;

/**
 * Class AdminControllerFactory
 * @package App\Controller
 */
class AdminControllerFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        $controller = new AdminController();
        $controller->setRequest($container->get(Request::class));
        $controller->setResponse($container->get(Response::class));
        $controller->setAuth($container->get(AuthService::class));

        return $controller;
    }
}
