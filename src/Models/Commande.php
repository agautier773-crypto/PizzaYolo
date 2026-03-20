<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Traits\HasRelationships;
use App\Enum\Etat_commande;


class Commande extends Model{
    use HasRelationships;

    public static string $primaryKey = "id_commande";
    public ?int $id_commande = null;
    public ?int $id_client = null;
    public ?int $id_employe = null;

    public string $date = "";

    public string $etat = "";

    public float $montant = 0;

    public ?string $commentaires;

    public array $fillable = [
        "date",
        "etat",
        "montant",
        "id_client",
        "id_employe",
        "commentaires"
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

    public function quantitePizza(){
        $sql  = "SELECT pizza.*, commande_pizza.quantite FROM pizza JOIN commande_pizza ON commande_pizza.id_pizza = pizza.id_pizza
                WHERE commande_pizza.id_commande = :id";
        return $this->readQuery($sql, ["id"=>$this->id_commande], false, CommandePizza::class);
    }
}