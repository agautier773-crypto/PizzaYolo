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

    public function show($id) : void {
        $c = new Commande();
        // on retrouve un objet de la classe commande
        $c = $c->find($id);

        // on souhaite retrouver les pizzas associées à la commanbde
        $lignesCommande = (new CommandePizza())->findBy("id_commande", $c->id_commande);

        // chargement des pizzas associées à chaque ligne de commande
        foreach ($lignesCommande as $ligneCommande) {
            $ligneCommande->loadPizza();
        }

        // on modifie les lignes de commande de la commande concernée
        $c->lignesCommande = $lignesCommande;

        View::render("Commande.show", [
            "commande" => $c
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

    /**
     * Rend la vue "commande"
     *
     * Réponse à GET sur /commande
     *
     */
    public function create(){
        $commande = new Commande();
        $clients = (new Client())->findAll();
        $pizza = (new Pizza())->findAll();

        View::render("commande.form", [
            'commande'=>$commande,
            'clients'=>$clients,
            'pizza'=>$pizza,
        ]);

    }

    public function store(){
        $validator = new WizardValidator($_POST, [
            "id_client" => "required",
            "montant" => "required",
            "pizzas" => "required",
            "date" => "required",
            "commentaires" => "nullable",
        ]);

        if ($validator->fails()){
            # erreurs
            foreach ($validator->errors() as $error){
                Session::setFlash("danger", $error);
            }
            Session::set("old", $_POST);
            header("Location: /create");
            exit;
        }

        $validated = $validator->validated();
        $validated["etat"]="PAYE";

        $commande = new Commande();

        $commande->fill($validated);

        $commande->save();
        $pizza = $validated["pizzas"] ?? [];
        $commande->syncPizza($pizza);

        Session::setFlash("success", "Commande créer !");
        $this->redirect("/");
    }

}