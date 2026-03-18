<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Traits\HasRelationships;

class Client extends Model{

    use HasRelationships;

    public static string $primaryKey = "id_client";
    public ?int $id_client = null;

    public string $nom = "";

    public string $rue = "";

    public string $ville = "";

    public string $code_postal = "";

    public string $telephone = "";

    public array $fillable = [
        "nom",
        "rue",
        "ville",
        "code_postal",
        "telephone",
    ];

    public function commande(): array{
        return $this->hasMany(Commande::class, "id_client");
    }
}