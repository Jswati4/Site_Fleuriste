<?php
// Vérifie si la requête est de type POST (envoi du formulaire)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Définit le type de contenu de la réponse en JSON
  header('Content-Type: application/json');
  // Autorise l'accès depuis n'importe quelle origine (CORS)
  header('Access-Control-Allow-Origin: *');

  // Récupère et valide l'adresse email envoyée en POST
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

  // Si l'email est valide
  if ($email) {
    // Génère un token unique pour la confirmation
    $token = md5($email . time());

    // Enregistre l'email et le token dans un fichier temporaire
    file_put_contents('pending_confirmations.txt', $email . ',' . $token . PHP_EOL, FILE_APPEND);

    // Crée le lien de confirmation à envoyer par email
    $confirmationLink = "https://tondomaine.com/newsletter_confirmation.php?token=$token";

    // Prépare le sujet et le contenu du mail de confirmation
    $subject = "Confirmez votre inscription à la newsletter";
    $message = "Bonjour,\n\nMerci de confirmer votre inscription en cliquant sur ce lien :\n$confirmationLink\n\nÀ bientôt!";
    $headers = 'From: no-reply@tondomaine.com' . "\r\n" .
           'Reply-To: no-reply@tondomaine.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

    // Envoie l'email de confirmation
    mail($email, $subject, $message, $headers);

    // Renvoie une réponse JSON indiquant le succès
    echo json_encode(['success' => true]);
  } else {
    // Si l'email est invalide, renvoie une erreur 400 et un message
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Adresse e-mail invalide']);
  }
  // Termine le script après la réponse
  exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Newsletter - Fleur de Lune</title>
  <style>
  /* Styles généraux de la page */
  body {
    font-family: 'Arial', sans-serif;
    background-color: #fff8f0;
    padding: 40px;
    color: #5B4138;
  }

  /* Conteneur du formulaire */
  .container {
    max-width: 500px;
    margin: auto;
    background: #fffced;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(91, 65, 56, 0.2);
    text-align: center;
  }

  h2 {
    margin-bottom: 10px;
  }

  /* Champ email du formulaire */
  input[type="email"] {
    width: 80%;
    padding: 10px;
    margin: 20px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
  }

  /* Bouton d'envoi */
  button {
    padding: 10px 20px;
    background-color: #F9AAB4;
    color: white;
    border: none;
    border-radius: 25px;
    font-size: 1em;
    cursor: pointer;
  }

  /* Effet au survol du bouton */
  button:hover {
    background-color: #5B4138;
  }

  /* Note d'information */
  .note {
    font-size: 0.9em;
    margin-top: 15px;
    color: #7a5b4b;
  }
  </style>
</head>
<body>

<div class="container">
  <h2>🌸 Inscription à la newsletter</h2>
  <p>Recevez nos créations florales et inspirations directement dans votre boîte mail.</p>

  <!-- Formulaire d'inscription à la newsletter -->
  <form id="newsletterForm" onsubmit="return false;">
    <input type="email" id="email" placeholder="Votre adresse email" required />
    <br>
    <button type="submit" onclick="inscrireEmail()">S’inscrire</button>
  </form>

  <p class="note">⚠️ Les bouquets sont disponibles uniquement lorsqu’ils sont en stock.</p>
</div>

<script>
  // Fonction appelée lors de la soumission du formulaire
  function inscrireEmail() {
  // Récupère la valeur de l'email
  const email = document.getElementById('email').value.trim();

  // Envoie la requête POST au serveur avec l'email
  fetch('newsletter.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'email=' + encodeURIComponent(email)
  })
  .then(res => res.json()) // Transforme la réponse en JSON
  .then(data => {
    // Si l'inscription est réussie
    if (data.success) {
    alert("Merci pour votre inscription 🌸 !");
    document.getElementById('email').value = '';
    } else {
    // Affiche le message d'erreur retourné par le serveur
    alert("Erreur : " + (data.message || 'Veuillez réessayer.'));
    }
  })
  .catch(() => {
    // Affiche une erreur générique en cas de problème réseau
    alert("Une erreur est survenue, merci de réessayer.");
  });
  }
</script>

</body>
</html>
