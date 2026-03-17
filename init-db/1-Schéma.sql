Create Database IF NOT EXISTS PizzaYolo;
use PizzaYolo

CREATE TABLE IF NOT EXISTS client(
   id_client INT AUTO_INCREMENT,
   nom VARCHAR(255) NOT NULL,
   rue VARCHAR(255) NOT NULL,
   ville VARCHAR(255) NOT NULL,
   code_postal VARCHAR(5) NOT NULL,
   telephone VARCHAR(12) NOT NULL,
   PRIMARY KEY(id_client)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS employe(
    id_employe INT AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    role ENUM ('GUICHETIER', 'CUISINIER') NOT NULL,
    PRIMARY KEY(id_employe)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS pizza(
   id_pizza INT AUTO_INCREMENT,
   nom VARCHAR(255) NOT NULL,
   ingredients VARCHAR(255) NOT NULL,
   statut BOOLEAN NOT NULL DEFAULT TRUE,
   prix decimal(10,2) NOT NULL,
   PRIMARY KEY(id_pizza)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS commande(
   id_commande INT AUTO_INCREMENT,
   date DATETIME NOT NULL,
   etat ENUM ('PAYE', 'EN_PREPARATION', 'PRETE', 'LIVRER') DEFAULT 'PAYE',
   id_client INT NOT NULL,
   montant decimal (10,2) DEFAULT 0,
    id_employe INT NOT NULL,
   PRIMARY KEY(id_commande),
   FOREIGN KEY(id_employe) REFERENCES employe(id_employe),
   FOREIGN KEY(id_client) REFERENCES client(id_client)
)ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS commande_pizza(
   id_pizza INT,
   id_commande INT NOT NULL,
   quantite INT NOT NULL,
   PRIMARY KEY(id_pizza, id_commande),
   FOREIGN KEY(id_pizza) REFERENCES pizza(id_pizza),
   FOREIGN KEY(id_commande) REFERENCES commande(id_commande)
)ENGINE=InnoDB;
