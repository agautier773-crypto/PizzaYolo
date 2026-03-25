<?php

namespace App\Core;

use App\Models\Employe;

class Auth{
    public static ?Employe $employe = null;

    public static function check(): bool{
        return Session::has('employe');
    }

    public static function employe(){
        if (!self::$employe) {
            self::$employe = (new Employe())->find(self::id());
            return self::$employe;
        }
        return self::$employe;
    }

    public static function id(): ?int{
        if (Session::has('employe')) {
            return Session::get("employe");
        }
        return null;
    }

    public static function attempt($validated): void{
        $employe = (new Employe())->findBy("nom", $validated["nom"], true);
        if ($employe) {
            if (password_verify($validated["password"], $employe->password)) {
                self::login($employe);
                return;
            }
        }
        Session::setFlash("error", "combo nom / mdp erroné !");
        header("location: /login");
        exit;
    }

    public static function login(Employe $employe): void{
        Session::setUser($employe->id_employe);
        Session::setFlash("success", "Connexion réussie");
        header("location: /");
        exit;
    }

    public static function logout(): void{
        unset($_SESSION["employe"]);
        Session::setFlash("success", "Vous êtes bien deconnecté");
        header("Location: /login");
        exit;
    }
}
