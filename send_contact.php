<?php
// Vérifie si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fonction pour nettoyer les entrées utilisateur (sécurité)
    function clean($data) {
        // Supprime les espaces et encode les caractères spéciaux
        return htmlspecialchars(trim($data));
    }

    // Récupère et nettoie les données du formulaire
    $email      = clean($_POST['email'] ?? '');        // Email de l'utilisateur
    $lieu       = clean($_POST['lieu'] ?? '');         // Lieu de l'événement
    $codePostal = clean($_POST['code_postal'] ?? '');  // Code postal
    $ville      = clean($_POST['ville'] ?? '');        // Ville
    $telephone  = clean($_POST['telephone'] ?? '');    // Téléphone
    $prestation = clean($_POST['prestation'] ?? '');   // Type de prestation
    $date       = clean($_POST['date'] ?? '');         // Date de l'événement
    $invites    = clean($_POST['invites'] ?? '');      // Nombre d'invités
    $budget     = clean($_POST['budget'] ?? '');       // Budget prévu
    $message    = clean($_POST['message'] ?? '');      // Message de l'utilisateur

    // Vérification de base des champs obligatoires
    if (!$nom || !$prenom || !$email || !$lieu || !$codePostal || !$ville || !$telephone || !$prestation || !$date) {
        // Affiche un message si un champ obligatoire est manquant
        echo "Merci de remplir tous les champs obligatoires.";
        exit;
    }

    // Préparer le message à envoyer par email
    $to = "swati.alexis@gmail.com";  // Adresse de réception
    $subject = "Nouveau message de contact – Fleurs de Lune"; // Sujet de l'email
    $content = "
Nom : $nom
Prénom : $prenom
Email : $email
Téléphone : $telephone

Lieu de l'événement : $lieu
Code Postal : $codePostal
Ville : $ville
Type de prestation : $prestation
Date de l’événement : $date
Nombre d’invités estimé : $invites
Budget prévu : $budget €

Message :
$message
";

    // En-têtes de l'email
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "Content-Type: text/plain; charset=utf-8";

    // Envoi de l'e-mail
    if (mail($to, $subject, $content, $headers)) {
        // Succès de l'envoi
        echo "🌸 Votre message a bien été envoyé. Merci !";
    } else {
        // Échec de l'envoi
        echo "Une erreur est survenue. Veuillez réessayer.";
    }
}
else {
    // Si la méthode n'est pas POST
    echo "Méthode non autorisée.";
}
