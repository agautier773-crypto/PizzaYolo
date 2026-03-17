INSERT INTO client (nom, rue, code_postal, ville, telephone) VALUES
('Jean', '12 rue des Lilas', '40000', 'Mont-de-Marsan','0545433423'),
('Marie', '5 avenue de la Paix', '40000', 'Mont-de-Marsan', '0678654567'),
('Pierre', '8 rue du Moulin', '40100', 'Dax', '0569765646'),
('Sophie', '3 boulevard Victor Hugo', '40100', 'Dax', '09545489534');

INSERT INTO pizza (prix, nom, ingredients, statut) VALUES
(10.50, 'chèvre-miel', 'base tomate, chevre, miel, noix', 'en stock'),
(9.00, 'reine', 'base tomate, jambon, champignons, fromage', 'en stock'),
(11.50, 'bolognaise', 'base tomate, viande hachée, oignons, tomate', 'en stock'),
(8.50, 'kebab', 'base tomate, viande kebab, sauce blanche, oignons', 'en stock');

INSERT INTO commande (date_, etat, client_id) VALUES
('2024-03-01 12:00:00', 'LIVRER', 1),
('2024-03-02 19:30:00', 'PRETE', 2),
('2024-03-03 20:00:00', 'PREPARATION', 3),
('2024-03-05 13:00:00', 'LIVRER', 1),
('2024-03-06 20:00:00', 'PREPARATION', 1),
('2024-03-04 18:45:00', 'PAYE', 4);


INSERT INTO commande_pizza (commande_id, pizza_id, nb_pizza) VALUES
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