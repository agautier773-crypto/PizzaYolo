<?php


function create_employe(string $info){
    $u = new App\Models\Client();
    $u->nom = $info;
    $u->rue = $info;
    $u->ville = $info;
    $u->code_postal = $info;
    $u->telephone = $info;
    $u->save();
}

function escape(?string $value){
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}

