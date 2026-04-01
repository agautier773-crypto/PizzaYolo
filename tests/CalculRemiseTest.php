<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\Commande;

class CalculRemiseTest extends TestCase
{
    public function test_calculSansRemise(){
        $commande = new Commande();
        $montant = $commande->appliquerRemise(30.00, nbCommandes: 1, totalPizzas: 3);
        $this->assertEquals(30.00, $montant);
    }

    // Test pour vérifier que la remise s'applique bien toutes les 3 commandes
    public function test_remiseTroisCommandes(){
        $commande = new Commande();
        $montant = $commande->appliquerRemise(30.00, nbCommandes: 8, totalPizzas: 5);
        $this->assertEquals(27.00, $montant);
    }
}