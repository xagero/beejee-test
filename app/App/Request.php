<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 16:21
 */

namespace App;

/**
 * Class Request
 * @package App
 */
class Request
{
    /**
     * @var []
     */
    protected $params = [];

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->params = $_REQUEST;
    }

    /**
     * Get param value
     *
     * @param $name
     * @param null $default
     * @return mixed
     */
    public function param($name, $default = null)
    {
        if (array_key_exists($name, $this->params)) {
            return $this->params[$name];
        }

        return $default;
    }

    /**
     * @return mixed
     */
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
