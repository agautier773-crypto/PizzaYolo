<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Traits\HasRelationships;
use App\Enum;

class Commande extends Model{
    use HasRelationships;

    public static string $primaryKey = "id_commande";
    public ?int $id_commande = null;
    public ?int $id_client = null;
    public ?int $id_employe = null;

    public string $date = "";

    public string $etat = "";

    public float $montant = 0;

    public array $fillable = [
        "date",
        "etat",
        "montant",
        "id_client",
        "id_employe",
    ];

    public function pizza(){
        return $this->belongsToMany(Pizza::class, "commande_pizza");
    }

    public function client(){
        return $this->belongsTo(Client::class, "id_client");
    }

    public function employe(){
        return $this->belongsTo(Employe::class, "id_employe");
    }

    public function getNamedClient(){
        $namedClient = [];
        foreach ($this->client() as $clients){
            $namedClient[] = $clients -> nom;
        }
        return $namedClient;
    }

}