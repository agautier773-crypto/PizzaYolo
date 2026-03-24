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

    /**
     * Reception des requêtes de création de client
     *
     * Path : POST sur /clients
     * @return void
     */
    public function createClient() {

        // on récupère les informations provenant de la requête POST
        // et on les vérifie
        $validator = new WizardValidator($_POST, [
            "nom" => "required",
            "rue" => "required",
            "ville" => "required",
            "code_postal" => "required",
            "telephone" => "required",
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

        $client = new Client();
        $client->fill($validated);

        $client->save();

        // renvoie du Json au js
        http_response_code(200);
        echo json_encode(['id_client' => $client->id_client, 'nom' => $client->nom]);
        exit;


        // traitement pour nouveau client
       // $client = new Client($_POST[???], $_POST[???], $_POST[???], $_POST[???]);
        // $client->save();

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

}