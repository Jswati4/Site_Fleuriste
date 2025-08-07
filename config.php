<?php
// Définition des paramètres de connexion à la base de données
$host = 'localhost'; // Adresse du serveur MySQL
$dbname = 'fleuriste'; // Nom de la base de données
$user = 'root'; // Nom d'utilisateur MySQL
$pass = ''; // Mot de passe MySQL (laisser vide si aucun mot de passe)

// Bloc try-catch pour tenter la connexion à la base de données
try {
    // Création d'une nouvelle instance PDO pour la connexion
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Configuration du mode d'erreur pour afficher les exceptions
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Affichage d'un message d'erreur en cas d'échec de connexion
    die("Erreur de connexion : " . $e->getMessage());
}
