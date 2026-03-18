<?php

namespace App\Enum;

enum Etat_commande: string{
    case PAYE = 'PAYE';
    case EN_PREPARATION = 'EN_PREPARATION';
    case PRETE = 'PRETE';
    case LIVRER = 'LIVRER';
}