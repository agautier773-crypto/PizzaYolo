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
    "role" => App\Core\Middlewares\RoleMiddlewares::class

    // ajout des middlewares
]);
$router
   // ajout des routes
    ->get("/", App\Controllers\CommandeController::class ."::home")->middleware("auth")
    ->get("/show/{id}", App\Controllers\CommandeController::class ."::show")->middleware("auth")
    ->post("/UpdateEtat/{id}", App\Controllers\CommandeController::class."::updateEtat")->middleware("auth")
    ->get("/Delete/{id}", App\Controllers\CommandeController::class."::delete")->middleware("auth")
    ->get("/create", App\Controllers\CommandeController::class."::create")->middleware("auth")->middleware("role:GUICHETIER")

    ->post("/api/clients", App\Controllers\ClientController::class."::createClient")->middleware("auth")->middleware("role:GUICHETIER")

    ->post("/create", App\Controllers\CommandeController::class."::store")->middleware("auth")->middleware("role:GUICHETIER")

    ->get("/pizza", \App\Controllers\PizzaController::class."::home")->middleware("auth")
    ->get("/pizza/create", App\Controllers\PizzaController::class."::create")->middleware("auth")->middleware("role:PATRON")
    ->post("/pizza/create", \App\Controllers\PizzaController::class."::store")->middleware("auth")->middleware("role:PATRON")
    ->get("/pizza/delete/{id}", App\Controllers\PizzaController::class."::delete")->middleware("auth")->middleware("role:PATRON")
    ->get("/pizza/update/{id}", App\Controllers\PizzaController::class."::edit")->middleware("auth")->middleware("role:PATRON")
    ->post("/pizza/update/{id}", App\Controllers\PizzaController::class."::updatePizza")->middleware("auth")->middleware("role:PATRON")
    // gestion des clients
    //->post("/clients", App\Controllers\CommandeController::class."::createClient")


    ->get("/login", App\Controllers\AuthController::class . "::login")
    ->post("/login", App\Controllers\AuthController::class . "::attemptLogin")
    ->get("/logout", App\Controllers\AuthController::class . "::logout")

->run();

//$user = (new User()) -> find(1) ->getNameRole();
