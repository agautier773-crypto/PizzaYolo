<?php

namespace App\Models;
use App\Core\Model;
use App\Core\Traits\HasRelationships;

class Pizza extends Model{
    use HasRelationships;

    public ?int $id;

    public string $nom = "";

    public string $ingredients = "";

    public bool $statut = true;

    public float $montant = 0;

    public array $fillable = [
        "nom",
        "ingredients",
        "statut",
        "montant",
    ];

    public function commande(){
        return $this->belongsToMany(Commande::class, "commande_pizza");
    }
}