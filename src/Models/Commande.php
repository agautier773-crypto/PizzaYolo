<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Traits\HasRelationships;
use App\Enum;

class Commande extends Model{
    use HasRelationships;

    public ?int $id;

    public string $date = "";

    public string $etat = "";

    public float $montant = 0;

    public array $fillable = [
        "date",
        "etat",
        "montant",
    ];

    public function pizza(){
        return $this->belongsToMany(Pizza::class, "commande_pizza");
    }

    public function client(){
        return $this->hasMany(Client::class, "id_client");
    }

    public function employe(){
        return $this->hasMany(Employe::class, "id_employe");
    }

    public function getNamedPizza(){
        $namedPizza = [];
        foreach ($this->pizza() as $pizzas){
            $namedPizza[] = $pizzas -> nom;
        }
        return $namedPizza;
    }

}