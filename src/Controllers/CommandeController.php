<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\Client;
use App\Models\Commande;
use App\Models\CommandePizza;
use App\Models\Pizza;


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
}