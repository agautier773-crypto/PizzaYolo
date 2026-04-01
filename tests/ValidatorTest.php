<?php

namespace Tests;
use App\Core\Wizardvalidator;
use PHPUnit\Framework\TestCase;
class ValidatorTest extends TestCase{

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
        $this->assertNotEmpty($validator->fails());
    }
}