*🇫🇷 Version Française*
# 🌸 Site de vente de fleurs en ligne

## 📖 Présentation

Ce projet est un site e-commerce de vente de fleurs développé en PHP. Il permet aux visiteurs de découvrir différents bouquets, de créer un compte, de se connecter, de composer des bouquets personnalisés selon un budget, d'ajouter des produits au panier et de passer commande.

Le site est organisé autour d’une interface utilisateur simple, avec une partie publique (accès visiteur) et une partie connectée (accès client).

## 🔐 Fonctionnalités principales

- Inscription / Connexion des clients
- Affichage des nouveautés de la boutique
- Consultation des bouquets prédéfinis
- Création de bouquets personnalisés
- Gestion du panier (ajout / suppression / validation)
- Passage de commande

| Dossier / Fichier | Description                                      |
| ----------------- | ------------------------------------------------ |
| `/assets/`        | Contient les ressources statiques                |
| `/assets/css/`    | Feuilles de styles (CSS)                         |
| `/assets/images/` | Images utilisées dans le site                    |
| `api.php`         | Backend : gestion des données via une API en PHP |
| `index.php`       | **Page d’accueil** ou **routeur principal**      |
| `a_propos.php`    | Page « À propos » de la boutique en ligne        |
| `boutique.php`    | Gestion des produits et affichage de la boutique |
| `composer.php`    | Page pour composer un bouquet personnalisé       |
| `compte.php`      | Gestion du compte utilisateur                    |
| `inscription.php` | Formulaire d’inscription                         |
| `panier.php`      | Page du panier d’achat                           |
| `checkout.php`    | Gestion du paiement et validation de commande    |
| `contact.php`     | Formulaire de contact                            |
| `newsletter.php`  | Gestion des inscriptions à la newsletter         |


## 🧪 Technologies utilisées

- **PHP** : pour la logique serveur et l’API
- **JavaScript** : pour les interactions côté client (panier, composition bouquet…)
- **HTML/CSS** : pour la structure et le design
- **Laragon** : pour exécuter le site en local
- (Base de données, si utilisée : **MySQL** via Laragon)

## 💻 Lancer le projet en local (avec Laragon)

### Prérequis

- Avoir **Laragon** installé sur votre machine : [https://laragon.org/](https://laragon.org/)

### Étapes

1. Copier le dossier du projet dans le dossier `C:\laragon\www\`
2. Ouvrir Laragon et démarrer les services (Apache + MySQL)
3. Accéder au site via votre navigateur à l’adresse :  
   👉 `http://localhost:8080/Fleuriste/`

### Configuration (si base de données utilisée)

- Importer le fichier `.sql` (si tu en as un) via **phpMyAdmin**
- Modifier les identifiants de connexion dans ton fichier PHP (ex: `api.php`)

## 📌 Remarques

- Le site est en cours de développement et peut encore être amélioré.
- Toute la logique d’interaction (ex: composition des bouquets) utilise du JavaScript combiné au backend PHP.


*🇺🇸 EN Version*

# 🌸 Online Flower Shop Website

## 📖 Overview

This project is an **e-commerce flower shop** developed in PHP.
It allows visitors to browse different bouquets, create an account, log in, customize bouquets based on a budget, add products to the cart, and place an order.

The site is organized around a simple user interface, with a **public section** (visitor access) and a **private section** (client access).

## 🔐 Main Features

* Customer registration / login
* Display of new arrivals in the shop
* Browse predefined bouquets
* Create personalized bouquets
* Shopping cart management (add / remove / checkout)
* Order placement

| Folder / File     | Description                            |
| ----------------- | -------------------------------------- |
| `/assets/`        | Contains static resources              |
| `/assets/css/`    | Stylesheets (CSS)                      |
| `/assets/images/` | Images used on the website             |
| `api.php`         | Backend: data management via a PHP API |
| `index.php`       | **Homepage** or **main router**        |
| `a_propos.php`    | “About” page of the online flower shop |
| `boutique.php`    | Product management and shop display    |
| `composer.php`    | Page to create a custom bouquet        |
| `compte.php`      | User account management                |
| `inscription.php` | Registration form                      |
| `panier.php`      | Shopping cart page                     |
| `checkout.php`    | Checkout process and order validation  |
| `contact.php`     | Contact form                           |
| `newsletter.php`  | Newsletter subscription management     |

## 🧪 Technologies Used

* **PHP**: for server-side logic and API
* **JavaScript**: for client-side interactions (cart, bouquet customization, etc.)
* **HTML/CSS**: for structure and design
* **Laragon**: to run the project locally
* (Database, if used: **MySQL** via Laragon)

## 💻 Run the Project Locally (with Laragon)

### Prerequisites

* Install **Laragon** on your machine: [https://laragon.org/](https://laragon.org/)

### Steps

1. Copy the project folder into `C:\laragon\www\`
2. Open Laragon and start the services (Apache + MySQL)
3. Open your browser and access the site at:
   👉 `http://localhost:8080/Fleuriste/`

### Configuration (if a database is used)

* Import the `.sql` file (if available) using **phpMyAdmin**
* Update the connection credentials in your PHP file (e.g., `api.php`)

## 📌 Notes

* The site is still under development and may be further improved.
* All interactive features (e.g., bouquet customization) are handled with **JavaScript combined with PHP backend**.

