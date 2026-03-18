<?php

namespace App\Models;

use App\Core\Model;

class CommandePizza extends Model {

    public static string $primaryKey = "id_commande";

    public ?int $id_commande = null;

    public ?int $id_pizza = null;

    public ?int $quantite = null;

    public array $fillable = [
        "quantite",
    ];


}