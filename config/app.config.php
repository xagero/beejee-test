<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 17:11
 */

use App\Controller;
use App\Factory;
use App\Repository;
use App\Service;
use App\Storage;

return [

    /** di config */
    'di' => [

        /** Services group */
        Storage\AdapterInterface::class => Factory\StorageFactory::class,
        Repository\TaskRepositoryInterface::class => Factory\TaskRepositoryFactory::class,
        Service\AuthService::class => Factory\AuthServiceFactory::class,
        Service\UploadImageService::class => Factory\UploadImageServiceFactory::class,
        Service\PaginatorService::class => Factory\PaginatorServiceFactory::class,

        /** Controllers group */
        Controller\IndexController::class => Factory\IndexControllerFactory::class,
        Controller\AdminController::class => Factory\AdminControllerFactory::class,
        Controller\TaskController::class  => Factory\TaskControllerFactory::class


    ],

    /** Connection config */
//    'app/database' => [
//        'host' => 'localhost',
//        'port' => 3306,
//        'dbname' => 'beejee_test',
//        'username' => 'root',
//        'password' => 'root'
//    ],
    'app/database' => [
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => 'xagero',
        'username' => 'xagero',
        'password' => 'oKn8nkiu'
    ],

    /** Action per request */
    'app/route' => [

        /** Home page */
        'index' => [
            'controller' => Controller\IndexController::class,
            'action' => 'index',
            'template' => 'view/app/index/index.php'
        ],

        /** CRUD */
        'create' => [
            'controller' => Controller\TaskController::class,
            'action' => 'create',
            'template' => 'view/app/task/create.php'
        ],

        'delete' => [
            'controller' => Controller\TaskController::class,
            'action' => 'delete',
            'template' => null
        ],

        'status' => [
            'controller' => Controller\TaskController::class,
            'action' => 'status',
            'template' => null
        ],

        /** Auth */
        'login' => [
            'controller' => Controller\AdminController::class,
            'action' => 'login',
            'template' => 'view/app/admin/login.php'
        ],
        'logout' => [
            'controller' => Controller\AdminController::class,
            'action' => 'logout',
            'template' => null
        ]
    ],

    /** Admin identity */
    'app/admin' => [
        'identity' => 'admin',
        'credential' => password_hash('123', PASSWORD_DEFAULT)
    ],

    /** Image validator */
    'module/app/validator/image' => [
        'size' => '320х240',
        'mime/type' => 'jpg/jpeg/png/gif'
    ],

    /** Paginator config */
    'module/app/paginator' => [
        'perpage' => 3,
        'sortby' => 'username',
        'sortdir' => 'DESC'
    ]
];
