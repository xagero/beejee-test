<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 10.08.2017 13:18
 */

namespace App\Controller;

use App\Repository\TaskRepositoryInterface;
use App\Service\AuthService;
use App\Service\PaginatorService;
use App\Service\UploadImageService;
use Throwable;

/**
 * Class TaskController
 * @package App\Controller
 */
class TaskController extends AbstractController
{
    /**
     * @var AuthService
     */
    protected $auth;

    /**
     * @var TaskRepositoryInterface
     */
    protected $taskRepository;

    /**
     * @var UploadImageService
     */
    protected $upload;

    /**
     * @var PaginatorService
     */
    protected $paginator;

    /**
     * @param AuthService $auth
     */
    public function setAuth(AuthService $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param TaskRepositoryInterface $taskRepository
     */
    public function setTaskRepository(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param UploadImageService $upload
     */
    public function setUpload(UploadImageService $upload)
    {
        $this->upload = $upload;
    }

    /**
     * @param PaginatorService $paginator
     */
    public function setPaginator(PaginatorService $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * Create task
     */
    public function createAction()
    {
        $return = [];

        if ('POST' == $this->request->method()) {

            $image = null;

            if (isset($_FILES['upload'])) {

                try {
                    $image = $this->upload->process($_FILES['upload']);
                } catch (Throwable $e) {
                    return ['message' => 'Не могу загрузить изображение: ' . $e->getMessage()];
                }

            }

            $username = $this->request->param('username', null);
            $email = $this->request->param('email');
            $text = $this->request->param('text');

            /** @todo Нужны нормальные валидаторы */
            if (!$username) {
                return ['message' => 'Некорректное имя пользователя'];
            }

            if (mb_strlen($username) > 50) {
                return ['message' => 'Некорректное имя пользователя'];
            }

            if (!$email) {
                return ['message' => 'Некорректный email'];
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return ['message' => 'Некорректный email'];
            }

            if (!$text) {
                return ['message' => 'Некорректное задание'];
            }

            if (mb_strlen($text) > 200) {
                return ['message' => 'Описание слишком большое'];
            }

            $result = $this->taskRepository->create($username, $email, $text, $image);

            if ($result) {
                $redirect = '/index.php?result=%1$s&page=1&sortby=id&sortdir=desc';
                $this->response->redirect(sprintf($redirect, 'success'));
            }
        }



        return $return;
    }

    /**
     * Remove task form database
     */
    public function deleteAction()
    {
        if (!$this->auth->get()) {
            $this->response->redirect('/index.php?result=disabled');
        }

        $id = $this->request->param('id', null);
        if (!intval($id)) {
            $this->response->redirect('/index.php');
        }

        $page = $this->request->param('page', 1);
        if (!intval($page)) {
            $this->response->redirect('/index.php');
        }

        $sortby = $this->request->param('sortby', 'username');
        $sortdir = $this->request->param('sorddir', 'desc');

        $redirect = '/index.php?result=%1$s&page=%2$d&sortby=%3$s&sorddir=%4$s';

        if (false != ($result = $this->taskRepository->delete($id))) {
            $this->response->redirect(sprintf($redirect, 'success', $page, $sortby, $sortdir));
        }

        $this->response->redirect(sprintf($redirect, 'fail', $page, $sortby, $sortdir));
    }

    /**
     * Change status action
     */
    public function statusAction()
    {
        if (!$this->auth->get()) {
            $this->response->redirect('/index.php?result=disabled');
        }

        $id = $this->request->param('id', null);
        if (!intval($id)) {
            $this->response->redirect('/index.php');
        }

    }
}

