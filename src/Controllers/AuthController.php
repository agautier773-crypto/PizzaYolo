<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Session;
use App\Core\View;
use App\Core\WizardValidator;
use App\Helpers\Csrf;
use App\Helpers\Services\CsrfSession;
use App\Helpers\Services\Request;

class AuthController extends Controller
{
    //Affiche le formulaire de connexion
    public function login(): void
    {
        $csrf = new Csrf(new CsrfSession(), new Request());
        View::render("auth.login", [
            'csrf' => $csrf
        ]);
    }

    // Valide les identifiants soumis et try l'authentification employé
    // Redirige vers la page d'accueuil en cas de succès
    public function attemptLogin(): void
    {
        $validator = new WizardValidator($_POST, [
            "nom" => "required",
            "password" => "required",
        ]);

        if ($validator->fails()){
            # gestion des erreurs
            foreach ($validator->errors() as $error){
                Session::setFlash("danger", $error);
            }
            Session::set("old", $_POST);
            $this->redirect("/login");
            return;
        }
        $validated = $validator->validated();
        Auth::attempt($validated);

    }

    //Deconnecte l'employé
    public function logout(): void{
        Auth::logout();
    }
}