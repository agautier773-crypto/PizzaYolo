<?php

namespace App\Models;

use \App\Core\Model;
use App\Core\Traits\HasRelationships;

class Employe extends Model{
    use HasRelationships;

    public static string $primaryKey = "id_employe";

    public ?int $id_employe = null;

    public string $nom = "";

    public string $role= "";

    public array $fillable = [
        "nom",
        "role",
    ];


}