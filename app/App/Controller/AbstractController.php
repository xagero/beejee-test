<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 21:50
 */

namespace App\Controller;

use App\Request;
use App\Response;

/**
 * Class AbstractController
 * @package App\Controller
 */
abstract class AbstractController implements ControllerInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Response $response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     *
     */
    public function dispatchBeforeAction()
    {
        return true;
    }

}
