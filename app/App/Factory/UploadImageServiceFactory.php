<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 10.08.2017 14:44
 */

namespace App\Factory;

use App\Service\UploadImageService;
use Psr\Container\ContainerInterface;

/**
 * Class UploadImageServiceFactory
 * @package App\Service
 */
class UploadImageServiceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @return mixed
     */
    public function __invoke(ContainerInterface $container)
    {
        $service = new UploadImageService();

        return $service;
    }
}
