<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 16:53
 */

namespace App\Controller;

use App\Repository\TaskRepositoryInterface;
use App\Service\AuthService;
use App\Service\PaginatorService;

/**
 * Class IndexController
 * @package App\Controller
 */
class IndexController extends AbstractController
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
     * @param PaginatorService $paginator
     */
    public function setPaginator(PaginatorService $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * Before dispatch
     */
    public function dispatchBeforeAction()
    {
        $this->paginator->setCurrentPage(intval($this->request->param('page', 1)));
    }

    /**
     * IndexAction
     */
    public function indexAction()
    {
        $sortby = $this->request->param('sortby', 'id');
        $sortdir = $this->request->param('sortdir', 'DESC');

        $total = $this->taskRepository->countAll();
        $this->paginator->setTotal($total);

        $return = [
            'list' => $this->taskRepository->fetchAll(
                $sortby, $sortdir,
                $this->paginator->getLimit(),
                $this->paginator->getOffset()
            ),
            'total' => $this->taskRepository->countAll(),
            'paginator' => $this->paginator
        ];

        if (null != ($identity = $this->auth->get())) {
            $return['admin'] = $identity;
        }

        return $return;
    }
}
