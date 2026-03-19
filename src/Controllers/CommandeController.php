<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Core\Wizardvalidator;
use App\Models\Client;
use App\Models\Commande;
use App\Models\CommandePizza;
use App\Models\Pizza;
use PHPUnit\Util\Test;

class CommandeController extends Controller{

    public function home():void{

        View::render("Commande.index",[
            "commandes" => (new Commande()) -> findAll(),
            "client" => (new Client()) -> findAll(),
        ]);
    }

    public function show($id):void{
        $c = new Commande();
        $c = $c->find($id);
        View::render("Commande.show", [
            "commande" => $c,
            "pizzas" => (new Pizza()) -> findAll(),
        ]);
    }

    public function updateEtat($id){
        $id = intval($id);
        $commande = (new Commande()) -> find($id);

        $validator = new Wizardvalidator($_POST, [
            "etat" => "required",
        ]);
        $validated = $validator -> validated();
        $commande->fill($validated);
        $commande->save();

        $this->redirect("/");
    }

}