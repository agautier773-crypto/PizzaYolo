<?php

namespace App\Controllers;

use App\Core\Session;
use App\Core\Wizardvalidator;
use App\Models\Client;

class ClientController extends \App\Core\Controller
{
    //Création d'un nouveau client
    public function createClient() {

        // on récupère les informations provenant de la requête POST
        // et on les vérifie
        $validator = new WizardValidator($_POST, [
            "nom" => "required",
            "rue" => "required",
            "ville" => "nullable",
            "code_postal" => "nullable",
            "telephone" => "nullable",
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
    }
}