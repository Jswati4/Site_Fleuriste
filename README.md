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

## 🗂️ Structure du projet

/fleuriste
├── assets/                  → Contient les ressources statiques
│   ├── css/                 → Feuilles de styles
│   └── images/              → Images utilisées dans le site
│
├── api.php                  → Backend : gestion des données via une API en PHP
│
├── index.php              → Page d’accueil (connecté)
├── a_propos.php             → Page de la boutique en ligne
├── boutique.php           → Fichier de traitement (formulaires, commandes…)
├── composer.php           → Fichier de traitement (formulaires, commandes…)
├── compte.php             → Fichier de traitement (formulaires, commandes…)
├── inscription.php        → Fichier de traitement (formulaires, commandes…)
├── panier.php             → Fichier de traitement (formulaires, commandes…)
├── checkout.php           → Fichier de traitement (formulaires, commandes…)
├── contact.php            → Fichier de traitement (formulaires, commandes…)
├── newsletter.php           → Fichier de traitement (formulaires, commandes…)          


index.php → Page d’accueil ou routeur principal


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
