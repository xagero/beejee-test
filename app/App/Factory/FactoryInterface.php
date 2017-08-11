<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 19:06
 */

namespace App\Factory;

use Psr\Container\ContainerInterface;

/**
 * Interface FactoryInterface
 * @package App\Factory
 */
interface FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @return mixed
     */
    public function __invoke(ContainerInterface $container);
}