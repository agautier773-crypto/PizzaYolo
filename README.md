# PizzaYolo — Application de gestion de commandes pour pizzeria

PizzaYolo est une application web de gestion de commandes développée en **PHP** selon le **modèle MVC**.  
Elle permet de gérer les commandes clients, les ajouts de nouvelles pizza, et le transfet entre le guichet et la cuisine  
Le projet fonctionne avec **Docker**, intégrant un environnement complet comprenant **Apache**, **PHP**, **MySQL** et **phpMyAdmin**.

---

## Fonctionnalités principales

- Création, modification et suppression de commandes  
- Gestion des pizzas
- Suivi de l’état d’une commande (en préparation, livrée, payée, prête)  
- Interface d’administration via phpMyAdmin pour la gestion des données  
- Architecture MVC claire et organisée pour faciliter la maintenance



---

## 🐳 Installation avec Docker

### 1. Prérequis
- **Docker** installés sur votre machine

> [!IMPORTANT]
> une fois le projet récupérer et se trouve bien sur l'emplacement que vous avez choisi 
ouvrez le avec un IDE et ajoutez un fichier .env a la racine du projet

### 2. Lancement du projet
Dans le répertoire du projet :

```bash
docker-compose up -d --build
```
Cela lancera les services suivants :

- **apache** : serveur web pour exécuter l’application PHP  
- **mysql** : base de données pour la gestion des commandes  
- **phpmyadmin** : interface graphique de gestion MySQL

---

### 3. Accès aux services

- Application : [http://localhost:8081](http://localhost:8081)  
- phpMyAdmin : [http://localhost:8082](http://localhost:8082)  

**Identifiants par défaut :**
- Utilisateur MySQL : `lambdas`  
- Mot de passe : `lambdas`  
- Base de données : `PizzaYolo`
