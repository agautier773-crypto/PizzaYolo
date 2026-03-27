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

    public string $password="";

    public array $fillable = [
        "nom",
        "role",
        "password"
    ];

    public function GetRole(){
        return [$this->role];
    }

    public function save(){
        if(!empty($this->password) && !str_starts_with($this->password, '$2y$')){
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        }
        parent::save();
    }


}