<?php

namespace Tests;
use App\Core\Wizardvalidator;
use PHPUnit\Framework\TestCase;
class ValidatorTest extends TestCase{

    //Test que l'on ne peut pas envoyer un champs vide ex avec id_client
    public function test_storeSansClient(){
        $data = [
            "montant" => "25.00",
            "pizzas" => ["reine"],
            "date" => "2026-04-01",
        ];
        $validator = new Wizardvalidator($data, [
            "id_client" =>"required",
            "montant" => "required",
            "pizzas" => "required",
            "date" => "required"
        ]);
        $this->assertTrue($validator->fails());
        $this->assertNotEmpty($validator->errors());
    }

    // Test sur les pizzas non vide
    public function test_pizzaVide(){
        $data = ["id_client" => 1, "montant" => "25.00", "pizzas" =>[], "date" => "2026.04.01"];
        $validator = new Wizardvalidator($data, [
            "id_client" =>"required",
            "montant" => "required",
            "pizzas" => "required",
            "date" => "required"
        ]);
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey("pizzas", $validator->errors());
    }
}