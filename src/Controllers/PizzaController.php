<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Wizardvalidator;
use App\Models\Pizza;
use App\Core\View;
use Exception;

class PizzaController extends Controller{

    /**
     * @throws Exception
     */
    public function create(){

         View::render("pizza.form", [
             "pizza" => new Pizza(),
         ]);
    }

    /**
     * @throws Exception
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

    public function home(){
        View::render("pizza.list", [
            "pizza" => (new Pizza()) ->findAll()
        ]);
    }

    public function delete($id){
        $p = (new Pizza())->find($id);
        $p->delete($id);

        Session::setFlash("success", "Pizza supprimée");
        $this->redirect("/pizza");
    }

    public function edit($id){
        $id = intval($id);
        $pizza = (new Pizza())->find($id);

        View::render('pizza.form', [
            'pizza'=>$pizza,
        ]);
    }

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