<?php

namespace App\Models;

use App\Core\Model;
use App\Models\CommandePizza;
use App\Core\Traits\HasRelationships;
use App\Enum\Etat_commande;


class Commande extends Model{
    use HasRelationships;

    public static string $primaryKey = "id_commande";
    public ?int $id_commande = null;
    public ?int $id_client = null;

    public ?array $lignesCommande;

    public string $date = "";

    public string $etat = "";

    public float $montant = 0;

    public ?string $commentaires = null;

    public array $fillable = [
        "date",
        "etat",
        "montant",
        "id_client",
        "commentaires"
    ];

    public function pizza(){
        return $this->belongsToMany(Pizza::class, "commande_pizza");
    }

    public function client(){
        return $this->belongsTo(Client::class, "id_client");
    }

    public function getNamedClient(){
        $namedClient = [];
        foreach ($this->client() as $clients){
            $namedClient[] = $clients -> nom;
        }
        return $namedClient;
    }

    public function quantitePizza(){
        $sql  = "SELECT pizza.*, commande_pizza.quantite FROM pizza JOIN commande_pizza ON commande_pizza.id_pizza = pizza.id_pizza
                WHERE commande_pizza.id_commande = :id";
        return $this->readQuery($sql, ["id"=>$this->id_commande], false, CommandePizza::class);
    }

    public function syncPizza($pizzas)
    {
    $primaryKey = static::$primaryKey;
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare( "DELETE FROM commande_pizza WHERE commande_pizza.id_commande = :id");
            $stmt -> execute(["id" => $this->$primaryKey]);

            if (!empty($pizzas)) {
                $sql = "INSERT INTO commande_pizza(id_commande, id_pizza, quantite) VALUES (:id_commande, :id_pizza, :quantite)";
                $stmt = $this->pdo->prepare($sql);

                foreach ($pizzas as $pizza){
                    $stmt->execute([
                        "id_commande" => $this->$primaryKey,
                        "id_pizza" => $pizza["id_pizza"],
                        "quantite" => $pizza["quantite"]
                    ]);
                }
            }
            $this->pdo->commit();
            return true;
        }catch (\Exception $e){
            $this->pdo->rollBack();
            return false;

        }
    }

    //recupere le nombre de commande de chaque client
    // return une seule valeur sans faire un tableau
    public function nombreCommande(int $id_client){
        $stmt = $this->pdo->prepare( "SELECT COUNT(*) FROM commande WHERE id_client = :id_client");
        $stmt->execute([":id_client" => $id_client]);
        return $stmt->fetchColumn();
    }
}