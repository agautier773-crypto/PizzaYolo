CREATE TABLE Client(
   id_client INT,
   Nom VARCHAR(255) NOT NULL,
   rue VARCHAR(255) NOT NULL,
   ville VARCHAR(255) NOT NULL,
   code_postal VARCHAR(5) NOT NULL,
   telephone VARCHAR(12) NOT NULL,
   PRIMARY KEY(id_client)
);

CREATE TABLE Pizza(
   id_pizza INT,
   nom_ VARCHAR(255) NOT NULL,
   ingrédients VARCHAR(255) NOT NULL,
   statut VARCHAR(50) NOT NULL,
   prix decimal(10,2) NOT NULL,
   PRIMARY KEY(id_pizza)
);

CREATE TABLE Commande(
   id_commande INT,
   date_ DATETIME NOT NULL,
   etat [PAYE, EN PREPARATION, PRETE, LIVRE] DEFAULT PAYE,
   id_client INT NOT NULL,
   montant decimal (10,2) DEFAULT 0,
   PRIMARY KEY(id_commande),
   FOREIGN KEY(id_employe) REFERENCES Employe(id_employe),
   FOREIGN KEY(id_client) REFERENCES Client(id_client)
);

CREATE TABLE Employe(
   id_employe INT,
   nom VARCHAR(255) NOT NULL,
   role [GUICHETIER, CUISINIER] NOT NULL,
   PRIMARY KEY(id_employe)
);


CREATE TABLE Commande_pizza(
   id_pizza INT,
   id_commande VARCHAR(50),
   quantité INT NOT NULL,
   PRIMARY KEY(id_pizza, id_commande),
   FOREIGN KEY(id_pizza) REFERENCES Pizza(id_pizza),
   FOREIGN KEY(id_commande) REFERENCES Commande(id_commande)
);
