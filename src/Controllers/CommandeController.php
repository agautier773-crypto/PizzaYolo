<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\View;
use App\Core\Wizardvalidator;
use App\Enum\Etat_commande;
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
        $etatValue = $_POST['etat']??null;

        if(!$etatValue){
            $this->redirect("/");
            return;
        }

        // mets a jour que l'etat from permet de convertir la string recu en enum php
        $commande->etat = Etat_commande::from($etatValue)->value;
        $commande->save();

        $this->redirect("/");
    }

    public function delete($id)
    {
        $c = (new Commande())->find($id);
        if (!$c) {
            $this->redirect("/");
        }
        $c->sync(CommandePizza::class, [], "commande_pizza");
        $c->delete($id);

        Session::setFlash("success", "Commande supprimée");
        $this->redirect("/");
    }

    public function create(){
        $commande = new Commande();
        $client = new Client();
        $pizza = (new Pizza())->findAll();
        View::render("commande.form", [
            'commande'=>$commande,
            'client'=>$client,
            'pizza'=>$pizza,
        ]);

    }

}