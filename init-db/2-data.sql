INSERT INTO client (nom, rue, code_postal, ville, telephone) VALUES
('Jean', '12 rue des Lilas', '40000', 'Mont-de-Marsan','0545433423'),
('Marie', '5 avenue de la Paix', '40000', 'Mont-de-Marsan', '0678654567'),
('Pierre', '8 rue du Moulin', '40100', 'Dax', '0569765646'),
('Sophie', '3 boulevard Victor Hugo', '40100', 'Dax', '09545489534');

INSERT INTO employe(nom, role, password) VALUES
('Keven', 'CUISINIER', '$2y$10$HehX.vMdfdkv2C5eCBPg5e/HdIjqF7U/oArxOOXpw35Rf.so4Wv/a'),
('Maxime', 'GUICHETIER', '$2y$10$HehX.vMdfdkv2C5eCBPg5e/HdIjqF7U/oArxOOXpw35Rf.so4Wv/a'),
('Philippe', 'PATRON', '$2y$10$HehX.vMdfdkv2C5eCBPg5e/HdIjqF7U/oArxOOXpw35Rf.so4Wv/a');

INSERT INTO pizza (prix, nom, ingredients) VALUES
(10.50, 'chèvre-miel', 'base tomate, chevre, miel, noix'),
(9.00, 'reine', 'base tomate, jambon, champignons, fromage'),
(11.50, 'bolognaise', 'base tomate, viande hachée, oignons, tomate'),
(8.50, 'kebab', 'base tomate, viande kebab, sauce blanche, oignons');

INSERT INTO commande (date, etat, id_client) VALUES
('2024-03-01 12:00:00', 'LIVRER', 1),
('2024-03-02 19:30:00', 'PRETE', 2),
('2024-03-03 20:00:00', 'EN_PREPARATION', 3),
('2024-03-05 13:00:00', 'LIVRER', 1),
('2024-03-06 20:00:00', 'EN_PREPARATION', 1),
('2024-03-04 18:45:00', 'PAYE', 4);


INSERT INTO commande_pizza (id_commande, id_pizza, quantite) VALUES
(1, 1, 2),
(1, 2, 3),
(2, 3, 1),
(2, 4, 2),
(3, 1, 1),
(3, 3, 2),
(4, 2, 4),
(5, 1, 5),
(6, 2, 2),
(6, 3, 1);

