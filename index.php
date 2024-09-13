<?php
declare(strict_types=1);

use App\Controller\HomeController;
use App\Controller\InvoicesController;
use App\Controller\UploadController;
use App\View;

include_once __DIR__.'/vendor/autoload.php';


$route = new App\Router();

const PATH_STORAGE = __DIR__ . '/Storage/';
const PATH_View = __DIR__ . '/Views/';

$route
    ->get('/php_revision/', [HomeController::class, 'index'])
    ->post('/php_revision/upload/', [HomeController::class, 'upload'])
    ->get('/php_revision/download/', [HomeController::class, 'download'])
    ->get('/php_revision/invoice/', [InvoicesController::class, 'index'])
    ->get('/php_revision/invoice/create/', [InvoicesController::class, 'create'])
    ->post('/php_revision/invoice/create/', [InvoicesController::class, 'store']);

try {
  echo $route->resolve();
} catch (\Exception $e) {
  // if(! headers_sent())
  // {
  //   header('HTTP/1.1 404 Not Found');
  //   echo View::make('error/404');
  // }
  echo $e;
}
// echo $route->resolve();
