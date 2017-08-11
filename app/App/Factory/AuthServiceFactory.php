<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 10.08.2017 11:58
 */

namespace App\Factory;

use App\Service\AuthService;
use Psr\Container\ContainerInterface;
use RuntimeException;

/**
 * Class AuthServiceFactory
 * @package App\Factory
 */
class AuthServiceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $key = 'app/admin';
        if (!isset($config[$key])) {
            throw new RuntimeException('Invalid config provided');
        }

        $admin = $config[$key];

        $service = new AuthService();
        $service->setAdmin($admin);

        return $service;
    }
}
