<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 10.08.2017 19:34
 */

namespace App\Factory;

use App\Service\PaginatorService;
use Psr\Container\ContainerInterface;
use RuntimeException;

/**
 * Class PaginatorServiceFactory
 * @package App\Factory
 */
class PaginatorServiceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @return PaginatorService
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $key = 'module/app/paginator';
        if (!isset($config[$key])) {
            throw new RuntimeException('Invalid config provided');
        }

        $data = $config[$key];

        $service = new PaginatorService();
        $service->setConfig($data);

        return $service;
    }
}
