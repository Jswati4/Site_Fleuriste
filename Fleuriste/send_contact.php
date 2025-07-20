<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sécurité : Nettoyer les entrées
    function clean($data) {
        return htmlspecialchars(trim($data));
    }

    $nom        = clean($_POST['nom'] ?? '');
    $prenom     = clean($_POST['prenom'] ?? '');
    $email      = clean($_POST['email'] ?? '');
    $lieu       = clean($_POST['lieu'] ?? '');
    $codePostal = clean($_POST['code_postal'] ?? '');
    $ville      = clean($_POST['ville'] ?? '');
    $telephone  = clean($_POST['telephone'] ?? '');
    $prestation = clean($_POST['prestation'] ?? '');
    $date       = clean($_POST['date'] ?? '');
    $invites    = clean($_POST['invites'] ?? '');
    $budget     = clean($_POST['budget'] ?? '');
    $message    = clean($_POST['message'] ?? '');

    // Vérification de base
    if (!$nom || !$prenom || !$email || !$lieu || !$codePostal || !$ville || !$telephone || !$prestation || !$date) {
        echo "Merci de remplir tous les champs obligatoires.";
        exit;
    }

    // Préparer le message
    $to = "swati.alexis@gmail.com";  // envoyer sur cette adresse
    $subject = "Nouveau message de contact – Fleurs de Lune";
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

    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "Content-Type: text/plain; charset=utf-8";

    // Envoi de l'e-mail
    if (mail($to, $subject, $content, $headers)) {
        echo "🌸 Votre message a bien été envoyé. Merci !";
    } else {
        echo "Une erreur est survenue. Veuillez réessayer.";
    }
}
else {
    echo "Méthode non autorisée.";
}
