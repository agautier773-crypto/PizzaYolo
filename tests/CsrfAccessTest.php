<?php

namespace Tests;
use App\Core\Middlewares;
use App\Helpers\Csrf;
use App\Helpers\Interfaces\SessionInterface;
use App\Helpers\Interfaces\RequestInterface;

class CsrfAccessTest extends \PHPUnit\Framework\TestCase{

    // Si la session ne contient pas de token, isTokenValid retourne false
    public function test_csrfAccessAbsent():void{

        $session = $this->createMock(SessionInterface::class);
        $session->expects($this->once())
                ->method('get')
                ->willReturn(null);

        $request = $this->createStub(RequestInterface::class);

        $csrf = new Csrf($session, $request);
        $this->assertFalse($csrf->isTokenValid());
    }

    // Si la session contient un token et form a le meme isTokenValid doit retourner True
    public function test_csrfAccessValide():void{

        $token = bin2hex(random_bytes(32));

        //Crée un faux objet Session qui retourne le token
        $session = $this->createMock(SessionInterface::class);
        $session->expects($this->once())
                ->method('get')
                ->willReturn(['token'=>$token,
        ]);
        //Crée un faux objet Request qui retourne le token envoyé par le formulaire
        $request = $this->createMock(RequestInterface::class);
        $request->expects($this->once())
                ->method('getPost')
                ->willReturn($token);

        $csrf = new Csrf($session, $request);
        $this->assertTrue($csrf->isTokenValid());
    }
}