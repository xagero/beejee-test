<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 16:28
 */

namespace App;

use App\Controller\AbstractController;
use App\Controller\IndexController;
use App\Repository\TaskRepositoryInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;
use Throwable;

/**
 * Class Server
 * @package App
 */
class Server implements ContainerInterface
{
    /**
     * @var array
     */
    protected $container;

    /**
     * Setup entry into the container
     *
     * @param $key
     * @param $data
     */
    public function set($key, $data)
    {
        $this->container[$key] = $data;
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get($id)
    {
        if (array_key_exists($id, $this->container)) {
            return $this->container[$id];
        }

        throw new RuntimeException("Invalid entry key: {$id}, or service not exists");
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($id)
    {
        return array_key_exists($id, $this->container);
    }

    /**
     * Create service form factory
     *
     * @param $factory
     * @return mixed
     */
    public function create($factory)
    {
        $factory = new $factory();
        return $factory($this);
    }

    /**
     * @return $this
     */
    public function dispatch()
    {
        /** @var Request $request */
        $request = $this->get(Request::class);
        $action = $request->param('action', 'index');

        try {

            $route = $this->get('config')['app/route'];

            if (!isset($route[$action])) {
                throw new RuntimeException('Invalid request');
            }

            /** @var AbstractController $controller */
            $controller = $this->get($route[$action]['controller']);

            $controller->dispatchBeforeAction();

            $method = $route[$action]['action'];
            $call = [$controller, $method . 'Action'];
            $result = call_user_func($call);

            /** @var Response $response */
            $response = $this->get(Response::class);
            $response->setContent($result);
            $response->setTemplate($route[$action]['template']);

        } catch (Throwable $e) {
            /** @todo code me! */
            echo $e->getMessage();
            die();
        }

        return $this;
    }

    /**
     * display response
     */
    public function display()
    {
        print $this->get(Response::class);
    }

}
