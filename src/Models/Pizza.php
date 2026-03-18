<?php

namespace App\Models;
use App\Core\Model;
use App\Core\Traits\HasRelationships;

class Pizza extends Model{
    use HasRelationships;

    public static string $primaryKey = "id_pizza";

    public ?int $id_pizza = null;

    public string $nom = "";

    public string $ingredients = "";

    public bool $statut = true;

    public float $prix = 0;

    public array $fillable = [
        "nom",
        "ingredients",
        "statut",
        "prix",
    ];
}