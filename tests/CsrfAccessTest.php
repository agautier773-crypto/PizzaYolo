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
    //Verifie que le token n'est pas falsifié
    // Si falsifié retourne false
    public function test_csrfFalsifie_echec():void{
        //Crée un faux objet Session qui retourne le token
        $session = $this->createMock(SessionInterface::class);
        $session->expects($this->once())
            ->method('get')
            ->willReturn(['token'=> 'vrai_token',
            ]);

        $request = $this->createMock(RequestInterface::class);
        $request->expects($this->once())
            ->method('getPost')
            ->willReturn('faux_token');

        $csrf = new Csrf($session, $request);
        $this->assertFalse($csrf->isTokenValid());
    }
    // Verifie que le token est bien supprimé après usage
    // Retourne True si le token est valide par rapport ce qui est envoyé
    public function test_csrfSupprimeApresUsage():void{

        $token = bin2hex(random_bytes(32));

        //Crée un faux objet Session qui retourne le token
        $session = $this->createMock(SessionInterface::class);
        $session->expects($this->once())
            ->method('get')
            ->willReturn(['token'=>$token,
            ]);
        //Verifie que remove est appelé qu'une fois
        $session->expects($this->once())
                ->method('remove');

        $request = $this->createMock(RequestInterface::class);
        $request->expects($this->once())
                ->method('getPost')
                ->willReturn($token);

        $csrf = new Csrf($session, $request);
        $this->assertTrue($csrf->isTokenValid());
    }
}