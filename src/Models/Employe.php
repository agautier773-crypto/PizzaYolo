<?php

namespace App\Models;

use \App\Core\Model;
use App\Core\Traits\HasRelationships;

class Employe extends Model{
    use HasRelationships;

    public ?int $id;

    public string $nom = "";

    public string $role= "";

    public array $fillable = [
        "nom",
        "role",
    ];


}