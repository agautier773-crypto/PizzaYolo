<?php


namespace App\Core\Middlewares;

use App\Core\Session;
use App\Helpers\Csrf;
use App\Helpers\Services\CsrfSession;
use App\Helpers\Services\Request;

class CsrfMiddlewares implements InterfaceMiddlewares
{

    public function handle(): void
    {
        $attempUri = $_SERVER["REQUEST_URI"];

        $csrf = new Csrf(new CsrfSession(), new Request());
        if (!$csrf->isTokenValid()) {
            Session::setFlash("danger", "Le token n'est pas bon");
            header("Location: {$attempUri}");
            exit;
        }
    }
}