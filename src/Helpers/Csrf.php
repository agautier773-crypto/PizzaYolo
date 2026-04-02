<?php

namespace App\Helpers;

use App\Core\Session;
use App\Helpers\Interfaces\SessionInterface;
use App\Helpers\Interfaces\RequestInterface;
use Exception;

class Csrf{

    private const SESSION_TOKEN_KEY = 'csrf_token';
    private const FIELD_NAME = 'csrf_token';

    private SessionInterface $session;
    private RequestInterface $request;

    public function __construct(SessionInterface $session, RequestInterface $request){
        $this->session = $session;
        $this->request = $request;
    }
    public function generateToken():string{
        $token = bin2hex(random_bytes(32));
        $this->session->set(self::SESSION_TOKEN_KEY,[
            'token' => $token,
            'expires_at' => time() + 3600,
        ]);
        return $token;
    }

    public function getToken(): string{
        if(!self::isTokenValid()){
            return $this->generateToken();
        }
        return $this->session->get(self::SESSION_TOKEN_KEY)['token'];
    }

    public function field():string{
        $token = $this->getToken();
        $fieldName = self::FIELD_NAME;

        return "<input type='hidden' value='{$token}' name='{$fieldName}' />";
    }

    public function isTokenValid():bool{
        // Récupere les données du token en session
        $sessionData = $this->session->get(self::SESSION_TOKEN_KEY);
        // verifie qu'il existe
        if(!isset($sessionData['token'])){
            return false;
        }
        // Recupere le token envoyé dans le formulaire
        $postToken = $this->request->getPost(self::FIELD_NAME);

        // Vérifie que le formulaire a bien envoyé un token
        if($postToken === null){
            return false;
        }
        //Compare les deux tokens
        $isValid = $sessionData['token'] === $postToken;

        // Si valide supprime le token pour qu'il ne puisse pas être réutilisé
        if($isValid){
            $this->session->remove(self::SESSION_TOKEN_KEY);
        }
        return $isValid;
    }

}