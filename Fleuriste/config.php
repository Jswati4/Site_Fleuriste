<?php
$host = 'localhost';
$dbname = 'fleuriste';
$user = 'root';
$pass = ''; // ou ton mot de passe MySQL

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
