<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Wizardvalidator;
use App\Models\Pizza;
use App\Core\View;
use Exception;

class PizzaController extends Controller {

    /**
     * @throws Exception
     * Rend la vu du formulaire de création de pizza
     * Reserver au patron
     */
    public function create(){

         View::render("pizza.form", [
             "pizza" => new Pizza(),
         ]);
    }

    /**
     * @throws Exception
     * Création d'une nouvelle pizza en bdd
     * Valide et enregistre la nouvelle pizza
     * Redirige vers le formulaire avec les erreurs si la validation echoue
     */
    public function store(){
       $validator = new Wizardvalidator($_POST, [
            "nom" => "required",
            "ingredients" => "required",
            "prix" => "required",
        ]);

        if($validator -> fails()){
            foreach($validator -> errors() as $error){
                Session::setFlash("danger", $error);
            }
            Session::set("old", $_POST);
            header("Location: /pizza/create");
            exit;
        }

        $validated = $validator -> validated();
        $pizza = new Pizza();
        $pizza->fill($validated);
        $pizza->save();

        Session::setFlash("success", "Nouvelle Pizza créée avec succès");
        $this->redirect("/");

    }

    // Affiche la liste des pizzas dispo
    public function home() {
        View::render("pizza.list", [
            "pizza" => (new Pizza()) ->findAll()
        ]);
    }

    // Supprime une pizza par son identifiant
    // Reservé au patron
    public function delete($id){
        $p = (new Pizza())->find($id);
        $p->delete($id);

        Session::setFlash("success", "Pizza supprimée");
        $this->redirect("/pizza");
    }

    // Affiche le formulaire pour modifier une pizza
    public function edit($id){
        $id = intval($id);
        $pizza = (new Pizza())->find($id);

        View::render('pizza.form', [
            'pizza'=>$pizza,
        ]);
    }

    // Valide et met a jour une pizza existante en bdd
    // Redirige vers le formulaire avec les erreurs si la validation échoue
    public function updatePizza($id){
        $id = intval($id);
        $pizza = (new Pizza())->find($id);

        $validator = new Wizardvalidator($_POST, [
            "nom" => "required",
            "ingredients" => "required",
            "prix" => "required"
        ]);
        if($validator->fails()){
            foreach ($validator->errors() as $error){
                Session::setFlash("danger", $error);
            }
            Session::set("old", $_POST);
            header("Location: /pizza/update/".$pizza->id_pizza);
            exit;
        }
        $validated = $validator ->validated();
        $pizza->fill($validated);
        $pizza->save();

        $this->redirect("/pizza");
    }
}