<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 22:51
 */

namespace App\Controller;

use App\Service\AuthService;

/**
 * Class AdminController
 * @package App\Controller
 */
class AdminController extends AbstractController
{
    /**
     * @var AuthService
     */
    protected $auth;

    /**
     * @param AuthService $auth
     */
    public function setAuth(AuthService $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Admin login
     */
    public function loginAction()
    {
        if ('admin' == $this->auth->get()) {
            $this->response->redirect('/');
        }

        $return = [
            'identity' => ''
        ];
        if ('POST' == $this->request->method()) {
            $identity = $this->request->param('identity');
            $credential = $this->request->param('credential');

            if ($this->auth->isValid($identity, $credential)) {
                $this->auth->save($identity);
                $this->response->redirect('/');
            }

            $return = [
                'message' => 'Invalid auth!',
                'identity' => $identity
            ];

        }

        return $return;
    }

    /**
     * Admin logout
     */
    public function logoutAction()
    {
        $this->auth->clear();
        $this->response->redirect('/');
    }
}
