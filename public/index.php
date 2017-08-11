<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 16:14
 */

chdir(dirname(__FILE__));

// composer autoload
require __DIR__ . '/vendor/autoload.php';

use App\Request;
use App\Response;
use App\Server;

session_start();

$request = new Request();
$response = new Response();
$config = require __DIR__ . '/config/app.config.php';

$app = new Server();
$app->set('config', $config);
$app->set(Request::class, $request);
$app->set(Response::class, $response);

foreach ($config['di'] as $key => $factory) {
    $app->set($key, $app->create($factory));
}

$app->dispatch()->display();
