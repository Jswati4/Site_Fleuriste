/**
 * Ce script vide le panier de l'utilisateur en supprimant la variable de session 'panier'.
 * Après avoir vidé le panier, il redirige l'utilisateur vers la page 'panier.php'.
 *
 * Fonctionnement :
 * - Démarre la session PHP.
 * - Supprime la variable de session 'panier' si elle existe.
 * - Redirige l'utilisateur vers 'panier.php'.
 */
<?php
session_start();
unset($_SESSION['panier']);
header('Location: panier.php');
exit;
