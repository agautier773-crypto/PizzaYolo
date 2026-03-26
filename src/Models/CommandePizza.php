<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Traits\HasRelationships;

class CommandePizza extends Model {
    use HasRelationships;

    public static string $primaryKey = "id_commande";

    /**
     * Clef étrangère vers la commande
     */
    public ?int $id_commande = null;

    public ?Pizza $pizza;

    /**
     * Clef
     */
    public ?int $id_pizza = null;

    public ?int $quantite = null;

    public array $fillable = [
        "quantite",
    ];

    public function loadPizza(): Pizza {
        $this->pizza = $this->belongsTo(Pizza::class, "id_pizza");
        return $this->pizza;
    }
}