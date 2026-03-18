<?php


#var_dump(dirname(__DIR__) ."/autoloader.php");

require_once (dirname(__DIR__) ."/autoloader.php");
require_once (dirname(__DIR__) ."/src/Helpers/functions.php");
use App\Core\Session;
use App\Core\Wizardvalidator;
\App\Core\Session::getInstance();

$router = new App\Core\Router();


$router -> addMiddleware([
    "auth" => App\Core\Middlewares\AuthMiddlewares::class,
    "csrf" => App\Core\Middlewares\CsrfMiddlewares::class,

    // ajout des middlewares
]);
$router
   // ajout des routes
    ->get("/", App\Controllers\CommandeController::class ."::home")
    ->get("/show/{id}", App\Controllers\CommandeController::class ."::show")



    ->get("/login", App\Controllers\AuthController::class . "::login")
    ->post("/login", App\Controllers\AuthController::class . "::attemptlogin")
    ->get("/logout", App\Controllers\AuthController::class . "::logout")

->run();

//$user = (new User()) -> find(1) ->getNameRole();
