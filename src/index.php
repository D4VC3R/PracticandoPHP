<?php

include_once "vendor/autoload.php";

use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;
use App\Controller\EmpresaController;
use App\Controller\InversorController;


$router = new RouteCollector();


$router->get('/',function (){
    include_once "app/View/principal.php";
});

$router->get('/error',function (){
    $errores = ["Ruta no encontrada"];
    include_once DIRECTORIO_VISTAS."error.php";
});


$router->get('/login',function (){
    include_once DIRECTORIO_VISTAS_FRONTEND."login.php";
});

// Rutas del CRUD de Empresa.
$router->get('/empresa/create',[EmpresaController::class,'create']);
$router->post('/empresa',[EmpresaController::class,'store']);
$router->put('/empresa/{id}',[EmpresaController::class,'update']);
$router->delete('/empresa/{id}',[EmpresaController::class,'destroy']);
$router->get('/empresa',[EmpresaController::class,'index']);
$router->get('/empresa/{id}',[EmpresaController::class,'show']);

// Rutas del CRUD de Inversor.
$router->get('/inversor/create',[InversorController::class,'create']);
$router->post('/inversor',[InversorController::class,'store']);
$router->put('/inversor/{email}',[InversorController::class,'update']);
$router->delete('/inversor/{email}',[InversorController::class,'destroy']);
$router->get('/inversor',[InversorController::class,'index']);
$router->get('/inversor/{email}',[InversorController::class,'show']);
















//Resolución de rutas
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
try {
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
}
catch(HttpRouteNotFoundException $e){
    return include_once DIRECTORIO_VISTAS."404.html";
}
// Print out the value returned from the dispatched function
echo $response;
