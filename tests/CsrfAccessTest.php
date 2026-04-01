<?php

namespace Tests;
use App\Core\Middlewares;
use App\Helpers\Csrf;

class CsrfAccessTest extends \PHPUnit\Framework\TestCase{

    /**
     * @throws \Exception
     */
    public function test_csrfAccess(){

        session_start();
        $_SESSION = [];
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $token = Csrf::generateToken();

        $_POST = [];
        $isValid = Csrf::isTokenValid();
        $this->assertFalse($isValid, "La requete doit échouer");

        $_POST['csrf_token'] = $token;
        $isValid = Csrf::isTokenValid();
        $this->assertTrue($isValid, "La requete doit réussir avec token valide");
    }
}