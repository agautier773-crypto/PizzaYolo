<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Session;
use App\Core\View;
use App\Core\Wizardvalidator;
use App\Enum\Etat_commande;
use App\Helpers\Csrf;
use App\Helpers\Services\CsrfSession;
use App\Helpers\Services\Request;
use App\Models\Client;
use App\Models\Commande;
use App\Models\CommandePizza;
use App\Models\Pizza;
use PHPUnit\Util\Test;

class CommandeController extends Controller{

    // Rend la vue liste des commandes
    public function home():void{
        $commandes = (new Commande())->findAll();

        if(Auth::employe()->role ==="CUISINIER"){
            $commandesFiltree = [];
            foreach ($commandes as $commande){
                if($commande->etat === 'EN_PREPARATION' || $commande->etat === 'PRETE'){
                    $commandesFiltree[] = $commande;
                }
            }
            $commandes = $commandesFiltree;
        }
        View::render("Commande.index",[
            "commandes" => $commandes,
            "client" => (new Client()) -> findAll(),
        ]);
    }

    // Rend la vu sur une commande btn show
    public function show($id) : void {
        $c = (new Commande())->find($id);
        $c->loadLigneCommande();

        View::render("Commande.show", [
            "commande" => $c
        ]);
    }

    // btn état
    // Permet de mettre a jour l'état d'une commande
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

    // Supprime une commande et ses lignes associées
    //Interdit aux cuisiniers
    public function delete($id)
    {
        if (Auth::employe()->role === "CUISINIER"){
            Session::setFlash("danger", "Vous n'avez pas les droits pour supprimer une commande.");
            $this->redirect("/");
            return;
        }
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
        $csrf = new Csrf(new CsrfSession(), new Request());

        View::render("commande.form", [
            'commande'=>$commande,
            'clients'=>$clients,
            'pizza'=>$pizza,
            'csrf'=>$csrf,
        ]);
    }
    /**
     * @throws \Exception
     */
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

        $montant = (float) $validated["montant"];
        $pizzas = $validated["pizzas"] ?? [];
        $id_client = (int) $validated["id_client"];


        $commande = new Commande();
        // remise toute les 3 commandes
        $montant = $commande->calculAvecRemise($montant, $id_client, $pizzas);
        $commande->fill($validated);
        $commande->save();
        $commande->syncPizza($pizzas);

        // mise a jour du prix apres le syncPizza car le trigger sur le montant double le montant
        $commande->montant = round($montant, 2);
        $commande->update();

        Session::setFlash("success", "Commande créer !");
        $this->redirect("/");
    }

}